@extends('admin.layouts.main')
@section('content')
<!-- Info boxes -->
<div class="content-wrapper mt-5" style="min-height: 110.177px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @if(session()->has('success'))
                    <div class="alert alert-success" role="alert" id="success-alert">
                        {{ session('success') }}
                    </div>
                    @endif
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{Auth::user()->role}} Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                        <li class="breadcrumb-item"><a href="{{route('editpro.profile')}}">Edit Profile</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="card col-12">
            <div class="row g-0">
                <div class="col-md-4  text-center " style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                    <h3 class="mt-5">Profile image</h3>
                    <img src="{{ asset('/uploads/banners/'. Auth::user()->Profile) }}" class="w-px-150 h-auto rounded-circle" alt="Avatar" width="178px">
                </div>
                <div class="col-md-8">
                    <div class="card-body p-4">
                        <a style="text-decoration: none;" class="editicon" href="http://localhost/ecommerce/admin/profile/edit.php?id=141">
                        </a>
                        <h3>Information</h3>
                        <hr class="mt-0 mb-4">
                        <div class="row pt-1">
                            <div class="col-6 mb-3">
                                <h4>Name</h4>
                                <p class="text-muted">{{Auth::user()->name}}</p>
                            </div>
                            <div class="col-6 mb-3">
                                <h4>Email</h4>
                                <p class="text-muted">{{Auth::user()->email}}</p>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-6 mb-3">
                                <h4>Your Role</h4>
                                <p class="text-muted">{{Auth::user()->role}}</p>
                            </div>
                            <div class="col-6 mb-3">
                                <h4>Phone No.</h4>
                                <p class="text-muted">{{Auth::user()->phone_no}}</p>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-12 mb-3">
                                <h4>Social Media Handels</h4>
                                <div class="d-flex">
                                    <p><a href="#" class="h3" target="_blank"><i class="fa-brands fa-facebook col-2"></i></a></p>
                                    <a href="#" class="h3" target="_blank"><i class="fa-brands fa-instagram col-2 "></i></a>
                                    <p></p>
                                    <p></p>
                                    <p><a href="#" class="h3" target="_blank"><i class="fa-brands fa-twitter col-2 "></i></a></p>
                                    <p><a href="#" class="h3" target="_blank"><i class="fa-brands fa-youtube col-2 "></i></a></p>
                                    <p><a href="#" class="h3" target="_blank"><i class="fa-brands fa-linkedin col-2 "></i></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->

    <!-- /.content -->
</div>
@endsection