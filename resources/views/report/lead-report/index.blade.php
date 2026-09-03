@extends('layouts.app')

@section('title', 'Lead Report • CRM Portal')
@section('page-title', 'Lead Report')
@section('content')
<!-- Content -->
<div class="content">
    <!-- FILTERS CARD -->
    <div class="card">
        <div class="card-header" style="cursor:pointer;" onclick="toggleFilters()">
            <div class="card-title">
                <span class="material-symbols-outlined" style="font-size:18px;">filter_list</span>
                Filters
            </div>
        </div>

        <div class="card-body" id="filterBody">
            <div class="filter-grid">
                <div class="form-group">
                    <label>Team Lead</label>
                    <select class="form-control" multiple size="1">
                        <option></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Counsellor</label>
                    <select class="form-control" multiple size="1">
                        <option></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status Combination</label>
                    <select class="form-control">
                        <option>All Combinations</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Lead Status</label>
                    <select class="form-control" multiple size="1">
                        <option></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Source</label>
                    <select class="form-control" multiple size="1">
                        <option></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Course</label>
                    <select class="form-control">
                        <option>All Courses</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select class="form-control">
                        <option>All States</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select class="form-control">
                        <option>All Cities</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Search address...">
                </div>
                <div class="form-group">
                    <label>Interested Date</label>
                    <input type="text" class="form-control" placeholder="Select date range">
                </div>
                <div class="form-group">
                    <label>Creation Date</label>
                    <input type="text" class="form-control" placeholder="Select date range">
                </div>
                <div class="form-group">
                    <label>Last Update</label>
                    <input type="text" class="form-control" placeholder="Select date range">
                </div>
                <div class="form-group">
                    <label>Next Action Date</label>
                    <input type="text" class="form-control" placeholder="Select date range">
                </div>
                <div class="form-group">
                    <label>Lead Name</label>
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
                    <label>Alternate Email</label>
                    <input type="text" class="form-control" placeholder="Alternate email...">
                </div>
                <div class="form-group">
                    <label>Alternate Mobile</label>
                    <input type="text" class="form-control" placeholder="Alternate mobile...">
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
        <div class="card-header">
            <div class="card-title">Showing 0 – 0 of 0 leads</div>
            <button class="btn-primary" style="height:34px;padding:0 14px;font-size:13px;">
                Lead Transfer
            </button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Sr.No</th>
                        <th>Team Leader</th>
                        <th>Counsellor Name</th>
                        <th>Lead Name </th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Alt Contact</th>
                        <th>Alt Email</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Dob</th>
                        <th>Qualification</th>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Source</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>University</th>
                        <th>Course</th>
                        <th>Specialization</th>
                        <th>Media</th>
                        <th>Campaign</th>
                        <th>Lead Creation Date</th>
                        <th>Lead Creation Time</th>
                        <th>Last Update Date</th>
                        <th>Last Update Time</th>
                        <th>Next Action Date</th>
                        <th>Next Action Time</th>
                        <th>Status</th>
                        <th>Status details</th>
                        <th>Remark</th>
                        <th>History</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="empty-row">
                        <td colspan="34">No records found</td>
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