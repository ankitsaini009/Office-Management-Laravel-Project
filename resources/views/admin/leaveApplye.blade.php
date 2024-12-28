@extends('admin.layouts.main')
@section('content')
<div class="container-fluid col-md-12">
  <div class="main-panel mt-5">
    <div class="grid-margin stretch-card" style="margin-right: 74px;padding-top: 30px;">
      <div class="card">
        <div class="card-body" style="margin-right: 2px;">
          <!-- Add Role Header -->
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary">Leave Form</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
              <i class="fas fa-arrow-left"></i> Back
            </a>
          </div>

          <!-- Add Leave Form -->
          <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <!-- Leave ID (Hidden Input for Edit) -->
              <input type="hidden" name="leave_id" value="{{ isset($leave->id) ? $leave->id : '' }}">


              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="leave_type" class="form-label">Leave Type<span class="text-danger">*</span></label>
                  <select name="leave_type" class="form-control" id="leave_type">
                    <option value="">Select Work Type</option>
                    <option value="Sick Leave" {{ optional($leave)->leave_type == "Sick Leave" ? 'selected' : '' }}>Sick Leave</option>
                    <option value="Casual Leave" {{ optional($leave)->leave_type == "Casual Leave" ? 'selected' : '' }}>Casual Leave</option>
                    <option value="Earned Leave" {{ optional($leave)->leave_type == "Earned Leave" ? 'selected' : '' }}>Earned Leave</option>
                  </select>
                  @error('leave_type')
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="leave_reason">Leave Reason</label>
                  <textarea
                    name="leave_reason"
                    placeholder="Enter Leave Reason"
                    class="form-control">{{ old('address', $leave->leave_reason ?? '') }}</textarea>
                  @error('address')
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Start date <span class="text-danger">*</span></label>
                <input type="date" name="start_date" id="start_date"
                  class="form-control @error('employee_name') is-invalid @enderror" value="{{ isset($leave) ? $leave->start_date : '' }}">
                @error('start_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">End date <span class="text-danger">*</span></label>
                <input type="date" name="end_date" id="end_date"
                  class="form-control @error('employee_name') is-invalid @enderror" value="{{ isset($leave) ? $leave->end_date : '' }}">
                @error('end_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <br>
              @if (auth()->user()?->role == 'HR' || auth()->user()?->role == 'Admin')
              <div class="col-md-6 mb-3 mt-4">
                <div class="form-group">
                  <label for="status" class="form-label">Leave Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control" id="status">
                    <option value="">Select Status </option>
                    <option value="0" {{ optional($leave)->status == '0' ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ optional($leave)->status == '1' ? 'selected' : '' }}>Rejected</option>
                    <option value="2" {{ optional($leave)->status == '2' ? 'selected' : '' }}>Approved</option>
                  </select>
                  @error('status')
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              @endif

            </div>

            <!-- Submit Button -->
            <div class="text-center">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

{{-- Bonus Salary Table --}}
<div class="main-panel">
  <div class="grid-margin stretch-card"
    style="margin-right: 74px; padding-top: 20px;">
    <div class="card">
      <div class="card-body" style="margin-right: 2px;">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Bonus List</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="leavesTable"
                class="table table-bordered table-hover text-center">
                <thead class="table-light">
                  <tr>
                    <th>Leave Type</th>
                    <th>Leave Reason</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Data will be loaded via AJAX -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script type="text/javascript">
  var $jq = jQuery.noConflict();

  $jq(document).ready(function() {
    if ($jq.fn.dataTable) {
      $jq('#leavesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('leaves.show')}}",
        columns: [{
            data: 'leave_type',
            name: 'leave_type'
          },
          {
            data: 'leave_reason',
            name: 'leave_reason'
          },
          {
            data: 'actions',
            name: 'actions',
            orderable: false,
            searchable: false
          },
        ]
      })
    }
  });
</script>

@endsection