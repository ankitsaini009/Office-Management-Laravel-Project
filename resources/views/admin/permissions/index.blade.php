@extends('admin.layouts.main')
@section('content')
<div class="container-fluid mt-4">
    <div class="row mt-4">
        <div class="col-sm-11 mt-5">
            @if(session()->has('success'))
            <div class="alert alert-success rounded-0 mx-1" role="alert" id="success-alert">
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
<div class="container-fluid col-md-12">
    <div class="main-panel ">
        <div class="grid-margin stretch-card" style="margin-right: 74px; padding-top: 30px;">
            <div class="card">
                <div class="card-body" style="margin-right: 2px;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3">Permission Management</h1>
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Add Permission
                        </a>
                    </div>

                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Permission Listing</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="rolesTable" class="table table-bordered table-hover text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Permission Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be loaded via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script type="text/javascript">
    var $jq = jQuery.noConflict();

    $jq(document).ready(function() {
        console.log('jQuery version:', $jq.fn.jquery);
        console.log('DataTables is available:', $jq.fn.DataTable ? 'Yes' : 'No');

        if ($jq.fn.DataTable) {
            $jq('#rolesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('permissions.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        } else {
            console.error('DataTable function not available.');
        }
    });
</script>
@endsection