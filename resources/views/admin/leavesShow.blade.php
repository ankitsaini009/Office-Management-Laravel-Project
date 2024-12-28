@extends('admin.layouts.main')
@section('content')

<div class="main-panel">
  {{-- Success Message Show --}}
  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-sm-11 mt-4 mx-2">
        @if (session()->has('success'))
        <div class="alert alert-success rounded-0 mx-2" role="alert" id="success-alert">
          {{ session('success') }}
        </div>
        @endif
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const successAlert = document.getElementById('success-alert');
      if (successAlert) {
        setTimeout(() => {
          successAlert.style.transition = "opacity 0.5s ease";
          successAlert.style.opacity = 0;
          setTimeout(() => successAlert.remove(), 500);
        }, 3000);
      }
    });
  </script>

  @if (auth()->user()?->role !== 'HR' || auth()->user()?->role !== 'Admin')
  <div class="container">
    {{-- Attendance Detail Table --}}
    <div style="margin-right:75px; padding-top: 20px;">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Leave List</h5>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4 px-3 py-2">
          <h1 class="h3">Leaves List</h1>
          <a href="{{ route('leave.Add') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add Leave
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="leavesTable" class="table table-bordered table-hover text-center">
              <thead class="table-light">
                <tr>
                  <th>Leave Type</th>
                  <th>Leave Reason</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>status</th>
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
  @else
  <div class="container-fluid">
    <div class="col-md-12">
      <h5 class="text-center">
        Hey, {{ auth()->guard('admin')->user()->role }}! Welcome to your Dashboard.
      </h5>
    </div>
  </div>
  @endif
</div>

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
            data: 'start_date',
            name: 'start_date'
          },
          {
            data: 'end_date',
            name: 'end_date'
          },
          {
            data: 'status',
            name: 'status',
            render: function(data, type, row) {
              if (data == 0) {
                return `<button class="border-0 badge badge-success">
                                    Pending</button>`;
              } else if (data == 1) {
                return ` <button class="badge badge-danger border-0">
                                    Rejected</button>`;
              } else if (data == 2) {
                return ` <button class="badge badge-info border-0">
                                Approved</button>`;
              }
            }
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