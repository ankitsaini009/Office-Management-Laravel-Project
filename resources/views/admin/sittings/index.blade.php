@extends('admin.layouts.main')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>Laravel Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <br>
    <!-- Info boxes -->
    <div class="content-wrapper" style="min-height: 110.177px;">
        <!-- Content Header (Page header) -->
        <div class="content-wrapper" style="min-height: 53.3672px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Site Settings</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Site Settings</li>
                                <li class="breadcrumb-item"><a href="{{route('editpro.sitting')}}">Edit Sites</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="row">
                <div class="card col-12">
                    <div class="row g-0">
                        <div class="col-md-4  text-center " style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <h3 class="mt-5">Site Logo</h3>
                            <img src="{{ asset('uploads/banners/'.$getsetting->site_logo) }}" class="img-circle elevation-2" style="width: 100px;" alt="Avatar">

                            <h3 class="mt-5">Site Fav-Icon</h3>
                            <img src="{{ asset('uploads/banners/'.$getsetting->site_fav_icon) }}" class="img-circle elevation-2" style="width: 100px;" alt="Avatar">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <a style="text-decoration: none;" class="editicon" href="http://localhost/ecommerce/admin/settings/edit.php?id=1">
                                </a>
                                <h3>Information</h3>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h4>Site Name</h4>
                                        <p class="text-muted">{{$getsetting->site_name}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h4>Site Email</h4>
                                        <p class="text-muted">{{$getsetting->site_email}}</p>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h4>Site Contact</h4>
                                        <p class="text-muted">{{$getsetting->site_contact}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h4>Site Address</h4>
                                        <p class="text-muted">{{$getsetting->site_address}}</p>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-12 mb-3">
                                        <h4>Social Media Handels</h4>
                                        <div class="d-flex">
                                            <p><a href="{{$getsetting->facebook_url}}" class="h3" target="_blank"><i class="fa-brands fa-facebook col-2 "></i></a></p>
                                            <a href="{{$getsetting->insta_url}}" class="h3" target="_blank"><i class="fa-brands fa-instagram col-2"></i></a>
                                            <p></p>
                                            <p></p>
                                            <p><a href="{{$getsetting->twitter_url}}" class="h3" target="_blank"><i class="fa-brands fa-twitter col-2"></i></a></p>
                                            <p><a href="{{$getsetting->youtub_url}}" class="h3" target="_blank"><i class="fa-brands fa-youtube col-2"></i></a></p>
                                            <p><a href="{{$getsetting->linkdin_url}}" class="h3" target="_blank"><i class="fa-brands fa-linkedin col-2"></i></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

</body>
@endsection