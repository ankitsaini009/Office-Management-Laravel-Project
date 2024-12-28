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
    <div class="row">
      <!-- Total Employee Card -->
      <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
        <div class="card bg-warning">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="mb-0 text-white">Total Employee</p>
                <h3 class="text-white">{{ $counttotal }}</h3>
              </div>
              <i class="mdi mdi-basket display-4 text-white"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- Office Work Card -->
      <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
        <div class="card bg-danger">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="mb-0 text-white">Office Work</p>
                <h3 class="text-white">{{ $countWFO }}</h3>
              </div>
              <i class="mdi mdi-cube-outline display-4 text-white"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- Work From Home Card -->
      <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
        <div class="card bg-primary">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="mb-0 text-white">Home</p>
                <h3 class="text-white">{{ $countWFH }}</h3>
              </div>
              <i class="mdi mdi-briefcase-outline display-4 text-white"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- Other Card -->
      <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
        <div class="card bg-success">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="mb-0 text-white">Other</p>
                <h3 class="text-white">{{ $counttotal }}</h3>
              </div>
              <i class="mdi mdi-account-circle display-4 text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Salary Table Section -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Salary List</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="salaryTable" class="table table-bordered table-hover text-center">
                <thead class="table-light">
                  <tr>
                    <th>Employee Name</th>
                    <th>Role</th>
                    <th>Salary</th>
                    <th>Month</th>
                    <th>Working Days</th>
                    <th>Leave Days</th>
                    <th>Half Days</th>
                    <th>Calculate Salary</th>
                    <th>Salary Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Data will be loaded dynamically via AJAX -->
                </tbody>
              </table>
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
        $jq('#salaryTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('employee.attendenceDeatailShow') }}",
          columns: [{
              data: 'user.name',
              name: 'user.name'
            },
            {
              data: 'user.role',
              name: 'user.role'
            },
            {
              data: 'salary.salary',
              name: 'salary.salary'
            },
            {
              data: 'month',
              name: 'month'
            },
            {
              data: 'working_days',
              name: 'working_days'
            },
            {
              data: 'leave_days',
              name: 'leave_days'
            },
            {
              data: 'half_days',
              name: 'half_days',
            },
            {
              data: 'total_salary',
              name: 'total_salary'
            },
            {
              data: 'pay_status', // Assuming 'payment_status' is a column in your data
              render: function(data, type, row) {
                return `
                    <select class="payment-status" data-id="${row.user_id}">
                        <option value="1" ${data == 1 ? 'selected' : ''}>Payment Done</option>
                        <option value="0" ${data == 0 ? 'selected' : ''}>Not Done</option>
                    </select>
                `;
              }
            },
            {
              data: 'actions',
              name: 'actions',
              orderable: false,
              searchable: false
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