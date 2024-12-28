@extends('admin.layouts.main')
@section('content')
<br>
<!-- Info boxes -->
<div class="content-wrapper " style="min-height: 73.3672px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Site </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('index.sitting')}}">Site Settings</a></li>
                        <li class="breadcrumb-item active">Edit Site</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Site Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('update.sitting', $getsetting->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Site Name</label>
                                <input name="site_name" type="text" class="form-control" id="exampleInputEmail1" value="{{$getsetting->site_name}}">
                                @error('site_name')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Site Email</label>
                                <input name="site_email" type="email" class="form-control" id="subject" value="{{$getsetting->site_email}}">
                                @error('site_email')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">site Contact</label>
                                <input name="site_contact" type="text" class="form-control" id="subject" value="{{$getsetting->site_name}}">
                                @error('site_contact')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">AID</label>
                                <input name="AID" type="text" class="form-control" id="AID" value="{{$getsetting->AID}}">
                                @error('AID')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Anugaptydhay Name/Snstha</label>
                                <input name="anugapty_name_snstha" type="text" class="form-control" id="anugapty_name_snstha" value="{{$getsetting->anugapty_name_snstha}}">
                                @error('anugapty_name_snstha')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Anugaptydhary No</label>
                                <input name="anugapty_no" type="text" class="form-control" id="anugapty_no" value="{{$getsetting->anugapty_no}}">
                                @error('anugapty_no')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Anugaptydhary State</label>
                                <input name="anugapty_state" type="text" class="form-control" id="anugapty_state" value="{{$getsetting->anugapty_name_snstha}}">
                                @error('anugapty_state')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Anugaptydhary Phone</label>
                                <input name="anugapty_phone" type="text" class="form-control" id="anugapty_phone" value="{{$getsetting->anugapty_phone}}">
                                @error('anugapty_phone')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Site Address</label>
                                <input name="site_address" class="form-control" id="description" value="{{$getsetting->site_address}}">
                                @error('site_address')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Facebook url</label>
                                <input name="facebook_url" type="url" class="form-control" id="button_txt" value="{{$getsetting->facebook_url}}">
                                @error('facebook_url')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Twitter url</label>
                                <input name="twitter_url" type="url" class="form-control" id="button_txt" value="{{$getsetting->twitter_url	}}">
                                @error('twitter_url')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Insta url</label>
                                <input name="insta_url" type="url" class="form-control" id="button_txt" value="{{$getsetting->facebook_url}}">
                                @error('insta_url')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Linkdin url</label>
                                <input name="linkdin_url" type="url" class="form-control" id="button_txt" value="{{$getsetting->linkdin_url}}">
                                @error('linkdin_url')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Youtub url</label>
                                <input name="youtub_url" type="url" class="form-control" id="button_txt" value="{{$getsetting->youtub_url}}">
                                @error('youtub_url')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Site Fav Icon</label>
                                        <input name="favicon" type="file" class="form-control" id="button_txt">
                                        <input name="oldicon" type="hidden" class="form-control" value="">
                                        <img src="{{ asset('uploads/banners/'.$getsetting->site_fav_icon) }}" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Site Logo</label>
                                        <input name="sitelogo" type="file" class="form-control" id="button_txt">
                                        <input name="oldlogo" type="hidden" class="form-control" value="">
                                        <img src="{{ asset('uploads/banners/'.$getsetting->site_logo) }}" width="100px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection