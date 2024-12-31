<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Dreamlockmr</title>
  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <link rel="shortcut icon" href="{{ asset('assets/images/dream.svg') }}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


  {{-- font Awesome Icon CDN --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  {{-- Calender Cdn --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
</head>

<body>
  <div class="container-scroller">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
        <a class="sidebar-brand brand-logo" href="{{route('admin.dashboard')}}"><img src="{{ asset('assets/images/protocloud.png') }}" alt="logo" style="height: 130px;" /></a>
        <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{route('admin.dashboard')}}"><img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
      </div>
      <ul class="nav mt-5">
        <!-- <li class="nav-item nav-profile">
          <a href="{{route('admin.dashboard')}}" class="nav-link" style="
          margin-top: -18px;">
            <div class="nav-profile-image">
              <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
              <span class="login-status online"></span>
            </div>
            <div class="nav-profile-text d-flex flex-column pr-3">
              <span class="font-weight-medium mb-2">{{auth()->user()?->name}}</span>
            </div>
          </a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fa-solid fa-gauge menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>

        @if(auth()->user()?->role == "HR" || auth()->user()?->role == "Admin")
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            <span class="menu-title">Roles And Permissions</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('employee.attendenceDeatailShow')}}">
            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            <span class="menu-title">Salary</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('allleave.index')}}">
            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            <span class="menu-title">Leave</span>
          </a>
        </li>

        @endif

        @if (auth()->user()?->role !== 'HR' && auth()->user()?->role !== 'Admin')
        <li class="nav-item">
          <a class="nav-link" href="{{route('leave.index')}}">
            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            <span class="menu-title">Go Leave</span>
          </a>
        </li>
        @endif

        <li class="nav-item mt-2">
          <div class="mt-0">
            <a class="nav-link" href="{{route('admin.logout')}}">
              <i class="fa-solid fa-right-from-bracket menu-icon"></i>
              <span class="menu-title">Sign Out</span>
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div id="theme-settings" class="settings-panel">
        <i class="settings-close mdi mdi-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-default-theme">
          <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
          <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
          <div class="tiles light"></div>
          <div class="tiles dark"></div>
        </div>
      </div>
      <nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
          <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="index.html"><img src="assets/images/protocloud.png" alt="logo" /></a>
          <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
            <i class="mdi mdi-menu"></i>
          </button>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              @if(Auth::user()->role == "Admin" || Auth::user()->role == "HR")
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count count-varient1" id="userCount">0</span>
              </a>
              <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="notificationDropdown" id="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div id="notificationsList">
                  <!-- Notifications will be dynamically loaded here -->
                </div>
                <div class="dropdown-divider"></div>
                <div class="p-3">
                  <p class="mb-0">Total Last 2 Days Users: <span id="userCount2">0</span></p>
                </div>
              </div>
              @endif
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  const notificationDropdown = document.getElementById('notificationsList');
                  const userCount = document.getElementById('userCount');
                  const userCount2 = document.getElementById('userCount2');

                  // Fetch recent users
                  async function fetchNotifications() {
                    const response = await fetch('/admin/recent-users');
                    const data = await response.json();
                    const users = data.users;
                    const count = data.count;

                    notificationDropdown.innerHTML = ''; // Clear previous notifications
                    userCount.textContent = count; // Update user count

                    notificationDropdown.innerHTML = ''; // Clear previous notifications
                    userCount2.textContent = count; // Update user count

                    if (users.length === 0) {
                      notificationDropdown.innerHTML = '<p class="p-3 mb-0">No new users</p>';
                      return;
                    }

                    users.forEach(user => {
                      const notificationItem = document.createElement('div');
                      notificationItem.classList.add('dropdown-item', 'preview-item');
                      notificationItem.innerHTML = `
                          <div class="preview-thumbnail">
                              <img src="https://www.pngall.com/wp-content/uploads/12/Avatar-Profile-PNG-Photos.png" alt="" class="profile-pic" />
                          </div>
                          <div class="preview-item-content">
                              <p class="mb-0">${user.name}</p><span class="text-small text-muted">${user.role}</span>
                          </div>
                          <button style="display:none;" class="btn btn-danger btn-sm remove-btn" data-id="${user.id}">X</button>
                      `;
                      notificationDropdown.appendChild(notificationItem);

                      // Attach event to remove button
                      notificationItem.querySelector('.remove-btn').addEventListener('click', function() {
                        removeNotification(user.id, notificationItem);
                      });
                    });
                  }

                  // Remove a notification
                  async function removeNotification(userId, notificationItem) {
                    const response = await fetch(`/admin/remove-notification/${userId}`, {
                      method: 'POST',
                      headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                      },
                    });
                    const result = await response.json();

                    if (result.status === 'success') {
                      notificationItem.remove(); // Remove the notification from UI
                      userCount.textContent = parseInt(userCount.textContent) - 1; // Update count
                    }
                  }

                  // Initial fetch
                  fetchNotifications();
                });
              </script>
            </li>
            <!-- <li class="nav-item nav-search border-0 ml-1 ml-md-3 ml-lg-5 d-none d-md-flex">
              <form class="nav-link form-inline mt-2 mt-md-0">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" />
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="mdi mdi-magnify"></i>
                    </span>
                  </div>
                </div>
              </form>
            </li> -->
          </ul>
          <ul class="navbar-nav navbar-nav-right ml-lg-auto">
            <li class="nav-item nav-profile dropdown border-0">
              <a class="nav-link dropdown-toggle" style="margin-left: 90px" id="profileDropdown" href="#" data-toggle="dropdown">
                @if(!empty(Auth::user()->Profile))
                <img class="nav-profile-img mr-2" alt="" src="{{ asset('/uploads/banners/' . Auth::user()->Profile) }}" />
                @else
                <img class="nav-profile-img mr-2" alt="" src="https://www.pngall.com/wp-content/uploads/12/Avatar-Profile-PNG-Photos.png" />
                @endif
                <span class="profile-name">{{ auth::user()->role }}</span>
              </a>
              <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ route('index.profile') }}">
                  <i class="mdi mdi-cached mr-2 text-success"></i>Profile</a>
                <a class="dropdown-item" href="{{ route('admin.passchang') }}">
                  <i class="mdi mdi-cached mr-2 text-success"></i>Change Password</a>
                <a class="dropdown-item" href="{{route('admin.logout')}}">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      {{-- </div> --}}