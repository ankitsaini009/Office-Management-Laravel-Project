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
      <div class="row col-md-12 mx-auto">
        <form action="{{ route('saveip') }}" method="POST">
          @csrf
          <input type="hidden" value="{{isset($office_ip)? $office_ip->id : ''}}" name="ip_id">
          <div class="form-group">
            <label for="ip_address"><strong>Office IP Address: </strong></label>
            <input type="text" class="form-control" id="ip_address" value="{{isset($office_ip)? $office_ip->ip : ''}}" name="ip_address" placeholder="Enter IP address" required>
          </div>
          <button type="submit" class="btn btn-primary">Save IP</button>
        </form>

      </div>


      <div class="main-panel">
        <div class="grid-margin stretch-card" style="margin-right: 74px; padding-top: 20px;">
          <div class="card">
            <div class="card-body" style="margin-right: 2px;">
              <h1>{{ auth()->guard('admin')->user()->role }}</h1>
              @if(auth()->user()?->role == "HR" || auth()->user()?->role == "Admin")
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">Registered Employees</h1>
                <a href="{{ route('employee.add') }}" class="btn btn-primary">
                  <i class="fa-solid fa-plus"></i> Add Employee
                </a>
              </div>
              @endif
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">Employee List</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="rolesTable" class="table table-bordered table-hover text-center">
                      <thead class="table-light">
                        <tr>
                          <th>Employee Name</th>
                          <th>Email</th>
                          <th>role</th>
                          <th>Work Type</th>
                          <th>Status</th>
                          <th>Actions</th>
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

      @include('calender.calender')
    </div>
  </div>
  @endif
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <script type="text/javascript">
    var $jq = jQuery.noConflict();
    let user = "{{ auth()->user()->role === 'HR' || $user = auth()->user()->role === 'Admin'}}";

    $jq(document).ready(function() {
      console.log('jQuery version:', $jq.fn.jquery);
      console.log('DataTables is available:', $jq.fn.DataTable ? 'Yes' : 'No');

      if ($jq.fn.DataTable) {
        $jq('#rolesTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('admin.dashboard') }}",
          columns: [{
              data: 'name',
              name: 'name'
            },
            {
              data: 'email',
              name: 'email'
            },
            {
              data: 'role',
              name: 'role'
            },
            {
              data: 'work_type',
              name: 'work_type',
            },
            {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
                if (data == 1) {
                  return `<button class="border-0 badge badge-success" onclick="employeeStatus('${row.id}') ${user ? '' : 'disabled'}">
                            Active</button>`;
                } else {
                  return ` <button class="badge badge-danger border-0" onclick="employeeStatus('${row.id}')" ${user ? '' : 'disabled'}>
                            Inactive</button>`;
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
        });
      } else {
        console.error('DataTable function not available.');
      }
    });

    // Employee Status Change Active & Inactive
    function employeeStatus(employee_id) {
      //alert('hallo');

      $jq.ajax({
        url: "{{ route('employee.status') }}",
        type: 'POST',
        data: {
          id: employee_id
        },
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(response) {
          window.location.reload();
          const statusBadge = $jq(`#rolesTable`).find(`button[onclick="employeeStatus('${employee_id}')"] span`);
          if (response.status == 1) {
            statusBadge.removeClass('badge-danger').addClass('badge-success').text('Active');
          } else {
            statusBadge.removeClass('badge-success').addClass('badge-danger').text('Inactive');
          }
        }
      });
    }
  </script>
  @endsection