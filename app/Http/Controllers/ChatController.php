<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Proposal;
use App\Models\ContactExchangeRequest;
use App\Models\UserReport;
use App\Models\AuditLog;
use App\Services\SafetyFilterService;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    protected SafetyFilterService $safetyFilter;

    public function __construct(SafetyFilterService $safetyFilter)
    {
        $this->safetyFilter = $safetyFilter;
    }

    public function index()
    {
        $user = Auth::user();

        // Active mutual conversations (proposals that are accepted)
        $acceptedProposals = Proposal::with(['sender.profile', 'receiver.profile'])
            ->where(function ($q) use ($user) {
                $q->where('sender_user_id', $user->id)->orWhere('receiver_user_id', $user->id);
            })
            ->where('status', 'accepted')
            ->get();

        $partnerIds = $acceptedProposals->map(function ($p) use ($user) {
            return $p->sender_user_id === $user->id ? $p->receiver_user_id : $p->sender_user_id;
        })->unique();

        // Batch-load latest messages in a single query to eliminate N+1 overhead
        $latestMessages = Message::where(function ($q) use ($user, $partnerIds) {
            $q->where('sender_user_id', $user->id)->whereIn('receiver_user_id', $partnerIds);
        })->orWhere(function ($q) use ($user, $partnerIds) {
            $q->where('receiver_user_id', $user->id)->whereIn('sender_user_id', $partnerIds);
        })->orderBy('created_at', 'desc')->get()->groupBy(function ($msg) use ($user) {
            return $msg->sender_user_id === $user->id ? $msg->receiver_user_id : $msg->sender_user_id;
        });

        $conversations = $acceptedProposals->map(function ($prop) use ($user, $latestMessages) {
            $partner = ($prop->sender_user_id === $user->id) ? $prop->receiver : $prop->sender;
            $lastMessage = $latestMessages->get($partner->id)?->first();

            return [
                'partner' => $partner,
                'proposal' => $prop,
                'last_message' => $lastMessage,
            ];
        });

        return view('chat.index', compact('conversations'));
    }

    public function show($partnerId)
    {
        $user = Auth::user();
        $partner = User::with(['profile', 'kundli', 'familyRepresentatives'])->findOrFail($partnerId);

        $isGuardian = ($user->role === 'family_rep') || \App\Models\FamilyRepresentative::where('rep_user_id', $user->id)->exists();
        $ward = null;

        if ($user->role === 'family_rep') {
            // Find which ward is connected to this partner
            $wardIds = \App\Models\FamilyRepresentative::where('rep_user_id', $user->id)->pluck('seeker_user_id');
            $ward = User::whereIn('id', $wardIds)->where(function($q) use ($partner) {
                $q->whereHas('sentProposals', fn($sp) => $sp->where('receiver_user_id', $partner->id)->where('status', 'accepted'))
                  ->orWhereHas('receivedProposals', fn($rp) => $rp->where('sender_user_id', $partner->id)->where('status', 'accepted'));
            })->first();

            // Fallback: check if ward has any proposal with partner
            if (!$ward) {
                $ward = User::whereIn('id', $wardIds)->first();
            }

            if (!$ward && $user->role !== 'admin') {
                return redirect()->route('family.dashboard')->with('error', 'No active dialogue found for your represented ward.');
            }
        } else {
            // Security check: Must have accepted mutual proposal (FR-8.1)
            if (!$user->hasMutualInterestWith($partner->id) && $user->role !== 'admin') {
                return redirect()->route('chat.index')->with('error', 'Direct communication is only unlocked upon mutual proposal acceptance.');
            }
        }

        $seekerAId = $ward ? $ward->id : $user->id;
        $seekerBId = $partner->id;

        // Guardians for seekerA and seekerB
        $guardiansA = \App\Models\FamilyRepresentative::where('seeker_user_id', $seekerAId)->pluck('rep_user_id')->toArray();
        $guardiansB = \App\Models\FamilyRepresentative::where('seeker_user_id', $seekerBId)->pluck('rep_user_id')->toArray();
        $allRoomParticipants = array_unique(array_merge([$seekerAId, $seekerBId], $guardiansA, $guardiansB));

        // Fetch all dialogue messages between groom, bride, and guardians
        $messages = Message::with('sender')
            ->whereIn('sender_user_id', $allRoomParticipants)
            ->whereIn('receiver_user_id', $allRoomParticipants)
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark incoming unread messages as read
        Message::where('sender_user_id', $partner->id)
            ->where('receiver_user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now(), 'status' => 'read']);

        // Check contact exchange status
        $contactExchange = ContactExchangeRequest::where(function ($q) use ($seekerAId, $seekerBId) {
            $q->where('user_a_id', $seekerAId)->where('user_b_id', $seekerBId);
        })->orWhere(function ($q) use ($seekerAId, $seekerBId) {
            $q->where('user_a_id', $seekerBId)->where('user_b_id', $seekerAId);
        })->first();

        // Check if family representative exists for chaperone badge
        $hasFamilyChaperone = !empty($guardiansA) || !empty($guardiansB) || $isGuardian;

        $channelName = 'chat.' . min($seekerAId, $seekerBId) . '.' . max($seekerAId, $seekerBId);

        return view('chat.show', [
            'partner' => $partner,
            'ward' => $ward,
            'isGuardian' => $isGuardian,
            'messages' => $messages,
            'contactExchange' => $contactExchange,
            'hasFamilyChaperone' => $hasFamilyChaperone,
            'channelName' => $channelName,
            'seekerAId' => $seekerAId,
            'seekerBId' => $seekerBId,
        ]);
    }

    public function sendMessage(Request $request, $partnerId)
    {
        $user = Auth::user();
        $partner = User::findOrFail($partnerId);

        $isGuardian = ($user->role === 'family_rep') || \App\Models\FamilyRepresentative::where('rep_user_id', $user->id)->exists();
        $ward = null;

        if ($user->role === 'family_rep') {
            $wardIds = \App\Models\FamilyRepresentative::where('rep_user_id', $user->id)->pluck('seeker_user_id');
            $ward = User::whereIn('id', $wardIds)->first();
            if (!$ward && $user->role !== 'admin') {
                return response()->json(['error' => 'No represented candidate found.'], 403);
            }
        } else {
            if (!$user->hasMutualInterestWith($partner->id) && $user->role !== 'admin') {
                return response()->json(['error' => 'Mutual interest required.'], 403);
            }
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Process message through SafetyFilterService
        $processResult = $this->safetyFilter->processChatMessage($validated['content']);

        if ($processResult['blocked']) {
            UserReport::create([
                'reporter_id' => $partner->id,
                'reported_id' => $user->id,
                'category' => 'dowry_demand',
                'details' => 'Automated Chat Detection: User sent message blocked for dowry violation: "' . $validated['content'] . '"',
                'status' => 'pending',
            ]);

            AuditLog::log('dowry_solicitation_blocked', [
                'sender_id' => $user->id,
                'receiver_id' => $partner->id,
            ], $user->id);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['blocked' => true, 'error' => 'Message blocked! Dowry solicitation violates statutory laws and Global Saptapadi ethics.'], 422);
            }

            return back()->with('error', 'Message blocked! Dowry solicitation and commercial demands violate statutory laws and Global Saptapadi ethics.');
        }

        $message = Message::create([
            'sender_user_id' => $user->id,
            'receiver_user_id' => $partner->id,
            'content' => $processResult['message_content'],
            'displayed_content' => $processResult['displayed_content'],
            'has_masked_contacts' => $processResult['has_masked_contacts'],
            'dowry_flagged' => false,
            'status' => 'sent',
        ]);

        $seekerAId = $ward ? $ward->id : $user->id;
        $seekerBId = $partner->id;

        // Broadcast real-time event via Laravel Reverb!
        try {
            broadcast(new \App\Events\MessageSent($message, $seekerAId, $seekerBId))->toOthers();
        } catch (\Throwable $e) {
            \Log::warning('Reverb broadcast notice: ' . $e->getMessage());
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'sender_id' => $user->id,
                    'sender_name' => $user->name,
                    'sender_role' => $user->role,
                    'is_guardian' => (bool) $isGuardian,
                    'guardian_title' => $isGuardian ? ($ward ? 'Guardian for ' . $ward->name : 'Family Guardian') : null,
                    'displayed_content' => $message->displayed_content,
                    'has_masked_contacts' => (bool) $message->has_masked_contacts,
                    'created_at' => $message->created_at->format('d/m/Y H:i'),
                ]
            ]);
        }

        return back()->with('success', 'Message sent.');
    }

    public function requestContactExchange($partnerId)
    {
        $user = Auth::user();
        $partner = User::findOrFail($partnerId);

        $exchange = ContactExchangeRequest::where(function ($q) use ($user, $partner) {
            $q->where('user_a_id', $user->id)->where('user_b_id', $partner->id);
        })->orWhere(function ($q) use ($user, $partner) {
            $q->where('user_a_id', $partner->id)->where('user_b_id', $user->id);
        })->first();

        if (!$exchange) {
            ContactExchangeRequest::create([
                'user_a_id' => $user->id,
                'user_b_id' => $partner->id,
                'user_a_consent' => true,
                'user_b_consent' => false,
                'status' => 'pending',
            ]);
            $msg = 'Formal contact exchange requested. Contact will be revealed once both parties grant mutual consent.';
        } else {
            if ($exchange->user_a_id === $user->id) {
                $exchange->update(['user_a_consent' => true]);
            } else {
                $exchange->update(['user_b_consent' => true]);
            }

            if ($exchange->user_a_consent && $exchange->user_b_consent) {
                $exchange->update(['status' => 'mutually_approved', 'approved_at' => now()]);
                $msg = 'Two-way mutual consent established! Contact numbers and verified emails are now unlocked.';
            } else {
                $msg = 'Your consent for formal contact exchange has been registered.';
            }
        }

        return back()->with('success', $msg);
    }

    public function reportUser(Request $request, $partnerId)
    {
        $reporter = Auth::user();
        $reported = User::findOrFail($partnerId);

        $validated = $request->validate([
            'category' => 'required|in:dowry_demand,harassment,fake_profile,inappropriate_content,commercial',
            'details' => 'required|string|max:1000',
        ]);

        UserReport::create([
            'reporter_id' => $reporter->id,
            'reported_id' => $reported->id,
            'category' => $validated['category'],
            'details' => $validated['details'],
            'status' => 'pending',
        ]);

        AuditLog::log('user_reported', [
            'reporter_id' => $reporter->id,
            'reported_id' => $reported->id,
            'category' => $validated['category'],
        ], $reporter->id);

        return back()->with('success', 'Report filed securely. Our Trust & Safety officers will investigate immediately.');
    }
}

