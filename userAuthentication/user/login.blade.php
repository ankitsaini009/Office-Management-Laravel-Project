<!doctype html>

<html
    lang="en"
    class="light-style layout-wide customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assetss-path="../assetss/"
    data-template="vertical-menu-template-free"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dreamlockmr</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/dream.svg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="../assetss/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('/assetss/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('/assetss/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{url('/assetss/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('/assetss/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assetss/vendor/css/pages/page-auth.css" />

    <script src="{{url('/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="jquery-3.7.1.min.js"></script>
    <!-- Helpers -->
    <script src="{{url('/assetss/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{url('/assetss/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{url('/assetss/js/config.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-left">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('assets/images/dream.svg') }}" width="300px" hight="100px " alt="">
                                </span>

                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Welcome to login! 👋</h4>
                        <p class="mb-6">Please sign-in to your account and start the adventure</p>
                        <br>
                        @if(session()->has('success'))
                        <div class="alert alert-success" role="alert" id="success-alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session()->has('Error'))
                        <div class="alert alert-danger" role="alert" id="success-alert">
                            {{ session('Error') }}
                        </div>
                        @endif
                        <script>
                            setTimeout(function() {
                                var successAlert = document.getElementById('success-alert');
                                if (successAlert) {
                                    successAlert.style.display = 'none';
                                }
                            }, 4000);
                        </script>
                        <form id="loginform" method="POST" action="{{ route('user.auth') }}">
                            @csrf
                            <div class="input-group mb-4">
                                <span class="input-group-text border-end-0 inbg" id="basic-addon1"><i class="bi bi-person"></i></span>
                                <input type="email" class="form-control ps-2 border-start-0 fs-7 inbg form-control-lg mb-0" name="email" id="useremail" placeholder="Enter Email Address" aria-label="Email" aria-describedby="basic-addon1">
                            </div>
                            <p class="text-danger" id="useremailerror"></p>

                            <div class="input-group mb-4">
                                <span class="input-group-text border-end-0 inbg" id="basic-addon1"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control ps-2 fs-7 border-start-0 form-control-lg inbg mb-0" name="password" id="userpass" placeholder="Enter Password" aria-label="Password" aria-describedby="basic-addon1">
                            </div>
                            <p class="text-danger" id="userpasserror"></p>
                            @if(session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                            <button type="submit" class="btn btn-lg fw-bold fs-7 btn-primary w-100">Login</button>
                            <p class="text-center mt-3">
                                Don't have an account?
                                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#registerModal">
                                    Register
                                </button>
                            </p>
                        </form>
                    </div>
                </div>
                <!-- Register Modal -->
                <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="registerform" method="POST" action="{{route('user.register')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="username" name="name" required placeholder="Enter your name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="useremail" name="email" required placeholder="Enter your email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="userpassword" name="password" required placeholder="Enter your password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="work_type" class="form-label">Work Type</label>
                                        <select name="work_type" class="form-control" required>
                                            <option value="">Select Work Type</option>
                                            <option value="WFH">Work From Home</option>
                                            <option value="WFO">Work From Office</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userrole" class="form-label">Role</label>
                                        <select name="role" class="form-control" required>
                                            <option value="">Select Your Role</option>
                                            @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Core JS -->
    <!-- build:js assetss/vendor/js/core.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
    <script>
        $('#loginform').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting by default

            let useremail = $('#useremail').val().trim();
            let userpass = $('#userpass').val().trim();

            // Clear previous error messages
            $('#useremailerror').text('');
            $('#userpasserror').text('');

            let isValid = true;

            // Validate email
            if (useremail === "") {
                $('#useremailerror').text('*Please enter your email');
                isValid = false;
            } else {
                $('#useremailerror').text('');
            }

            // Validate password
            if (userpass === "") {
                $('#userpasserror').text('*Please enter your password');
                isValid = false;
            } else if (userpass.length < 8) {
                $('#userpasserror').text('Password must be at least 8 characters long');
                isValid = false;
            } else {
                $('#userpasserror').text('');
            }

            if (isValid) {
                // If the form is valid, submit it
                this.submit(); // This will allow the form to be submitted
            }
        });
    </script>
    <script src="{{url('/assetss/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{url('/assetss/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{url('/assetss/vendor/js/bootstrap.js')}}"></script>
    <script src="{{url('/assetss/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{url('/assetss/vendor/js/menu.js')}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{url('/assetss/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{url('/assetss/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{url('/assetss/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>