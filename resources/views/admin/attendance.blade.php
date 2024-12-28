@extends('admin.layouts.main')
@section('content')
<div class="main-panel">
  {{-- Success Message Show --}}
  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-sm-11 mt-4 mx-2">
        @if(session()->has('success'))
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
          setTimeout(() => successAlert.remove(), 500); // Remove the element after fading out
        }, 3000); // 3 seconds delay
      }
    });
  </script>


  @if(auth()->user()?->role == "HR" || auth()->user()?->role == "Admin")
  <div class="container-fluid">
    <div class="col-md-12 mx-auto">
      <div class="row" style="
       margin-right: 90px;">
        <div class="col-xl-3 col-lg-3 col-md-6 stretch-card grid-margin">
          <div class="card bg-warning">
            <div class="card-body px-3 py-4">
              <div class="d-flex justify-content-between align-items-start">
                <div class="color-card">
                  <p class="mb-0 color-card-head">Total Employee</p>
                  <h2 class="text-white ml-5 mt-2 ">{{ $counttotal }}<span class="h5"></span></h2>
                </div>
                <i class="card-icon-indicator mdi mdi-basket bg-inverse-icon-warning"></i>
              </div>
              <h6 class="text-white"></h6>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 stretch-card grid-margin">
          <div class="card bg-danger">
            <div class="card-body px-3 py-4">
              <div class="d-flex justify-content-between align-items-start">
                <div class="color-card">
                  <p class="mb-0 color-card-head">Office Work</p>
                  <h2 class="text-white ml-5 mt-2">{{ $countWFO }}<span class="h5"></span></h2>
                </div>
                <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
              </div>
              <h6 class="text-white"></h6>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 stretch-card grid-margin">
          <div class="card bg-primary">
            <div class="card-body px-3 py-4">
              <div class="d-flex justify-content-between align-items-start">
                <div class="color-card">
                  <p class="mb-0 color-card-head">Home</p>
                  <h2 class="text-white ml-5 mt-2"> {{ $countWFH }}<span class="h5"></span></h2>
                </div>
                <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
              </div>
              <h6 class="text-white"></h6>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 stretch-card grid-margin">
          <div class="card bg-success">
            <div class="card-body px-3 py-4">
              <div class="d-flex justify-content-between align-items-start">
                <div class="color-card">
                  <p class="mb-0 color-card-head">Other</p>
                  <h2 class="text-white ml-5 mt-2">{{ $counttotal }}</h2>
                </div>
                <i class="card-icon-indicator mdi mdi-account-circle bg-inverse-icon-success"></i>
              </div>
              <h6 class="text-white"></h6>
            </div>
          </div>
        </div>
      </div>
      <div class="main-panel">
        <div class="grid-margin stretch-card" style="margin-right: 74px; padding-top: 20px;">
          <div class="card">
            <div class="card-body" style="margin-right: 2px;">
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">Attendance List</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive table-responsive-md">
                    <table id="attendanceTable" class="table table-bordered table-hover text-center">
                      <thead class="table-light">
                        <tr>
                          <th>Employee Name</th>
                          <th>role</th>
                          <th>Date</th>
                          <th>Punch In</th>
                          <th>Punch Out</th>
                          <th>Status</th>
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
    </div>
  </div>
  @else
  <div class="container-fluid">
    <div class="col-md-12 mx-auto">
      <h5 class="text-center">
        Hey.. {{ auth()->guard('admin')->user()->role }} Well-Come To Your Dashboard
      </h5>
    </div>
  </div>
  @endif
  
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

  <script type="text/javascript">
    var $jq = jQuery.noConflict();

    $jq(document).ready(function() {
      if ($jq.fn.DataTable) {
        $jq('#attendanceTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('employee.attendanceShow', $user_id) }}",
          columns: [{
              data: 'user.name',
              name: 'user.name'
            },
            {
              data: 'user.role',
              name: 'user.role'
            },
            {
              data: 'date',
              name: 'date'
            },
            {
              data: 'created_at',
              name: 'created_at',
              render: function(data) {
                return moment(data).format('hh:mm:ss A');
              }
            },
            {
              data: 'punch_out',
              name: 'punch_out',
              render: function(data) {
                return moment(data).format('hh:mm:ss A');
              }
            },
            {
              data: 'status',
              name: 'status'
            }
          ]
        });
      }
    });

    $jq('#salaryTable').on('change', '.payment-status', function() {
      let newStatus = $jq(this).val();
      let user_id = $jq(this).data('id');

      $.ajax({
        'url': '{{ route("employee.updateSalaryPayStatus") }}',
        'method': 'post',
        'data': {
          user_id: user_id,
          pay_status: newStatus,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          alert('Payment status updated successfully!');
          table.ajax.reload(); // Reload the data in case there are any updates
        },
        error: function(xhr, status, error) {
          alert('Error updating payment status');
        }
      });
    });
  </script>
  @endsection