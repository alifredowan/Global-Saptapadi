{{-- Standardized Notifications Panel --}}
{{-- Specs: 360px wide (sm: 380px), max-height 70vh, scrollable, 4 tabs (All, Interests, Messages, Family), unread dots, relative time, friendly empty state, footer with Mark all as read. Mobile full-screen/sheet support. --}}

<div x-show="notifOpen"
     @click.outside="notifOpen = false"
     x-cloak
     x-transition:enter="transition ease-out duration-150 transform"
     x-transition:enter-start="opacity-0 scale-95 translate-y-1"
     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
     x-transition:leave="transition ease-in duration-100 transform"
     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
     x-transition:leave-end="opacity-0 scale-95 translate-y-1"
     @keydown.escape.window="notifOpen = false"
     class="absolute right-0 top-full mt-2 w-[360px] sm:w-[380px] max-h-[70vh] flex flex-col rounded-lg bg-[var(--bg-surface)] border border-[var(--border-default)] shadow-2xl z-50 text-[var(--text-primary)] overflow-hidden"
     role="dialog"
     aria-label="Notifications panel">

    {{-- Panel Header --}}
    <div class="px-4 py-3 border-b border-[var(--border-default)] bg-[var(--bg-subtle)] flex items-center justify-between shrink-0">
        <div class="flex items-center gap-2">
            <span class="font-serif font-bold text-base tracking-wide text-[var(--text-primary)]">Notifications</span>
            @if(($navPendingProposalsCount + $navUnreadMessagesCount) > 0)
                <span class="px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-[var(--secondary-primary)] text-white">
                    {{ ($navPendingProposalsCount + $navUnreadMessagesCount) > 9 ? '9+' : ($navPendingProposalsCount + $navUnreadMessagesCount) }} new
                </span>
            @endif
        </div>
        <button type="button"
                @click="notifOpen = false"
                class="p-1 rounded-md text-[var(--text-muted)] hover:text-[var(--text-primary)] hover:bg-stone-500/10 transition cursor-pointer"
                title="Close notifications"
                aria-label="Close notifications">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Tabs Bar (All, Interests, Messages, Family) --}}
    <div class="flex items-center border-b border-[var(--border-default)] bg-[var(--bg-surface)] px-2 shrink-0 text-xs font-medium"
         role="tablist"
         aria-label="Notification tabs">
        <button type="button"
                role="tab"
                :aria-selected="notifTab === 'all'"
                @click="notifTab = 'all'"
                class="relative flex-1 py-2.5 text-center transition cursor-pointer"
                :class="notifTab === 'all' ? 'text-[var(--accent-primary)] font-semibold after:absolute after:bottom-0 after:left-2 after:right-2 after:h-0.5 after:bg-[var(--accent-primary)]' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'">
            All
        </button>

        <button type="button"
                role="tab"
                :aria-selected="notifTab === 'interests'"
                @click="notifTab = 'interests'"
                class="relative flex-1 py-2.5 text-center transition cursor-pointer"
                :class="notifTab === 'interests' ? 'text-[var(--accent-primary)] font-semibold after:absolute after:bottom-0 after:left-2 after:right-2 after:h-0.5 after:bg-[var(--accent-primary)]' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'">
            <span>Interests</span>
            @if($navPendingProposalsCount > 0)
                <span class="ml-1 px-1.5 py-0.2 rounded-full text-[9px] font-bold bg-[var(--color-primary)] text-white">
                    {{ $navPendingProposalsCount > 9 ? '9+' : $navPendingProposalsCount }}
                </span>
            @endif
        </button>

        <button type="button"
                role="tab"
                :aria-selected="notifTab === 'messages'"
                @click="notifTab = 'messages'"
                class="relative flex-1 py-2.5 text-center transition cursor-pointer"
                :class="notifTab === 'messages' ? 'text-[var(--accent-primary)] font-semibold after:absolute after:bottom-0 after:left-2 after:right-2 after:h-0.5 after:bg-[var(--accent-primary)]' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'">
            <span>Messages</span>
            @if($navUnreadMessagesCount > 0)
                <span class="ml-1 px-1.5 py-0.2 rounded-full text-[9px] font-bold bg-[var(--color-primary)] text-white">
                    {{ $navUnreadMessagesCount > 9 ? '9+' : $navUnreadMessagesCount }}
                </span>
            @endif
        </button>

        <button type="button"
                role="tab"
                :aria-selected="notifTab === 'family'"
                @click="notifTab = 'family'"
                class="relative flex-1 py-2.5 text-center transition cursor-pointer"
                :class="notifTab === 'family' ? 'text-[var(--accent-primary)] font-semibold after:absolute after:bottom-0 after:left-2 after:right-2 after:h-0.5 after:bg-[var(--accent-primary)]' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'">
            Family
        </button>
    </div>

    {{-- Notification List (Scrollable, Max-Height 70vh) --}}
    <div class="flex-1 overflow-y-auto divide-y divide-[var(--border-subtle)] text-xs">

        {{-- TAB 1: ALL --}}
        <div x-show="notifTab === 'all'" class="divide-y divide-[var(--border-subtle)]">
            @php
                $hasAnyNotifications = ($navPendingProposalsCount > 0) || ($navUnreadMessagesCount > 0) || ($navRecentPendingProposals->count() > 0) || ($navRecentMessages->count() > 0);
            @endphp

            @if($hasAnyNotifications)
                {{-- Recent Messages in All --}}
                @foreach($navRecentMessages->take(2) as $msg)
                    <a href="{{ route('chat.show', ['partnerId' => $msg->sender_user_id]) }}"
                       class="p-3 flex items-start gap-3 hover:bg-[var(--bg-subtle)] transition group">
                        <div class="relative shrink-0 mt-0.5">
                            <div class="w-8 h-8 rounded-full overflow-hidden bg-stone-200 border border-[var(--border-default)]">
                                <img src="{{ $msg->sender?->primary_photo_url }}" alt="{{ $msg->sender?->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="w-3.5 h-3.5 rounded-full bg-[var(--color-primary)] text-white absolute -bottom-0.5 -right-0.5 flex items-center justify-center">
                                <svg class="w-2 h-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/></svg>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-1">
                                <span class="font-semibold text-[var(--text-primary)] group-hover:text-[var(--accent-primary)] truncate">{{ $msg->sender?->name }}</span>
                                <span class="text-[10px] text-[var(--text-muted)] shrink-0">{{ $msg->created_at->diffForHumans(null, true) }}</span>
                            </div>
                            <p class="text-[11px] text-[var(--text-secondary)] truncate mt-0.5">{{ Str::limit($msg->message_body, 55) }}</p>
                        </div>
                        @if(is_null($msg->read_at))
                            <span class="w-2 h-2 rounded-full bg-[var(--color-primary)] shrink-0 mt-2" title="Unread"></span>
                        @endif
                    </a>
                @endforeach

                {{-- Recent Proposals in All --}}
                @foreach($navRecentPendingProposals->take(3) as $prop)
                    @php $sender = $prop->sender; @endphp
                    <div class="p-3 flex items-start gap-3 hover:bg-[var(--bg-subtle)] transition">
                        <div class="relative shrink-0 mt-0.5">
                            <div class="w-8 h-8 rounded-full overflow-hidden bg-stone-200 border border-[var(--border-default)]">
                                <img src="{{ $sender?->primary_photo_url }}" alt="{{ $sender?->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="w-3.5 h-3.5 rounded-full bg-[var(--color-primary)] text-white absolute -bottom-0.5 -right-0.5 flex items-center justify-center">
                                <svg class="w-2 h-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-1">
                                <span class="font-semibold text-[var(--text-primary)] truncate">{{ $sender?->name }}</span>
                                <span class="text-[10px] text-[var(--text-muted)] shrink-0">{{ $prop->created_at->diffForHumans(null, true) }}</span>
                            </div>
                            <p class="text-[11px] text-[var(--text-secondary)] truncate mt-0.5">Sent an expression of interest to connect.</p>
                            <div class="mt-2 flex items-center gap-2">
                                <a href="{{ route('proposals.index') }}" class="px-2.5 py-1 rounded text-[11px] font-semibold bg-[var(--accent-primary)] text-white hover:bg-[var(--accent-hover)] transition">
                                    Review
                                </a>
                                <a href="{{ route('profile.show', ['id' => $sender?->id]) }}" class="px-2 py-1 rounded text-[11px] font-medium text-[var(--text-secondary)] hover:bg-[var(--border-default)] transition">
                                    View Biodata
                                </a>
                            </div>
                        </div>
                        @if($prop->status === 'pending')
                            <span class="w-2 h-2 rounded-full bg-[var(--color-primary)] shrink-0 mt-2" title="Pending proposal"></span>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="py-12 px-6 text-center space-y-2">
                    <div class="w-10 h-10 rounded-full bg-stone-500/10 text-[var(--text-muted)] mx-auto flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                    </div>
                    <p class="font-medium text-[var(--text-primary)]">You're all caught up.</p>
                    <p class="text-[11px] text-[var(--text-muted)]">No new notifications at this time.</p>
                </div>
            @endif
        </div>

        {{-- TAB 2: INTERESTS --}}
        <div x-show="notifTab === 'interests'" class="divide-y divide-[var(--border-subtle)]">
            @forelse($navRecentPendingProposals as $prop)
                @php $sender = $prop->sender; @endphp
                <div class="p-3 flex items-start gap-3 hover:bg-[var(--bg-subtle)] transition">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-stone-200 border border-[var(--border-default)] shrink-0 mt-0.5">
                        <img src="{{ $sender?->primary_photo_url }}" alt="{{ $sender?->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="font-semibold text-[var(--text-primary)] truncate">{{ $sender?->name }}</span>
                            <span class="text-[10px] text-[var(--text-muted)] shrink-0">{{ $prop->created_at->diffForHumans(null, true) }}</span>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)] truncate mt-0.5">
                            {{ $sender?->age ? $sender->age . ' yrs' : 'Age verified' }} &bull; Gotra: {{ $sender?->profile?->gotra ?? 'Not specified' }}
                        </p>
                        <div class="mt-2 flex items-center gap-2">
                            <a href="{{ route('proposals.index') }}" class="px-2.5 py-1 rounded text-[11px] font-semibold bg-[var(--accent-primary)] text-white hover:bg-[var(--accent-hover)] transition">
                                Review &amp; Respond
                            </a>
                        </div>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-[var(--color-primary)] shrink-0 mt-2" title="Pending"></span>
                </div>
            @empty
                <div class="py-12 px-6 text-center space-y-2">
                    <div class="w-10 h-10 rounded-full bg-stone-500/10 text-[var(--text-muted)] mx-auto flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>
                    </div>
                    <p class="font-medium text-[var(--text-primary)]">No pending interests.</p>
                    <p class="text-[11px] text-[var(--text-muted)]">When intentional seekers express interest, they will appear here.</p>
                </div>
            @endforelse
        </div>

        {{-- TAB 3: MESSAGES --}}
        <div x-show="notifTab === 'messages'" class="divide-y divide-[var(--border-subtle)]">
            @forelse($navRecentMessages as $msg)
                <a href="{{ route('chat.show', ['partnerId' => $msg->sender_user_id]) }}"
                   class="p-3 flex items-start gap-3 hover:bg-[var(--bg-subtle)] transition group">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-stone-200 border border-[var(--border-default)] shrink-0 mt-0.5">
                        <img src="{{ $msg->sender?->primary_photo_url }}" alt="{{ $msg->sender?->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="font-semibold text-[var(--text-primary)] group-hover:text-[var(--accent-primary)] truncate">{{ $msg->sender?->name }}</span>
                            <span class="text-[10px] text-[var(--text-muted)] shrink-0">{{ $msg->created_at->diffForHumans(null, true) }}</span>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)] truncate mt-0.5">{{ Str::limit($msg->message_body, 60) }}</p>
                    </div>
                    @if(is_null($msg->read_at))
                        <span class="w-2 h-2 rounded-full bg-[var(--color-primary)] shrink-0 mt-2" title="Unread"></span>
                    @endif
                </a>
            @empty
                <div class="py-12 px-6 text-center space-y-2">
                    <div class="w-10 h-10 rounded-full bg-stone-500/10 text-[var(--text-muted)] mx-auto flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/></svg>
                    </div>
                    <p class="font-medium text-[var(--text-primary)]">No unread messages.</p>
                    <p class="text-[11px] text-[var(--text-muted)]">Your chaperoned conversations are all up to date.</p>
                </div>
            @endforelse
        </div>

        {{-- TAB 4: FAMILY --}}
        <div x-show="notifTab === 'family'" class="divide-y divide-[var(--border-subtle)]">
            @forelse($navFamilyReps as $rep)
                <div class="p-3 flex items-start gap-3 hover:bg-[var(--bg-subtle)] transition">
                    <div class="w-8 h-8 rounded-full bg-amber-500/10 text-[var(--secondary-text)] flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="font-semibold text-[var(--text-primary)] truncate">{{ $rep->relationship_type ? ucfirst($rep->relationship_type) : 'Family Guardian' }}</span>
                            <span class="text-[10px] text-[var(--text-muted)] shrink-0">{{ $rep->created_at->diffForHumans(null, true) }}</span>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)] mt-0.5">
                            Status: {{ $rep->can_approve_proposals ? 'Full approval permission' : 'View only permission' }}
                        </p>
                        <a href="{{ route('family.dashboard') }}" class="inline-block mt-2 text-[11px] font-semibold text-[var(--accent-primary)] hover:underline">
                            Open Family Console &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="py-12 px-6 text-center space-y-2">
                    <div class="w-10 h-10 rounded-full bg-stone-500/10 text-[var(--text-muted)] mx-auto flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                    </div>
                    <p class="font-medium text-[var(--text-primary)]">No family updates.</p>
                    <p class="text-[11px] text-[var(--text-muted)]">Invite parents or guardians anytime to co-review matches with you.</p>
                </div>
            @endforelse
        </div>

    </div>

    {{-- Panel Footer: Mark all as read & All inquiries --}}
    <div class="px-4 py-2.5 bg-[var(--bg-subtle)] border-t border-[var(--border-default)] flex items-center justify-between shrink-0 text-xs">
        <form method="POST" action="{{ route('notifications.mark_all_read') }}">
            @csrf
            <button type="submit" class="font-medium text-[var(--accent-primary)] hover:underline cursor-pointer">
                Mark all as read
            </button>
        </form>

        <a href="{{ route('proposals.index') }}" class="text-[var(--text-secondary)] hover:text-[var(--text-primary)] transition">
            View all interests &rarr;
        </a>
    </div>

</div>

