@extends('admin.layouts.main')
@section('content')
<div class="container-fluid col-md-12">
  <div class="main-panel mt-5">
    <div class="grid-margin stretch-card" style="margin-right: 74px;padding-top: 30px;">
      <div class="card">
        <div class="card-body" style="margin-right: 2px;">
          <!-- Add Role Header -->
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary">Add New Employee</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
              <i class="fas fa-arrow-left"></i> Back
            </a>
          </div>

          <!-- Add Role Form -->
          <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <!-- Role ID (Hidden Input for Edit) -->
              <input type="hidden" name="employee_id" value="{{ isset($employee->id) ? $employee->id : '' }}">

              <!-- Role Name Input -->
              <div class="col-md-6 mb-3">
                <label for="employee_name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" id="employee_name" name="employee_name"
                  class="form-control @error('employee_name') is-invalid @enderror"
                  placeholder="Enter Employee Name"
                  value="{{old('name', optional($employee)->name)}}"
                  required>
                @error('employee_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="email" class="form-label"> Email <span class="text-danger">*</span></label>
                <input type="text" id="email" name="email"
                  class="form-control @error('email') is-invalid @enderror"
                  placeholder="Enter Employee Email"
                  value="{{old('employee_name', optional($employee)->email) }}"
                  required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="userrole" class="form-label">Role</label>
                <select name="role" class="form-control" required>
                  <option value="">Select Your Role</option>
                  @foreach(\Spatie\Permission\Models\Role::all() as $role)
                  <option value="{{ $role->name }}" {{ ($role->name == $employee?->role) ? "selected":'' }}>{{ $role->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control" id="status">
                    <option value="">Select Status </option>
                    <option value="0" {{ optional($employee)->status == '0' ? 'selected' : '' }}>Active</option>
                    <option value="1" {{ optional($employee)->status == '1' ? 'selected' : '' }}>Inactive</option>
                  </select>
                  @error('status')
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="work_type" class="form-label">Work Type <span class="text-danger">*</span></label>
                  <select name="work_type" class="form-control" id="status">
                    <option value="">Select Work Type</option>
                    <option value="WFO" {{ optional($employee)->work_type == "WFO" ? 'selected' : '' }}>WFO</option>
                    <option value="WFH" {{ optional($employee)->work_type == "WFH" ? 'selected' : '' }}>WFH</option>
                  </select>
                  @error('work_type')
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Bank Account</label>
                  <input
                    name="bank_acount"
                    type="number"
                    placeholder="Enter Bank Account Number"
                    class="form-control"
                    value="{{ old('bank_acount', $employee->bank_acount ?? '') }}">
                  @error('bank_acount')
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Employee Salary</label>
                  <input
                    name="salary"
                    type="number"
                    placeholder="Enter Employee salary"
                    class="form-control"
                    value="{{ old('salary', $employeeSalary->salary ?? '') }}">
                  @error('salary')
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Address</label>
                  <textarea
                    name="address"
                    placeholder="Enter Address"
                    class="form-control">{{ old('address', $employee->Address ?? '') }}</textarea>
                  @error('address')
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Id Proof</label>
                  <input
                    name="id_proof"
                    type="file"
                    class="form-control">
                  @if(!empty($employee->id_proof))
                  <img
                    alt="Id Proof Img"
                    src="{{ asset('/uploads/banners/' . $employee->id_proof) }}"
                    width="50px">
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Profile</label>
                  <input
                    name="image"
                    type="file"
                    class="form-control"
                    id="button_txt">
                  <input
                    name="oldimage"
                    type="hidden"
                    class="form-control"
                    value="{{ $employee->Profile ?? '' }}">
                  @if(!empty($employee->Profile))
                  <img
                    alt="Profile Img"
                    src="{{ asset('/uploads/banners/' . $employee->Profile) }}"
                    width="100px">
                  @endif
                </div>
              </div>

            </div>
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endsection