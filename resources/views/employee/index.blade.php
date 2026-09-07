@extends('layouts.app')
@section('title', 'Employee • CRM Portal')
@section('page-title', 'Employees Management')
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
            <div class="filter-grid">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Search name...">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Search email...">
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Search mobile...">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control">
                        <option value="">All status</option>
                        <option value="1" {{Request::get('search_status') == '1' ? 'selected' : ''}}>Active</option>
                        <option value="0" {{Request::get('search_status') == '0' ? 'selected' : ''}}>Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Records Per Page</label>
                    <select class="form-control">
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
            </div>

            <div class="filter-actions">
                <button class="btn-primary">Search</button>
                <button class="btn-outline">Reset</button>
            </div>
        </div>
    </div>
    <!-- TABLE CARD -->
    <div class="card">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="empty-row">
                        <td colspan="7">No records found</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <div>Showing 0 – 0 of 0 leads</div>
            <div>0</div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection