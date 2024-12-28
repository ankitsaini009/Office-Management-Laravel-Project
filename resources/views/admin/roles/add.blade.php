@extends('admin.layouts.main')
@section('content')
<div class="container-fluid col-md-12">
    <div class="main-panel mt-5">
        <div class="grid-margin stretch-card" style="margin-right: 74px;padding-top: 30px;">
            <div class="card">
                <div class="card-body" style="margin-right: 2px;">
                    <!-- Add Role Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 text-primary">Employeess</h1>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <!-- Add Role Form -->
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Role ID (Hidden Input for Edit) -->
                            <input type="hidden" name="role_id" value="{{ isset($role) ? $role->id : '' }}">

                            <!-- Role Name Input -->
                            <div class="col-md-6 mb-3">
                                <label for="role_name" class="form-label">Role Name <span class="text-danger">*</span></label>
                                <input type="text" id="role_name" name="role_name"
                                    class="form-control @error('role_name') is-invalid @enderror"
                                    placeholder="Enter role name"
                                    value="{{ isset($role) ? $role->name : old('role_name') }}"
                                    required>
                                @error('role_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Permissions Selection
                            <div class="col-md-12">
                                <label for="permissions" class="form-label">
                                    Assign Permissions <span class="text-danger">*</span>
                                </label>
                            </div>

                            <div class="col-md-12 mb-3 px-4">
                                <div class="row">
                                    @foreach($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check px-3">
                                            <input type="checkbox"
                                                class="form-check-input"
                                                id="permission_{{ $permission->id }}"
                                                name="permissions[]"
                                                value="{{ $permission->name }}"
                                                {{ isset($role) && $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                {{ ucfirst($permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('permissions')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> -->
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ isset($role) ? 'Update Role' : 'Save Role' }}
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