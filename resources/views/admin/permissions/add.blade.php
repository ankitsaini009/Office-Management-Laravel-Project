@extends('admin.layouts.main')
@section('content')
<div class="container-fluid col-md-12">
    <div class="main-panel mt-5">
        <div class="grid-margin stretch-card" style="margin-right: 74px;padding-top: 30px;">
            <div class="card">
                <div class="card-body" style="margin-right: 2px;">
                    <!-- Add Role Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 text-primary">Add New Permission</h1>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <!-- Add Role Form -->
                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Role ID (Hidden Input for Edit) -->
                            <input type="hidden" name="permission_id" value="{{ isset($permission) ? $permission->id : '' }}">

                            <!-- Role Name Input -->
                            <div class="col-md-6 mb-3">
                                <label for="Permission_name" class="form-label">Permission Name <span class="text-danger">*</span></label>
                                <input type="text" id="Permission_name" name="Permission_name"
                                    class="form-control @error('Permission_name') is-invalid @enderror"
                                    placeholder="Enter Permission name"
                                    value="{{ isset($permission) ? $permission->name : old('Permission_name') }}"
                                    required>
                                @error('Permission_name')
                                <div class="text-danger">{{ $Permission_name }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ isset($role) ? 'Update Permission' : 'Save Permission' }}
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