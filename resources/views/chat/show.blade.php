@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    <!-- Top Chat Header & Participant Dossier Bar -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-4 sm:p-5 border border-stone-200/90 dark:border-stone-800 shadow-xs flex items-center justify-between flex-wrap gap-4">
        <div class="flex items-center space-x-3.5">
            <div class="relative w-12 h-12 rounded-full overflow-hidden border-2 border-[var(--color-accent)]/40 bg-stone-100 dark:bg-stone-800 shrink-0">
                <img src="{{ $partner->primary_photo_url }}" alt="{{ $partner->name }}" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <h2 class="font-serif text-lg font-bold text-stone-900 dark:text-stone-100 tracking-tight">{{ $partner->name }}</h2>
                    @if($partner->is_verified)
                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-[var(--color-tulsi)] bg-[var(--color-tulsi)]/10 px-2 py-0.5 rounded-full border border-[var(--color-tulsi)]/30" title="Government ID Verified Candidate">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Verified</span>
                    </span>
                    @endif
                    @if($isGuardian)
                    <span class="text-[11px] px-2.5 py-0.5 rounded-full bg-amber-50 dark:bg-amber-950/50 text-[var(--color-accent)] dark:text-amber-300 font-medium border border-amber-200/80 dark:border-amber-800/60">
                        Observing as Guardian for {{ $ward?->name }}
                    </span>
                    @endif
                </div>
                <p class="text-xs text-stone-600 dark:text-stone-400 mt-0.5">
                    {{ $partner->age }} yrs • Gotra: {{ $partner->profile?->gotra ?? 'Not specified' }} • {{ $partner->profile?->profession ?? 'Professional' }}
                </p>
            </div>
        </div>

        <div class="flex items-center space-x-2.5">
            <div id="reverb-status-pill" class="flex items-center space-x-1.5 px-3 py-1 rounded-full bg-[var(--color-tulsi)]/10 border border-[var(--color-tulsi)]/30 text-[11px] font-medium text-[var(--color-tulsi)]">
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-tulsi)] animate-pulse"></span>
                <span>Encrypted Live Room</span>
            </div>

            <a href="{{ route('profile.show', $partner->id) }}" class="px-3.5 py-1.5 rounded-xl border border-stone-300 dark:border-stone-700 text-xs font-medium text-stone-700 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 transition">
                View Biodata
            </a>

            <!-- One-Click In-Chat Moderation Report Button (FR-8.5) -->
            <button type="button" onclick="document.getElementById('report-modal').classList.remove('hidden')" class="px-3 py-1.5 rounded-xl border border-rose-200 dark:border-rose-900/60 bg-rose-50/60 dark:bg-rose-950/30 text-rose-800 dark:text-rose-300 hover:bg-rose-100/60 text-xs font-medium transition inline-flex items-center space-x-1.5 cursor-pointer">
                <svg class="w-3.5 h-3.5 text-rose-700 dark:text-rose-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a.75.75 0 00.574-.732V6.027a.75.75 0 00-.574-.732l-3.114.732a9 9 0 01-6.086-.71l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5"/></svg>
                <span>Report Concern</span>
            </button>
        </div>
    </div>

    <!-- Visible Family Representative Oversight Banner (FR-8.5) -->
    <div class="p-3.5 rounded-xl bg-[var(--color-haldi-soft)]/60 dark:bg-amber-950/20 border border-[var(--color-haldi)]/30 text-stone-800 dark:text-stone-300 text-xs flex items-center justify-between gap-3 shadow-xs">
        <div class="flex items-center space-x-3">
            <div class="w-7 h-7 rounded-lg bg-[var(--color-haldi-soft)] text-[var(--color-accent)] flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            </div>
            <div>
                <strong class="font-medium text-stone-900 dark:text-stone-100">Chaperoned Matrimonial Environment:</strong> 
                <span class="block text-[11px] text-stone-600 dark:text-stone-400 mt-0.5">
                    Family Representatives maintain transparent supervisory oversight to preserve mutual dignity and family trust.
                </span>
            </div>
        </div>
        <span class="text-[10px] font-medium tracking-wide text-[var(--color-accent)] bg-[var(--color-haldi-soft)] border border-[var(--color-haldi)]/30 px-2.5 py-1 rounded-md shrink-0">
            Chaperone Active
        </span>
    </div>

    <!-- Formal Two-Way Contact Exchange Consent Bar (FR-8.6) -->
    <div class="p-4 rounded-xl bg-white dark:bg-stone-900 border border-stone-200/90 dark:border-stone-800 text-xs shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 rounded-lg bg-stone-100 dark:bg-stone-800 text-[var(--color-primary)] dark:text-[var(--color-accent)] flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
            </div>
            <div>
                <strong class="font-medium text-stone-900 dark:text-stone-100">Direct Contact Exchange:</strong>
                @if($contactExchange && $contactExchange->status === 'mutually_approved')
                <div class="text-[var(--color-tulsi)] font-medium mt-0.5 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    <span>Mutual consent granted. Verified Phone: {{ $partner->phone }} • Email: {{ $partner->email }}</span>
                </div>
                @else
                <div class="text-stone-500 dark:text-stone-400 mt-0.5">
                    Phone numbers and emails remain strictly masked until both families give two-way mutual consent.
                </div>
                @endif
            </div>
        </div>

        @if(!$contactExchange || $contactExchange->status !== 'mutually_approved')
        <form method="POST" action="{{ route('chat.contact_exchange', $partner->id) }}">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white font-medium text-xs transition cursor-pointer shadow-xs">
                Request Mutual Contact Exchange
            </button>
        </form>
        @else
        <span class="px-3 py-1 bg-[var(--color-tulsi)]/10 text-[var(--color-tulsi)] font-medium rounded-lg text-xs border border-[var(--color-tulsi)]/30">
            Contacts Exchanged
        </span>
        @endif
    </div>

    <!-- Messages Window -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs p-4 sm:p-6 h-[460px] overflow-y-auto space-y-4" id="chat-messages-container">
        @forelse($messages as $msg)
            @php
                $isMe = ($msg->sender_user_id === auth()->id());
                $sender = $msg->sender;
                $isSenderGuardian = ($sender->role === 'family_rep') || \App\Models\FamilyRepresentative::where('rep_user_id', $sender->id)->exists();
            @endphp
            <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}" data-message-id="{{ $msg->id }}">
                <!-- Sender Header -->
                <div class="flex items-center gap-1.5 text-[11px] text-stone-500 mb-1 px-1">
                    <span class="font-medium text-stone-800 dark:text-stone-200">{{ $sender->name }}</span>
                    @if($isSenderGuardian)
                        <span class="bg-[var(--color-haldi-soft)] text-[var(--color-accent)] border border-[var(--color-haldi)]/40 px-1.5 py-0.2 rounded font-medium text-[10px]">
                            Guardian Chaperone
                        </span>
                    @endif
                    <span>• {{ $msg->created_at->format('d M, H:i') }}</span>
                </div>

                <!-- Message Bubble -->
                <div class="max-w-[80%] sm:max-w-[70%] rounded-2xl p-3.5 text-xs shadow-xs {{ $isMe ? 'bg-[var(--color-primary)] text-stone-50 rounded-br-xs' : ($isSenderGuardian ? 'bg-[var(--color-haldi-soft)]/90 dark:bg-amber-950/30 text-stone-900 dark:text-stone-100 border border-[var(--color-haldi)]/40 rounded-bl-xs' : 'bg-stone-100 dark:bg-stone-800 text-stone-900 dark:text-stone-100 border border-stone-200/80 dark:border-stone-700/80 rounded-bl-xs') }}">
                    <p class="leading-relaxed whitespace-pre-wrap">{{ $msg->displayed_content }}</p>
                    
                    @if($msg->has_masked_contacts)
                    <div class="mt-2 text-[10px] {{ $isMe ? 'text-amber-200' : 'text-[var(--color-accent)] dark:text-amber-300' }} font-medium flex items-center space-x-1.5 border-t border-amber-200/30 pt-1.5">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        <span>Contact information shielded for privacy. Please use the official Contact Exchange above.</span>
                    </div>
                    @endif
                </div>
            </div>
        @empty
            <div id="chat-empty-state" class="h-full flex flex-col items-center justify-center text-center p-6 text-stone-400">
                <div class="w-12 h-12 rounded-full bg-stone-100 dark:bg-stone-800 text-[var(--color-primary)] dark:text-[var(--color-accent)] flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v7.018z"/></svg>
                </div>
                <h3 class="font-serif text-base font-bold text-stone-800 dark:text-stone-200">Auspicious Conversations Begin with Respect</h3>
                <p class="text-xs text-stone-500 dark:text-stone-400 mt-1.5 max-w-sm leading-relaxed">
                    Inquire warmly about family traditions, cultural values, education, and shared life aspirations.
                </p>
            </div>
        @endforelse
    </div>

    <!-- Message Input Bar with Real-Time Anti-Dowry Shield -->
    <form method="POST" action="{{ route('chat.send', $partner->id) }}" id="chat-form" class="bg-white dark:bg-stone-900 rounded-2xl p-3 border border-stone-200/90 dark:border-stone-800 shadow-xs flex items-center space-x-3">
        @csrf
        <input type="text"
               name="content"
               id="message-input"
               required
               autocomplete="off"
               placeholder="{{ $isGuardian ? 'Type a chaperone note or guidance as Family Representative...' : 'Type a respectful message (phone numbers and emails are masked)...' }}"
               class="flex-1 px-4 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 bg-stone-50/50 dark:bg-stone-800 focus:bg-white dark:focus:bg-stone-800 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] outline-none text-xs text-stone-900 dark:text-stone-100 transition">
        
        <button type="submit" id="chat-submit-btn" class="py-2.5 px-5 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white font-medium text-xs shadow-xs transition flex items-center space-x-1.5 cursor-pointer">
            <span>Send</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
        </button>
    </form>
</div>

<!-- One-Click In-Chat Moderation Reporting Modal (FR-8.5) -->
<div id="report-modal" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 flex items-center justify-center hidden p-4">
    <div class="bg-white dark:bg-stone-900 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-stone-200 dark:border-stone-800 space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="font-serif text-lg font-bold text-stone-900 dark:text-stone-100 flex items-center space-x-2">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286zm0 13.036h.008v.008H12v-.008z"/></svg>
                <span>Trust & Safety Report</span>
            </h3>
            <button type="button" onclick="document.getElementById('report-modal').classList.add('hidden')" class="text-stone-400 hover:text-stone-600 text-lg cursor-pointer">✕</button>
        </div>

        <p class="text-xs text-stone-600 dark:text-stone-400 leading-relaxed">
            Every report is reviewed directly by our family trust team. We strictly enforce the Dowry Prohibition Act and zero-harassment policies.
        </p>

        <form method="POST" action="{{ route('chat.report', $partner->id) }}" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">Reason for Report</label>
                <select name="category" required class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]">
                    <option value="dowry_demand">Dowry or financial asset demand (prohibited by law)</option>
                    <option value="harassment">Harassment or disrespectful language</option>
                    <option value="fake_profile">Misrepresented or inaccurate biodata</option>
                    <option value="commercial">Commercial or marketing solicitation</option>
                </select>
            </div>

            <div>
                <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">Describe what happened</label>
                <textarea name="details" rows="3" required placeholder="Provide any details to help our safety team investigate..." class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]"></textarea>
            </div>

            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="document.getElementById('report-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-stone-300 dark:border-stone-700 text-stone-600 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 font-medium cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-medium shadow-xs cursor-pointer">
                    Submit Report
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

            const guardianBadge = isGuardian ? `<span class="bg-[var(--color-haldi-soft)] text-[var(--color-accent)] border border-[var(--color-haldi)]/40 px-1.5 py-0.2 rounded font-medium text-[10px]">Guardian Chaperone</span>` : '';
            const bubbleClasses = isMe 
                ? 'bg-[var(--color-primary)] text-stone-50 rounded-br-xs' 
                : (isGuardian ? 'bg-[var(--color-haldi-soft)]/90 dark:bg-amber-950/30 text-stone-900 dark:text-stone-100 border border-[var(--color-haldi)]/40 rounded-bl-xs' : 'bg-stone-100 dark:bg-stone-800 text-stone-900 dark:text-stone-100 border border-stone-200/80 dark:border-stone-700/80 rounded-bl-xs');

            const maskedNotice = msg.has_masked_contacts 
                ? `<div class="mt-2 text-[10px] ${isMe ? 'text-amber-200' : 'text-[var(--color-accent)] dark:text-amber-300'} font-medium flex items-center space-x-1.5 border-t border-amber-200/30 pt-1.5">
                       <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                       <span>Contact information shielded for privacy. Please use the official Contact Exchange above.</span>
                   </div>`
                : '';

            wrapper.innerHTML = `
                <div class="flex items-center gap-1.5 text-[11px] text-stone-500 mb-1 px-1">
                    <span class="font-medium text-stone-800 dark:text-stone-200">${escapeHtml(msg.sender_name || 'Member')}</span>
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
                    pill.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span><span>Encrypted Live Room</span>`;
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
