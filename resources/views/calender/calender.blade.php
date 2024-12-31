@extends('admin.layouts.main')
@section('content')


<div class="container-fluid col-md-11">
    <div class="main-panel mt-5">
        <br>
        <div class="row gx-3">
            <!-- Total Employee -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 stretch-card grid-margin">
                <div class="card bg-warning">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 color-card-head">Total Employee</p>
                                <h2 class="text-white ml-5 mt-2">{{ $counttotal ?? 0 }}</h2>
                            </div>
                            <i class="card-icon-indicator mdi mdi-basket bg-inverse-icon-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Office Work -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 stretch-card grid-margin">
                <div class="card bg-danger">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 color-card-head">Office Work</p>
                                <h2 class="text-white ml-5 mt-2">{{ $countWFO ?? 0 }}</h2>
                            </div>
                            <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Home -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 stretch-card grid-margin">
                <div class="card bg-primary">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 color-card-head">Home</p>
                                <h2 class="text-white ml-5 mt-2">{{ $countWFH ?? 0 }}</h2>
                            </div>
                            <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Other -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 stretch-card grid-margin">
                <div class="card bg-success">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 color-card-head">Other</p>
                                <h2 class="text-white ml-5 mt-2">{{ $countOther ?? 0 }}</h2>
                            </div>
                            <i class="card-icon-indicator mdi mdi-account-circle bg-inverse-icon-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-5">
            <div class="row">
                <div class="col-9 mb-2">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body p-4">
                                <a style="text-decoration: none;" class="editicon" href="http://localhost/ecommerce/admin/profile/edit.php?id=141">
                                </a>
                                <h3>Information</h3>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-3">
                                        <h4 class="mt-0">Profile image</h4>
                                        <img src="{{ asset('/uploads/banners/'. Auth::user()->Profile) }}" class="rounded-circle" alt="Avatar" width="100px">
                                    </div>
                                    <div class="col-3">
                                        <h4>Name</h4>
                                        <p class="text-muted">{{Auth::user()->name}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h4>Email</h4>
                                        <p class="text-muted">{{Auth::user()->email}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h4>Phone No.</h4>
                                        <p class="text-muted">{{Auth::user()->phone_no}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row pt-1 mb-3">
                                <div class="col-md-4  text-center " style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <h4 class="mt-3">Profile image</h4>
                                    <img src="{{ asset('/uploads/banners/'. Auth::user()->Profile) }}" class="w-px-150 h-auto rounded-circle" alt="Avatar" width="150px">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <button id="calenderToggle" class="col-12 btn btn-warning py-2 px-2 text-white my-4 mt-5"><i class="fa-solid fa-calendar-days px-2"></i> Attendence</button>
                </div>
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->

    </div>


    <!-- Calendar -->
    <div id="calendar_main" class="mt-0" style="
    padding-bottom: 120px;">
        <div class="bg-primary text-white px-2">
            <div class="container mt-5">
                <div class="row text-center">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 my-2">
                        <h2 class="mt-2"> <i class="fa-solid fa-calendar-days"></i> Calendar </h2>
                    </div>
                    <!-- Present -->
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 my-2">
                        <div class="card shadow-sm bg-success text-white mx-3">
                            <div class="card-body py-2">
                                <h4 class="m-0">P</h4>
                                <span>{{isset($attendenceDeatailShow) &&  $attendenceDeatailShow?->working_days ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Absent -->
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 my-2">
                        <div class="card shadow-sm bg-danger text-white mx-3">
                            <div class="card-body py-2">
                                <h4 class="m-0">A</h4>
                                <span>{{isset($attendenceDeatailShow) &&  $attendenceDeatailShow?->leave_days ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Half Day -->
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 my-2">
                        <div class="card shadow-sm bg-warning text-white mx-3">
                            <div class="card-body py-2">
                                <h4 class="m-0">HF</h4>
                                <span class="half-Day">{{isset($attendenceDeatailShow) &&  $attendenceDeatailShow?->half_days ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Total Salary -->
                    <!-- <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 my-2">
                        <div class="card shadow-sm bg-warning text-white mx-3">
                            <div class="card-body py-2">
                                <h5 class="m-0 mb-1">Total Salary</h5>
                                <span>{{isset($attendenceDeatailShow) &&  $attendenceDeatailShow?->total_salary ?? 0 }}</span>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div id="calender" class="border px-2"></div>
    </div>

</div>
</div>


<!-- Modal Structure -->
<div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="dateModalLabel">Choose An Option</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-auto">
                <ul class="list-inline" id="statusList">
                    <li class="border bg-success py-2 px-3 rounded text-white shadow list-inline-item" data-value="Present">
                        Punch In
                    </li>
                    <li class="border bg-success py-2 px-3 rounded text-white shadow list-inline-item" data-value="punch_out">
                        Punch out
                    </li>
                    <li class="border bg-danger py-2 px-3 rounded text-white shadow list-inline-item" data-value="Absent">
                        Absent
                    </li>
                    <li class="border rounded bg-warning shadow py-2 px-3 text-white list-inline-item" data-value="Half Day">
                        Halfday
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    let selectDate = null;
    let attendences = @json($attendences_data);

    // Apply styles based on attendance status
    function styleAttendenceDate(cell, title, attendence_time, punch_out) {
        if (title === "Present") {
            cell.css({
                'background-color': '#82e0aa',
                'text-align': 'center',
                'vertical-align': 'middle',
                'display': 'table-cell',
                'font-weight': 900,
                'font-size': '11px'
            }).html(`<h4>P</h4> Punch In: ${attendence_time} <br> Punch Out : ${punch_out} `);
        } else if (title === "Absent") {
            cell.css({
                'background-color': '#ec7063',
                'text-align': 'center',
                'vertical-align': 'middle',
                'display': 'table-cell',
                'font-weight': 900,
                'font-size': '11px'
            }).html(`<h4>A</h4>`);
        } else if (title === "Half Day") {
            cell.css({
                'background-color': '#f0b27a',
                'text-align': 'center',
                'vertical-align': 'middle',
                'display': 'table-cell',
                'font-weight': 900,
                'font-size': '11px'
            }).html(`<h4>H</h4> ${attendence_time} <br> ${punch_out} `);
        }
    }


    $('#calender').fullCalendar({
        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'month,agendaWeek, agendaDay',
            color: 'white',
        },
        //    events : attendences,
        selectable: true,
        selectHelper: true,
        select: function(start) {

            selectDate = moment(start).format('YYYY-MM-DD');
            let todayDate = moment().format('YYYY-MM-DD');
            let selectDay = moment(start).format('d');

            if (selectDay === '0') {
                Swal.fire({
                    text: "Attendance cannot be marked on Sundays. Please try on other days.",
                    icon: "warning",
                    timer: 2000,
                });

                //  Hide status popup model   
                $('#dateModal').modal('hide');
                return;
            } else if (selectDate !== todayDate) {
                Swal.fire({
                    text: "You can only mark attendance for today.",
                    icon: "warning",
                    timer: 2000,
                });

                //  Hide status popup model   
                $('#dateModal').modal('hide');
                return;
            }

            //  Show status popup model   
            $('#dateModal').modal('show');
        },

        dayRender: function(date, cell) {
            let selectDay = moment(date).format('YYYY-MM-DD');
            attendences.map(element => {

                // Attendence Time
                let attendence_time = new Date(element.created_at).toLocaleTimeString("en-IN", {
                    timeZone: "Asia/Kolkata",
                    hour: "2-digit",
                    minute: "2-digit",
                });

                // Punch Out Time
                let punch_out = new Date(element.punch_out).toLocaleTimeString("en-IN", {
                    timeZone: "Asia/Kolkata",
                    hour: "2-digit",
                    minute: "2-digit",
                });

                if (element.start === selectDay) {
                    styleAttendenceDate(cell, element.title, attendence_time, punch_out);
                }
            });
        }
    });

    // Select List Value
    $('#statusList').on('click', '.list-inline-item', async function() {
        let attendence = $(this).data('value');
        let user_id = "{{ Auth::user()->id }}";
        let punch_out;

        if (attendence === "punch_out") {
            punch_out = moment().format("YYYY-MM-DD hh:mm:ss");
        }

        let office_ip = '{{ $office_ip->ip }}';
        let user_ip = '{{ $user_ip }}';

        // alert(office_ip)
        // alert(user_ip)

        if (office_ip == user_ip) {
            try {
                // AJAX request
                await $.ajax({
                    'url': '{{ route("user.attendence") }}',
                    'method': 'post',
                    'data': {
                        user_id: user_id,
                        date: selectDate,
                        status: attendence,
                        punch_out: punch_out,
                        _token: '{{ csrf_token() }}',
                    }
                });

                let index = attendences.findIndex(data => data.start === selectDate);
                if (index !== -1) {
                    attendences[index].title = attendence;
                    attendences[index].punch_out = punch_out;
                } else {
                    attendences.push({
                        start: selectDate,
                        title: attendence,
                        punch_out: punch_out,
                        allDay: true
                    });
                }

                let cell = $(`.fc-day[data-date="${selectDate}"]`);
                // Attendence Time
                let attendence_time = new Date().toLocaleTimeString("en-IN", {
                    timeZone: "Asia/Kolkata",
                    hour: "2-digit",
                    minute: "2-digit",
                });

                styleAttendenceDate(cell, attendence, attendence_time, punch_out);

                Swal.fire({
                    text: `${attendence} Attendence saved successfully.`,
                    icon: "success",
                    timer: 2000
                });


                // Attendence Details Proccess
                let counts = attendences.reduce((acc, data) => {
                    acc[data.title] = (acc[data.title] || 0) + 1;
                    return acc;
                }, {});

                let present = counts["Present"] || 0;
                let absent = counts["Absent"] || 0;
                let halfDay = counts["Half Day"] || 0;

                $('.card.bg-success span').text(present);
                $('.card.bg-danger span').text(absent);
                $('.card.bg-warning span.half-Day').text(halfDay);

                $.ajax({
                    'url': '{{ route("employee.attendenceDeatail") }}',
                    'type': 'post',
                    'data': {
                        user_id: user_id,
                        working_days: present,
                        leave_days: absent,
                        half_days: halfDay,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        Swal.fire({
                            text: `Error saving attendance status....: ${error}`,
                            icon: "warning",
                            timer: 2000
                        });
                    }
                });

                // Hide popup model
                $('#dateModal').modal('hide');

            } catch (error) {
                // If any error occurs, show an error message
                Swal.fire({
                    text: `Error: ${error.responseText || error}`,
                    icon: "error",
                    timer: 2000
                });
            }

        } else {
            Swal.fire({
                text: "Error : You Are Not Abble For Attendence..!",
                icon: "error",
                timer: 2000
            });
        }
    });


    // Calender Hide/Show
    $('#calendar_main').hide();
    $("#calenderToggle").on('click', () => {
        $('#calendar_main').toggle();
    });
</script>
@endsection