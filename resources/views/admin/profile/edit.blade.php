@extends('admin.layouts.main')
@section('content')
<br>
<!-- Info boxes -->
<div class="content-wrapper" style="min-height: 110.177px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="{{route('index.profile')}}">Profile</a></li>
                        <li class="breadcrumb-item active ">Edit Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Profile Edit </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('update.profile', auth()->user()?->id )}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter  name" value="{{ auth()->user()?->name }}">
                                            @error('name')
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input name="email" type="email" class="form-control" id="subject" placeholder="Enter  email" value="{{ auth()->user()?->email }}">
                                            @error('email')
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Phone No</label>
                                            <input name="phoneno" type="number" class="form-control" id="button_txt" placeholder=" Enter Phone No" value="{{ auth()->user()?->phone_no }}">
                                            @error('phoneno')
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    @if(auth()->user()?->role !== "Admin")
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Status</label>
                                            <select name="status" class="form-control" id="status">
                                                <option value="">Select Status</option>
                                                <option value="1" {{auth()->user()?->status == 1 ? 'selected':''}}>Active</option>
                                                <option value="0" {{auth()->user()?->status == 0 ? 'selected':''}}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="work_type" class="form-label">Work Type</label>
                                            <select name="work_type" class="form-control" required>
                                                <option value="">Select Work Type</option>
                                                <option value="WFH" {{auth()->user()?->work_type == "WFH"?"selected":''}}>Work From Home</option>
                                                <option value="WFO" {{auth()->user()?->work_type == "WFH"?"selected":''}}>Work From Office</option>
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
                                            <label for="exampleInputPassword1">Bank Acount</label>
                                            <input name="bank_acount" type="number" placeholder="Enter Bank Acount Number" class="form-control" value="{{ auth()->user()?->bank_acount }}">
                                            @error('bank_acount')
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Address</label>
                                            <textarea name="address" type="text" placeholder="Enter Address" class="form-control">{{ auth()->user()?->Address }}</textarea>
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
                                            <input name="id_proof" type="file" class="form-control" value="">
                                            <img alt="Id Proof Img" src=" {{ asset('/uploads/banners/'. auth()->user()?->id_proof) }}" width="50px">
                                        </div>
                                    </div>
                                    @else
                                    <input type="hidden" name="status" value="2">
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Profile</label>
                                                    <input name="image" type="file" class="form-control" id="button_txt">
                                                    <input name="oldimage" type="hidden" class="form-control" value="image1702403051_91958.jpg">
                                                    <img alt="Profile Img" src=" {{ asset('/uploads/banners/'. auth()->user()?->Profile) }}" width="100px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection