@extends('layouts.app')

@section('title', 'Roles • CRM Portal')
@section('page-title', 'Roles Management')

@section('content')
<div class="content">
    <!-- FILTERS CARD -->
    <div class="card">
        <div class="card-header" style="cursor:pointer;" onclick="toggleFilters()">
            <div class="card-title">
                <span class="material-symbols-outlined" style="font-size:18px;">Filters</span>
            </div>
        </div>

        <div class="card-body" id="filterBody">
            <form method="get" action="">
                <div class="filter-grid">
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" name="search_name" class="form-control" placeholder="Search role..." value="{{ Request::get('search_name') }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="search_status">
                            <option value="">All status</option>
                            <option value="1" {{ Request::get('search_status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ Request::get('search_status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Records Per Page</label>
                        <select class="form-control" name="per_page">
                            <option value="10" {{ Request::get('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ Request::get('per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ Request::get('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ Request::get('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-primary">Search</button>
                    <a href="{{ url('admin/roles') }}" class="btn-outline">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Roles List</div>
            <a href="{{ url('roles/create') }}" class="btn-primary" style="height:34px;padding:0 14px;font-size:13px;display:inline-flex;align-items:center;gap:5px;text-decoration:none;">
                <span class="material-symbols-outlined" style="font-size:16px;">+</span>
                Create Role
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Replace with your @forelse loop --}}
                    <tr class="empty-row">
                        <td colspan="4" style="text-align:center;padding:40px;color:var(--text-muted);">
                            No records found
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <div>Showing 0 – 0 of 0 roles</div>
            <div>0</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleFilters() {
        const body = document.getElementById('filterBody');
        const icon = document.getElementById('filterIcon');
        if (body.style.display === 'none') {
            body.style.display = 'block';
            icon.textContent = 'expand_more';
        } else {
            body.style.display = 'none';
            icon.textContent = 'expand_less';
        }
    }
</script>
@endsection