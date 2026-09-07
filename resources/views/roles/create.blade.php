@extends('layouts.app')

@section('title', 'Create Role • CRM Portal')
@section('page-title', 'Create Role')

@section('content')
<style>
    .role-create-wrap {
        max-width: 1100px;
    }

    .page-header-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .page-header-row h1 {
        font-size: 22px;
        font-weight: 700;
        letter-spacing: -0.02em;
        margin: 0 0 4px;
    }

    .page-header-row p {
        font-size: 13.5px;
        color: var(--text-muted, #6b7280);
        margin: 0;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        height: 36px;
        padding: 0 14px;
        border-radius: 10px;
        background: rgba(255,255,255,0.55);
        border: 1px solid rgba(255,255,255,0.5);
        color: var(--text-muted, #6b7280);
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.15s;
    }
    .btn-back:hover {
        background: rgba(255,255,255,0.85);
        color: var(--text, #1e1b4b);
    }

    /* Role name card */
    .role-name-card .form-control {
        max-width: 420px;
        height: 42px;
        font-size: 14px;
    }

    /* Permissions header */
    .perm-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 16px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.4);
    }

    .perm-header h3 {
        font-size: 15px;
        font-weight: 600;
        margin: 0 0 2px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .perm-header p {
        font-size: 12.5px;
        color: var(--text-muted, #6b7280);
        margin: 0;
    }

    .perm-tools {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .perm-search {
        position: relative;
        width: 240px;
        max-width: 100%;
    }
    .perm-search input {
        width: 100%;
        height: 36px;
        padding: 0 12px 0 36px;
        border-radius: 9px;
        border: 1px solid rgba(0,0,0,0.08);
        background: rgba(255,255,255,0.7);
        font-size: 13px;
        font-family: inherit;
    }
    .perm-search input:focus {
        outline: none;
        border-color: #a78bfa;
        box-shadow: 0 0 0 3px rgba(124,58,237,0.12);
        background: #fff;
    }
    .perm-search .material-symbols-outlined {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #9ca3af;
    }

    .select-all-label {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
    }

    .perm-counter {
        font-size: 12.5px;
        font-weight: 600;
        background: rgba(124,58,237,0.12);
        color: #7c3aed;
        border-radius: 8px;
        padding: 6px 12px;
        white-space: nowrap;
    }

    /* Legend */
    .perm-legend {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        padding: 12px 20px 0;
        font-size: 12px;
        color: var(--text-muted, #6b7280);
    }
    .perm-legend span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .perm-legend i {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    /* Group grid */
    .group-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 14px;
        padding: 16px 20px 20px;
    }

    .perm-group {
        background: rgba(255,255,255,0.45);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 12px;
        overflow: hidden;
        transition: border-color 0.15s;
    }
    .perm-group.has-checked {
        border-color: rgba(124,58,237,0.35);
        background: rgba(124,58,237,0.04);
    }
    .perm-group.is-hidden { display: none; }

    .group-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 12px 14px;
        background: rgba(255,255,255,0.5);
        border-bottom: 1px solid rgba(255,255,255,0.4);
    }

    .group-title {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .group-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: rgba(124,58,237,0.12);
        color: #7c3aed;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .group-icon .material-symbols-outlined { font-size: 16px; }

    .group-name {
        font-size: 13.5px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .group-count {
        font-size: 11.5px;
        color: var(--text-muted, #6b7280);
    }

    .group-selectall {
        width: 16px;
        height: 16px;
        accent-color: #7c3aed;
        cursor: pointer;
        flex-shrink: 0;
    }

    .chip-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 12px 14px 14px;
    }

    .perm-chip {
        display: block;
        cursor: pointer;
        margin: 0;
    }
    .perm-chip input { display: none; }
    .perm-chip.is-hidden { display: none; }

    .chip-body {
        display: flex;
        align-items: center;
        gap: 7px;
        border: 1px solid rgba(0,0,0,0.08);
        border-left: 3px solid var(--action-color, #6b7280);
        border-radius: 8px;
        padding: 6px 11px 6px 9px;
        background: rgba(255,255,255,0.7);
        font-size: 12.5px;
        font-weight: 500;
        transition: all 0.12s;
        line-height: 1.3;
    }
    .perm-chip:hover .chip-body {
        border-color: rgba(0,0,0,0.15);
        transform: translateY(-1px);
    }
    .perm-chip input:checked + .chip-body {
        background: rgba(124,58,237,0.1);
        border-color: rgba(124,58,237,0.25);
        color: #7c3aed;
    }

    .chip-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--action-color, #6b7280);
        flex-shrink: 0;
    }

    /* Sticky action bar */
    .action-bar {
        position: sticky;
        bottom: 0;
        z-index: 10;
        margin-top: 8px;
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 14px;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        box-shadow: 0 -4px 24px rgba(0,0,0,0.04);
    }

    .action-bar-count {
        font-size: 13px;
        color: var(--text-muted, #6b7280);
    }
    .action-bar-count strong {
        color: var(--text, #1e1b4b);
        font-weight: 600;
    }

    .action-bar-btns {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    @media (max-width: 640px) {
        .perm-search { width: 100%; }
        .perm-tools { width: 100%; }
        .group-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="role-create-wrap">

    <!-- Header -->
    <div class="page-header-row">
        <div>
            <h1>Create Role</h1>
            <p>Define a new role and assign module permissions</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn-back">
            <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
            Back to Roles
        </a>
    </div>

    <form method="POST" action="{{ route('roles.store') }}" id="createRoleForm">
        @csrf

        <!-- Role Name -->
        <div class="card role-name-card" style="margin-bottom:20px;">
            <div class="card-body">
                <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">
                    Role Name <span style="color:#dc2626;">*</span>
                </label>
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name"
                    id="name"
                    maxlength="70"
                    value="{{ old('name') }}"
                    placeholder="e.g. Finance Manager"
                    oninput="this.value=this.value.replace(/[^a-zA-Z\s]/g,'')"
                    required>
                @error('name')
                    <div style="color:#dc2626;font-size:12.5px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Permissions -->
        <div class="card" style="margin-bottom:20px;">
            <div class="perm-header">
                <div>
                    <h3>
                        <span class="material-symbols-outlined" style="font-size:18px;color:#7c3aed;">key</span>
                        Permissions
                    </h3>
                    <p>Choose what this role can see and do, grouped by module</p>
                </div>
                <div class="perm-tools">
                    <div class="perm-search">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" id="permSearch" placeholder="Filter modules or permissions…">
                    </div>
                    <label class="select-all-label">
                        <input type="checkbox" id="checkAll" style="accent-color:#7c3aed;">
                        Select all
                    </label>
                    <span class="perm-counter" id="permCounter">0 selected</span>
                </div>
            </div>

            @error('permission')
                <div style="margin:12px 20px 0;padding:10px 14px;background:#fef2f2;border:1px solid #fecaca;border-radius:10px;color:#991b1b;font-size:13px;">
                    {{ $message }}
                </div>
            @enderror

            <div class="perm-legend">
                <span><i style="background:#2563eb;"></i> View / List</span>
                <span><i style="background:#16a34a;"></i> Create</span>
                <span><i style="background:#d97706;"></i> Edit</span>
                <span><i style="background:#dc2626;"></i> Delete</span>
                <span><i style="background:#6b7280;"></i> Other</span>
            </div>

            <div class="group-grid" id="groupGrid">
                @php
                    $icons = [
                        'role' => 'manage_accounts',
                        'user' => 'person',
                        'customer' => 'group',
                        'payout' => 'payments',
                        'channel-partners' => 'handshake',
                        'order' => 'shopping_bag',
                        'contactus' => 'chat',
                        'app-setup' => 'tune',
                        'banner' => 'image',
                        'advantages' => 'workspace_premium',
                        'product' => 'inventory_2',
                        'rating-reviews' => 'star',
                        'steps-join' => 'signpost',
                        'about-us' => 'info',
                        'country' => 'public',
                        'states' => 'map',
                        'cities' => 'location_city',
                        'documents' => 'description',
                        'privacy-policy-contents' => 'lock',
                        'privacy-policies' => 'shield',
                        'terms-conditions-contents' => 'article',
                        'terms-conditions' => 'gavel',
                        'return-policy-contents' => 'undo',
                        'return-policies' => 'receipt',
                        'refund-policy-contents' => 'currency_exchange',
                        'refund-policies' => 'replay',
                        'shipping-policy-contents' => 'local_shipping',
                        'shipping-policies' => 'local_shipping',
                        'cancellation-policy-contents' => 'cancel',
                        'cancellation-policies' => 'block',
                    ];
                    $assigned = old('permission', []);
                @endphp

                @foreach($permissions as $type => $group)
                    @php $icon = $icons[$type] ?? 'key'; @endphp
                    <div class="perm-group" data-group-name="{{ strtolower($type) }}">
                        <div class="group-head">
                            <div class="group-title">
                                <div class="group-icon">
                                    <span class="material-symbols-outlined">{{ $icon }}</span>
                                </div>
                                <div>
                                    <div class="group-name">{{ ucfirst(str_replace('-', ' ', $type)) }}</div>
                                    <div class="group-count">
                                        <span class="group-checked-count">0</span>/{{ count($group) }}
                                    </div>
                                </div>
                            </div>
                            <input type="checkbox" class="group-selectall" title="Select all in this module">
                        </div>
                        <div class="chip-list">
                            @foreach($group as $value)
                                @php
                                    $label = ucwords(str_replace('-', ' ', $value->name));
                                    $isChecked = in_array($value->id, $assigned);
                                    if (str_ends_with($value->name, '-list') || str_ends_with($value->name, '-view')) {
                                        $action = '#2563eb';
                                    } elseif (str_ends_with($value->name, '-create')) {
                                        $action = '#16a34a';
                                    } elseif (str_ends_with($value->name, '-edit')) {
                                        $action = '#d97706';
                                    } elseif (str_ends_with($value->name, '-delete')) {
                                        $action = '#dc2626';
                                    } else {
                                        $action = '#6b7280';
                                    }
                                @endphp
                                <label class="perm-chip" data-perm-name="{{ strtolower($label) }} {{ strtolower($value->name) }}">
                                    <input
                                        type="checkbox"
                                        name="permission[]"
                                        value="{{ $value->id }}"
                                        class="permission-checkbox"
                                        {{ $isChecked ? 'checked' : '' }}>
                                    <span class="chip-body" style="--action-color: {{ $action }};">
                                        <span class="chip-dot"></span>
                                        {{ $label }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sticky Action Bar -->
        <div class="action-bar">
            <div class="action-bar-count">
                <strong id="footerCounter">0</strong> permission(s) will be assigned
            </div>
            <div class="action-bar-btns">
                <a href="{{ route('roles.index') }}" class="btn-outline" style="text-decoration:none;">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-outlined" style="font-size:18px;">add</span>
                    Create Role
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkAll = document.getElementById('checkAll');
    const permissions = Array.from(document.querySelectorAll('.permission-checkbox'));
    const groups = Array.from(document.querySelectorAll('.perm-group'));
    const permCounter = document.getElementById('permCounter');
    const footerCounter = document.getElementById('footerCounter');
    const searchInput = document.getElementById('permSearch');

    function refreshCounts() {
        const checkedTotal = permissions.filter(p => p.checked).length;
        permCounter.textContent = checkedTotal + ' selected';
        footerCounter.textContent = checkedTotal;
        checkAll.checked = permissions.length > 0 && checkedTotal === permissions.length;

        groups.forEach(function (group) {
            const boxes = group.querySelectorAll('.permission-checkbox');
            const checked = Array.from(boxes).filter(b => b.checked).length;
            group.querySelector('.group-checked-count').textContent = checked;
            group.querySelector('.group-selectall').checked = boxes.length > 0 && checked === boxes.length;
            group.classList.toggle('has-checked', checked > 0);
        });
    }

    checkAll.addEventListener('change', function () {
        permissions.forEach(function (checkbox) {
            if (!checkbox.closest('.perm-chip').classList.contains('is-hidden')) {
                checkbox.checked = checkAll.checked;
            }
        });
        refreshCounts();
    });

    groups.forEach(function (group) {
        group.querySelector('.group-selectall').addEventListener('change', function () {
            group.querySelectorAll('.permission-checkbox').forEach(b => { b.checked = this.checked; });
            refreshCounts();
        });
    });

    permissions.forEach(function (checkbox) {
        checkbox.addEventListener('change', refreshCounts);
    });

    searchInput.addEventListener('input', function () {
        const term = this.value.trim().toLowerCase();
        groups.forEach(function (group) {
            const groupName = group.getAttribute('data-group-name');
            const chips = Array.from(group.querySelectorAll('.perm-chip'));
            let anyVisible = false;
            chips.forEach(function (chip) {
                const match = !term ||
                    groupName.includes(term) ||
                    chip.getAttribute('data-perm-name').includes(term);
                chip.classList.toggle('is-hidden', !match);
                if (match) anyVisible = true;
            });
            group.classList.toggle('is-hidden', !anyVisible);
        });
    });

    refreshCounts();
});
</script>
@endsection