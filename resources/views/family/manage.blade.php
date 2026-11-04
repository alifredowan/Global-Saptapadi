@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center space-x-1.5 text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">
                <span>👥</span>
                <span>Family Representative Delegation</span>
            </div>
            <h1 class="font-heading font-bold text-2xl text-gray-900">Link Family Representative</h1>
            <p class="text-xs text-gray-500 mt-1">
                Empower your parents or elders to review proposals, approve suitors, and provide chaperoned oversight.
            </p>
        </div>
    </div>

    <!-- Active Linked Representatives -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
        <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
            <span>🛡️</span>
            <span>Your Designated Family Representatives</span>
        </h2>

        @if($representatives->isEmpty())
        <div class="p-8 text-center bg-amber-50/40 rounded-xl text-xs text-gray-500">
            <strong>Independent Mode Active:</strong> You currently have no family representatives linked. You manage your proposals and communications independently.
        </div>
        @else
        <div class="space-y-3">
            @foreach($representatives as $rep)
            <div class="p-4 rounded-xl border border-amber-200 bg-amber-50/20 flex items-center justify-between text-xs">
                <div>
                    <h3 class="font-bold text-sm text-gray-900">{{ $rep->representativeUser->name }}</h3>
                    <p class="text-amber-900 font-semibold mt-0.5">
                        Relationship: {{ $rep->relationship }} • Permission Scope: 
                        <span class="text-red-900 font-bold uppercase">{{ str_replace('_', ' ', $rep->permission_scope) }}</span>
                    </p>
                    <p class="text-gray-500 text-[11px] mt-0.5">
                        {{ $rep->representativeUser->email }} • {{ $rep->representativeUser->phone }}
                    </p>
                </div>

                <form method="POST" action="{{ route('family.remove', $rep->id) }}" onsubmit="return confirm('Unlink this family representative?')">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-lg border border-red-200 bg-red-50 text-red-800 hover:bg-red-100 font-bold text-[11px]">
                        Unlink
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Link New Representative Form -->
    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-amber-200 shadow-sm space-y-4">
        <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
            <span>➕</span>
            <span>Link an Elder or Family Member</span>
        </h2>
        <p class="text-xs text-gray-500">
            Family representative accounts are <strong>perpetually 100% free</strong> forever.
        </p>

        <form method="POST" action="{{ route('family.link') }}" class="space-y-4 text-xs">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Representative Full Name</label>
                    <input type="text" name="name" required placeholder="e.g. Subhash Chandra Mukherjee" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Relationship</label>
                    <select name="relationship" required class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 bg-white">
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Brother">Brother</option>
                        <option value="Sister">Sister</option>
                        <option value="Uncle">Uncle</option>
                        <option value="Aunt">Aunt</option>
                        <option value="Grandparent">Grandparent</option>
                        <option value="Elder">Extended Family Elder</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Email Address</label>
                    <input type="email" name="email" required placeholder="elder@example.com" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Mobile Number</label>
                    <input type="text" name="phone" required placeholder="+88017XXXXXXXX" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800">
                </div>
            </div>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1">Permission Scope (FR-5.2)</label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <label class="p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-amber-50/50">
                        <input type="radio" name="permission_scope" value="approval_required" checked class="text-red-900">
                        <div class="mt-1">
                            <span class="font-bold text-gray-900 block">Approval Required</span>
                            <span class="text-[10px] text-gray-500 block">Inbound proposals require family blessing before candidate chat unlocks.</span>
                        </div>
                    </label>

                    <label class="p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-amber-50/50">
                        <input type="radio" name="permission_scope" value="read_only_oversight" class="text-red-900">
                        <div class="mt-1">
                            <span class="font-bold text-gray-900 block">Read-Only Oversight</span>
                            <span class="text-[10px] text-gray-500 block">Can view proposals and chaperoned discussions without blocking.</span>
                        </div>
                    </label>

                    <label class="p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-amber-50/50">
                        <input type="radio" name="permission_scope" value="full_proxy" class="text-red-900">
                        <div class="mt-1">
                            <span class="font-bold text-gray-900 block">Full Proxy Management</span>
                            <span class="text-[10px] text-gray-500 block">Representative directly sends and manages all proposals.</span>
                        </div>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl gold-gradient text-white font-bold text-xs shadow hover:opacity-95 transition">
                Save & Link Family Representative
            </button>
        </form>
    </div>
</div>
@endsection

