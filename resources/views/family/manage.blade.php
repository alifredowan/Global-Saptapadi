@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Card -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)] text-[11px] font-semibold uppercase tracking-wider mb-1">
                <span>Family Care &amp; Guardians</span>
            </div>
            <h1 class="font-serif font-bold text-2xl text-[var(--text-primary)]">Link Family Representative</h1>
            <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                Enable parents, siblings or family elders to review suitors, grant blessings, and participate in chaperoned messaging.
            </p>
        </div>
    </div>

    <!-- Active Linked Representatives -->
    <div class="card-ledger p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
            <h2 class="font-serif font-bold text-base text-[var(--text-primary)]">
                Designated Family Representatives
            </h2>
            <span class="text-xs text-[var(--text-muted)]">Always free of charge</span>
        </div>

        @if($representatives->isEmpty())
        <div class="p-8 text-center bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] text-xs text-[var(--text-muted)] border border-[var(--border-subtle)] space-y-1">
            <p class="font-semibold text-[var(--text-primary)]">Independent candidate mode active.</p>
            <p>You have not linked any family representatives. You can invite your parents or elders below.</p>
        </div>
        @else
        <div class="space-y-3">
            @foreach($representatives as $rep)
            <div class="p-4 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] flex items-center justify-between text-xs">
                <div>
                    <h3 class="font-serif font-bold text-sm text-[var(--text-primary)]">{{ $rep->representativeUser->name }}</h3>
                    <p class="text-[var(--secondary-text)] font-medium mt-0.5">
                        Relationship: {{ $rep->relationship }} &bull; Scope: 
                        <span class="font-semibold uppercase text-[var(--accent-primary)]">{{ str_replace('_', ' ', $rep->permission_scope) }}</span>
                    </p>
                    <p class="text-[var(--text-muted)] text-[11px] mt-0.5">
                        {{ $rep->representativeUser->email }} &bull; {{ $rep->representativeUser->phone }}
                    </p>
                </div>

                <form method="POST" action="{{ route('family.remove', $rep->id) }}" onsubmit="return confirm('Unlink this family representative?')">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] text-[var(--color-danger)] border border-[var(--color-danger-border)] hover:bg-red-100 font-semibold text-xs cursor-pointer transition">
                        Unlink
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Link New Representative Form -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
        <div class="pb-3 border-b border-[var(--border-subtle)]">
            <h2 class="font-serif font-bold text-base text-[var(--text-primary)]">
                Link an Elder or Family Member
            </h2>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">
                Family accounts are completely free for all parents and elders.
            </p>
        </div>

        <form method="POST" action="{{ route('family.link') }}" class="space-y-4 text-xs">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Full Name</label>
                    <input type="text" name="name" required placeholder="e.g. Subhash Chandra Mukherjee" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Relationship</label>
                    <select name="relationship" required class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Brother">Brother</option>
                        <option value="Sister">Sister</option>
                        <option value="Uncle">Uncle</option>
                        <option value="Aunt">Aunt</option>
                        <option value="Grandparent">Grandparent</option>
                        <option value="Elder">Family Elder</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Email Address</label>
                    <input type="email" name="email" required placeholder="elder@example.com" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Mobile Number</label>
                    <input type="text" name="phone" required placeholder="+88017XXXXXXXX" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1.5">Family Permission Scope</label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <label class="p-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] cursor-pointer hover:bg-[var(--bg-subtle)]">
                        <input type="radio" name="permission_scope" value="approval_required" checked class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <div class="mt-1">
                            <span class="font-semibold text-[var(--text-primary)] block">Approval Required</span>
                            <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Inbound proposals require family blessing before candidate chat unlocks.</span>
                        </div>
                    </label>

                    <label class="p-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] cursor-pointer hover:bg-[var(--bg-subtle)]">
                        <input type="radio" name="permission_scope" value="read_only_oversight" class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <div class="mt-1">
                            <span class="font-semibold text-[var(--text-primary)] block">Read-Only Oversight</span>
                            <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Can view proposals and discussions without blocking direct conversations.</span>
                        </div>
                    </label>

                    <label class="p-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] cursor-pointer hover:bg-[var(--bg-subtle)]">
                        <input type="radio" name="permission_scope" value="full_proxy" class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <div class="mt-1">
                            <span class="font-semibold text-[var(--text-primary)] block">Full Management</span>
                            <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Representative directly communicates and handles all proposals.</span>
                        </div>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full text-xs font-semibold !min-h-[42px] cursor-pointer">
                Save &amp; Link Family Representative
            </button>
        </form>
    </div>
</div>
@endsection
