@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    <!-- Top Chat Header & Participant Dossier Bar -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-amber-200 shadow-xs flex items-center justify-between flex-wrap gap-4">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-amber-300 bg-gray-100 shrink-0">
                <img src="{{ $partner->primary_photo_url }}" alt="{{ $partner->name }}" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <h2 class="font-bold text-base text-gray-900">{{ $partner->name }}</h2>
                    @if($partner->is_verified)
                    <span class="text-emerald-700 text-xs font-semibold" title="Verified Seeker">✓</span>
                    @endif
                    @if($isGuardian)
                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-100 text-amber-900 font-bold border border-amber-300">
                        Observing as Guardian for {{ $ward?->name }}
                    </span>
                    @endif
                </div>
                <p class="text-xs text-amber-900">
                    {{ $partner->age }} yrs • Gotra: {{ $partner->profile?->gotra ?? 'N/A' }} • {{ $partner->profile?->profession ?? 'Professional' }}
                </p>
            </div>
        </div>

        <div class="flex items-center space-x-2">
            <div id="reverb-status-pill" class="flex items-center space-x-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[10px] font-bold text-emerald-800">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Reverb Live</span>
            </div>

            <a href="{{ route('profile.show', $partner->id) }}" class="px-3 py-1.5 rounded-xl border border-gray-300 text-xs font-semibold text-gray-700 hover:bg-gray-50 transition">
                Biodata
            </a>

            <!-- One-Click In-Chat Moderation Report Button (FR-8.5) -->
            <button type="button" onclick="document.getElementById('report-modal').classList.remove('hidden')" class="px-3 py-1.5 rounded-xl border border-red-200 bg-red-50 text-red-900 hover:bg-red-100 text-xs font-bold transition flex items-center space-x-1 cursor-pointer">
                <span>🚩</span>
                <span>Report Concern</span>
            </button>
        </div>
    </div>

    <!-- Visible Family Representative Oversight Banner (FR-8.5) -->
    <div class="p-3.5 rounded-xl bg-amber-50/90 border border-amber-300 text-amber-950 text-xs flex items-center justify-between shadow-xs">
        <div class="flex items-center space-x-2.5">
            <span class="text-xl">🛡️</span>
            <div>
                <strong>Chaperoned Matrimonial Environment (Groom, Bride & Guardian):</strong> 
                <span class="block text-[11px] text-amber-900/90 mt-0.5">
                    Family Representatives (Guardians) maintain transparent supervisory participation to ensure customary decorum and dignity.
                </span>
            </div>
        </div>
        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-900 bg-amber-200/70 border border-amber-300/80 px-2.5 py-1 rounded-lg shrink-0">
            Reverb Chaperone Active
        </span>
    </div>

    <!-- Formal Two-Way Contact Exchange Consent Bar (FR-8.6) -->
    <div class="p-4 rounded-xl bg-white border border-amber-200 text-xs shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center space-x-2.5">
            <span class="text-xl">📞</span>
            <div>
                <strong>Two-Way Formal Contact Exchange Channel:</strong>
                @if($contactExchange && $contactExchange->status === 'mutually_approved')
                <div class="text-emerald-800 font-bold mt-0.5">
                    ✓ Mutual consent established! Verified Phone: {{ $partner->phone }} • Email: {{ $partner->email }}
                </div>
                @else
                <div class="text-gray-500 mt-0.5">
                    Requires two-way mutual consent from both parties to safely unlock direct phone numbers and emails.
                </div>
                @endif
            </div>
        </div>

        @if(!$contactExchange || $contactExchange->status !== 'mutually_approved')
        <form method="POST" action="{{ route('chat.contact_exchange', $partner->id) }}">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-xl gold-gradient text-white font-bold text-xs shadow-xs hover:opacity-95 transition cursor-pointer">
                Grant / Request Contact Exchange
            </button>
        </form>
        @else
        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 font-bold rounded-lg text-xs">
            Direct Contacts Unlocked
        </span>
        @endif
    </div>

    <!-- Messages Window -->
    <div class="bg-white rounded-2xl border border-amber-200 shadow-xs p-4 sm:p-6 h-[460px] overflow-y-auto space-y-4" id="chat-messages-container">
        @forelse($messages as $msg)
            @php
                $isMe = ($msg->sender_user_id === auth()->id());
                $sender = $msg->sender;
                $isSenderGuardian = ($sender->role === 'family_rep') || \App\Models\FamilyRepresentative::where('rep_user_id', $sender->id)->exists();
            @endphp
            <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}" data-message-id="{{ $msg->id }}">
                <!-- Sender Header -->
                <div class="flex items-center gap-1.5 text-[11px] text-stone-500 mb-1 px-1">
                    <span class="font-bold text-stone-800">{{ $sender->name }}</span>
                    @if($isSenderGuardian)
                        <span class="bg-amber-100 text-amber-900 border border-amber-300 px-1.5 py-0.2 rounded font-extrabold text-[9px]">
                            🛡️ Guardian Chaperone
                        </span>
                    @endif
                    <span>• {{ $msg->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <!-- Message Bubble -->
                <div class="max-w-[80%] sm:max-w-[70%] rounded-2xl p-3.5 text-xs shadow-xs {{ $isMe ? 'gold-gradient text-white rounded-br-none' : ($isSenderGuardian ? 'bg-amber-50/90 text-stone-900 border-2 border-amber-300/80 rounded-bl-none' : 'bg-stone-100 text-stone-900 border border-stone-200 rounded-bl-none') }}">
                    <p class="leading-relaxed whitespace-pre-wrap">{{ $msg->displayed_content }}</p>
                    
                    @if($msg->has_masked_contacts)
                    <div class="mt-1.5 text-[10px] {{ $isMe ? 'text-amber-200' : 'text-amber-800' }} font-semibold flex items-center space-x-1 border-t border-amber-200/40 pt-1">
                        <span>🛡️</span>
                        <span>Contact info masked by Contact Shield. Use official Contact Exchange above.</span>
                    </div>
                    @endif
                </div>
            </div>
        @empty
            <div id="chat-empty-state" class="h-full flex flex-col items-center justify-center text-center text-gray-400 text-xs">
                <span class="text-3xl mb-2">🪔</span>
                <span class="font-bold text-stone-700">Begin Your Sacred Matrimonial Dialogue</span>
                <span class="text-stone-500 mt-1 max-w-sm">
                    Inquire respectfully about family traditions, cultural values, education, and auspicious life goals.
                </span>
            </div>
        @endforelse
    </div>

    <!-- Message Input Bar with Real-Time Anti-Dowry Shield -->
    <form method="POST" action="{{ route('chat.send', $partner->id) }}" id="chat-form" class="bg-white rounded-2xl p-3 border border-amber-200 shadow-xs flex items-center space-x-3">
        @csrf
        <input type="text"
               name="content"
               id="message-input"
               required
               autocomplete="off"
               placeholder="{{ $isGuardian ? 'Type a chaperone or guidance message as Family Representative...' : 'Type a respectful message (Phone numbers are automatically masked for privacy)...' }}"
               class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-red-800 outline-none text-xs">
        
        <button type="submit" id="chat-submit-btn" class="py-2.5 px-6 rounded-xl gold-gradient text-white font-bold text-xs shadow-xs hover:opacity-95 transition flex items-center space-x-1 cursor-pointer">
            <span>Send</span>
            <span>➤</span>
        </button>
    </form>
</div>

<!-- One-Click In-Chat Moderation Reporting Modal (FR-8.5) -->
<div id="report-modal" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-red-200 space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>🛡️</span>
                <span>Trust & Safety Incident Report</span>
            </h3>
            <button type="button" onclick="document.getElementById('report-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 font-bold text-lg">×</button>
        </div>

        <p class="text-xs text-gray-600">
            Reports are immediately audited by trust officers. Vivah Connect operates strict anti-dowry (Dowry Prohibition Act) and zero-harassment policies.
        </p>

        <form method="POST" action="{{ route('chat.report', $partner->id) }}" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1">Violation Category</label>
                <select name="category" required class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 bg-white">
                    <option value="dowry_demand">Dowry or Commercial Asset Demands (Prohibited by Law)</option>
                    <option value="harassment">Harassment or Offensive Language</option>
                    <option value="fake_profile">Misrepresented or Inaccurate Identity</option>
                    <option value="commercial">Commercial or Solicitous Behavior</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1">Specific Incident Details</label>
                <textarea name="details" rows="3" required placeholder="Describe what occurred with as much context as possible..." class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800"></textarea>
            </div>

            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="document.getElementById('report-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-50 font-semibold cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-red-800 hover:bg-red-900 text-white font-bold shadow-xs cursor-pointer">
                    Submit Incident Report
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const currentUserId = {{ auth()->id() }};
        const partnerUserId = {{ $partner->id }};
        const channelName = '{{ $channelName }}';
        const container = document.getElementById('chat-messages-container');
        const form = document.getElementById('chat-form');
        const input = document.getElementById('message-input');
        const submitBtn = document.getElementById('chat-submit-btn');

        function scrollToBottom() {
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }
        scrollToBottom();

        function appendMessageBubble(msg, isMe, isGuardian) {
            const emptyState = document.getElementById('chat-empty-state');
            if (emptyState) emptyState.remove();

            const wrapper = document.createElement('div');
            wrapper.className = `flex flex-col ${isMe ? 'items-end' : 'items-start'}`;
            wrapper.setAttribute('data-message-id', msg.id || Date.now());

            const guardianBadge = isGuardian ? `<span class="bg-amber-100 text-amber-900 border border-amber-300 px-1.5 py-0.2 rounded font-extrabold text-[9px]">🛡️ Guardian Chaperone</span>` : '';
            const bubbleClasses = isMe 
                ? 'gold-gradient text-white rounded-br-none' 
                : (isGuardian ? 'bg-amber-50/90 text-stone-900 border-2 border-amber-300/80 rounded-bl-none' : 'bg-stone-100 text-stone-900 border border-stone-200 rounded-bl-none');

            const maskedNotice = msg.has_masked_contacts 
                ? `<div class="mt-1.5 text-[10px] ${isMe ? 'text-amber-200' : 'text-amber-800'} font-semibold flex items-center space-x-1 border-t border-amber-200/40 pt-1">
                       <span>🛡️</span><span>Contact info masked by Contact Shield. Use official Contact Exchange above.</span>
                   </div>`
                : '';

            wrapper.innerHTML = `
                <div class="flex items-center gap-1.5 text-[11px] text-stone-500 mb-1 px-1">
                    <span class="font-bold text-stone-800">${escapeHtml(msg.sender_name || 'Member')}</span>
                    ${guardianBadge}
                    <span>• ${msg.created_at || 'Just now'}</span>
                </div>
                <div class="max-w-[80%] sm:max-w-[70%] rounded-2xl p-3.5 text-xs shadow-xs ${bubbleClasses}">
                    <p class="leading-relaxed whitespace-pre-wrap">${escapeHtml(msg.displayed_content || msg.content || '')}</p>
                    ${maskedNotice}
                </div>
            `;

            container.appendChild(wrapper);
            scrollToBottom();
        }

        function escapeHtml(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        // AJAX Form Submit for instant delivery without full-page reloads
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const text = input.value.trim();
                if (!text) return;

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-60', 'cursor-not-allowed');
                }

                const socketId = window.Echo && typeof window.Echo.socketId === 'function' ? window.Echo.socketId() : null;
                const headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                };
                if (socketId) {
                    headers['X-Socket-ID'] = socketId;
                }

                fetch(form.action, {
                    method: 'POST',
                    headers: headers,
                    body: JSON.stringify({ content: text })
                })
                .then(res => {
                    if (!res.ok) {
                        return res.json().then(errData => {
                            throw new Error(errData.error || errData.message || 'Error ' + res.status);
                        });
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.success && data.message) {
                        input.value = '';
                        appendMessageBubble(data.message, true, data.message.is_guardian);
                    } else if (data.error) {
                        alert(data.error);
                    }
                })
                .catch(err => {
                    console.error('Send message failed:', err);
                    alert('Could not deliver message: ' + (err.message || 'Please check your connection and try again.'));
                })
                .finally(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-60', 'cursor-not-allowed');
                    }
                    input.focus();
                });
            });

            // Enter sends message
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    form.dispatchEvent(new Event('submit', { cancelable: true }));
                }
            });
        }

        // Real-Time Laravel Reverb Echo Listener
        function setupReverbEcho() {
            if (!window.Echo) return;

            try {
                window.Echo.private(channelName)
                    .listen('.MessageSent', (e) => {
                        handleIncomingReverbMessage(e);
                    })
                    .listen('MessageSent', (e) => {
                        handleIncomingReverbMessage(e);
                    });

                const pill = document.getElementById('reverb-status-pill');
                if (pill) {
                    pill.innerHTML = `<span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span><span>Reverb Connected</span>`;
                }
            } catch (err) {
                console.warn('Reverb channel subscription warning:', err);
            }
        }

        function handleIncomingReverbMessage(e) {
            if (!e) return;
            // Ignore if current user sent it (already rendered via optimistic submit)
            if (parseInt(e.sender_id) === currentUserId) return;

            appendMessageBubble(e, false, Boolean(e.is_guardian));
        }

        if (window.Echo) {
            setupReverbEcho();
        } else {
            window.addEventListener('echo:ready', setupReverbEcho);
            let timer = setInterval(() => {
                if (window.Echo) {
                    clearInterval(timer);
                    setupReverbEcho();
                }
            }, 250);
        }
    });
</script>
@endsection
