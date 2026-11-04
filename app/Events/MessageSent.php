<?php

namespace App\Events;

use App\Models\Message;
use App\Models\FamilyRepresentative;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Message $message,
        public int $targetAId,
        public int $targetBId
    ) {}

    /**
     * The channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        $min = min($this->targetAId, $this->targetBId);
        $max = max($this->targetAId, $this->targetBId);

        return [
            new PrivateChannel('chat.'.$min.'.'.$max),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }

    /**
     * Data to broadcast.
     */
    public function broadcastWith(): array
    {
        $sender = $this->message->sender;
        $isGuardian = ($sender->role === 'family_rep') || FamilyRepresentative::where('rep_user_id', $sender->id)->exists();
        
        $guardianTitle = null;
        if ($isGuardian) {
            $repLink = FamilyRepresentative::where('rep_user_id', $sender->id)
                ->whereIn('seeker_user_id', [$this->targetAId, $this->targetBId])
                ->first();
            $guardianTitle = $repLink ? $repLink->relationship . ' & Family Guardian' : 'Family Elder & Guardian';
        }

        return [
            'id' => $this->message->id,
            'sender_id' => $sender->id,
            'sender_name' => $sender->name,
            'sender_role' => $sender->role,
            'is_guardian' => (bool) $isGuardian,
            'guardian_title' => $guardianTitle,
            'content' => $this->message->content,
            'displayed_content' => $this->message->displayed_content,
            'has_masked_contacts' => (bool) $this->message->has_masked_contacts,
            'created_at' => $this->message->created_at->format('d/m/Y H:i'),
        ];
    }
}

