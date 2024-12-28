@include('admin/layouts.header')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@else
<div class="alert" role="alert">
  {{ session('error') }}
</div>
@endif

@yield('content')
@include('admin/layouts.footer')
@yield('script')