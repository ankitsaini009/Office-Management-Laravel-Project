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
      <form action="{{ route('employees.salaryBonusStore', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <!-- Role Name Input -->
          <div class="col-md-6 mb-3">
            <label for="bonus_name" class="form-label">Bonus Name <span class="text-danger">*</span></label>
            <input type="text" id="bonus_name" name="bonus_name"
              class="form-control @error('bonus_name') is-invalid @enderror"
              placeholder="Enter Bonus Name"
              required>
            @error('bonus_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label for="bonus_salary" class="form-label"> Bonus Amout <span class="text-danger">*</span></label>
            <input type="number" id="bonus_salary" name="bonus_salary"
              class="form-control @error('bonus_salary') is-invalid @enderror"
              placeholder="Enter bonus salary	"
              required>
            @error('bonus_salary')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="text-center text-center">
            <button type="submit" class="btn btn-primary text-center">
              <i class="fas fa-save"></i> Save
            </button>
          </div>
      </form>
    </div>
  </div>
  @endif
  @endsection