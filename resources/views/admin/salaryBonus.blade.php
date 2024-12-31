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
          setTimeout(() => successAlert.remove(), 500); // Remove the element after fading out
        }, 3000); // 3 seconds delay
      }
    });
  </script>


  @if (auth()->user()?->role == 'HR' || auth()->user()?->role == 'Admin')
  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-6 stretch-card grid-margin">
          <div class="card bg-warning">
            <div class="card-body px-3 py-4">
              <div class="d-flex justify-content-between align-items-start">
                <div class="color-card">
                  <p class="mb-0 color-card-head">Total Employee</p>
                  <h2 class="text-white ml-5 mt-2 ">{{ $counttotal }}<span
                      class="h5"></span></h2>
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
                  <h2 class="text-white ml-5 mt-2">{{ $countWFO }}<span class="h5"></span>
                  </h2>
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
                  <h2 class="text-white ml-5 mt-2"> {{ $countWFH }}<span
                      class="h5"></span></h2>
                </div>
                <i
                  class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
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

      <div class="main-panel mt-5">
        <div class="grid-margin stretch-card" style="margin-right: 74px;padding-top: 30px;">
          <div class="card">
            <div class="card-body" style="margin-right: 2px;">
              <!-- Add Role Header -->
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-primary">Bonus Salary</h1>
                <a href="{{ route('employee.attendenceDeatailShow') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Back
                </a>
              </div>

              <form action="{{ route('employees.salaryBonusStore', $id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <!-- Role Name Input -->
                  <div class="col-md-6 mb-3">
                    <label for="bonus_name" class="form-label">Name <span
                        class="text-danger">*</span></label>
                    <input type="text" id="bonus_name" name="bonus_name"
                      class="form-control @error('bonus_name') is-invalid @enderror"
                      placeholder="Enter Bonus Name" required>
                    @error('bonus_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="bonus_salary" class="form-label"> Bonus Amout <span
                        class="text-danger">*</span></label>
                    <input type="number" id="bonus_salary" name="bonus_salary"
                      class="form-control @error('bonus_salary') is-invalid @enderror"
                      placeholder="Enter bonus salary	" required>
                    @error('bonus_salary')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="text-center ml-3">
                    <button type="submit" class=" btn btn-primary" style="margin-left: 427px;">
                      <i class="fas fa-save"></i> Save
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        {{-- Bonus Salary Table --}}
        <div class="main-panel">
          <div class="grid-margin stretch-card" style="margin-right: 74px; padding-top: 20px;">
            <div class="card">
              <div class="card-body" style="margin-right: 2px;">
                <div class="card">
                  <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Bonus List</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="bonusTable"
                        class="table table-bordered table-hover text-center">
                        <thead class="table-light">
                          <tr>
                            <th>Bonus Name</th>
                            <th>Bonus Salary</th>
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
  </div>
  @endif

  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <script type="text/javascript">
    var $jq = jQuery.noConflict();

    $jq(document).ready(function() {
      if ($jq.fn.dataTable) {
        $jq('#bonusTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('employees.salaryBonus', $id) }}",
          columns: [{
              data: 'bonus_name',
              name: 'bonus_name'
            },
            {
              data: 'bonus_salary',
              name: 'bonus_salary'
            }
          ]
        })
      }
    });
  </script>
  @endsection