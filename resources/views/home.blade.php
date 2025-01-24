@extends('layouts.app')

@section('content')
    <style>
        .eventsUI {
            text-align: center;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/main.css') }}">

    <div class="container" style="max-width: 100%">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="{{ route('todayReport') }}">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $todayCount }}</h3>

                                <p>Today</p>
                            </div>
                            {{-- <div class="icon">
                                <i class="ion" style="font-size: 15px; color: white;text-align: right">
                                    District Court: {{ $todayCountRegion['district'] }} <br />High Court:
                                    {{ $todayCountRegion['high'] }}</i>
                            </div> --}}
                        </div>
                    </a>

                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <a href="{{ route('pastReport') }}">

                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $pastCount }}<sup style="font-size: 15px"></sup></h3>
                                <p>Past</p>
                            </div>
                            {{-- <div class="icon">
                                <i class="ion" style="font-size: 15px; color: white;text-align: right">
                                    District Court: {{ $pastCountRegion['district'] }} <br />High Court:
                                    {{ $pastCountRegion['high'] }}</i>
                            </div> --}}
                        </div>
                    </a>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="{{ route('futureReport') }}">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $futureCount }}</h3>
                                <p>Future</p>
                            </div>
                            {{-- <div class="icon">
                                <i class="ion" style="font-size: 15px; color: black;text-align: right">
                                    District Court: {{ $futureCountRegion['district'] }} <br />High Court:
                                    {{ $futureCountRegion['high'] }}</i>
                            </div> --}}
                        </div>
                    </a>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="{{ route('recordRoomReport') }}">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $recordRoomCount }}</h3>
                                <p>Record Room</p>
                            </div>
                            {{-- <div class="icon">
                                <i class="ion" style="font-size: 15px; color: white;text-align: right">
                                    District Court: {{ $roomRecordCountRegion['district'] }} <br />High Court:
                                    {{ $roomRecordCountRegion['high'] }}</i>
                            </div> --}}
                        </div>
                    </a>
                </div>
            </div>
            <!-- /.col -->
            <form method="post" style="display: none" action="{{ route('postDateWiseCaseReport') }}">
                @csrf
                <input type="hidden" name="startDate" id="startDate" value="">
                <input type="hidden" name="endDate" id="endDate" value="">
                <input type="submit" id="formSubmit">
            </form>
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div class="row">
                            <div class="col-md-7">
                                <div id="calendar"></div>
                            </div>
                            <div class="col-md-5 text-center" >  
                                <div class="col-md-12 mt-4" style="top: 20%">
                                    <div>
                                        <div class="card-body text-center" >
                                            <h2 class=" text-center">AdvocaseeNgp</h2>
                                            <div>&nbsp;</div>
                                            <div class="text-center">
                                                <h4>
                                                    <ul>Contact Us</ul>
                                                </h4>
                                                <h5><a class="text-decoration-none"
                                                        href="mailto:rahuldhanorkar4798@gmail.com">umabhattad4@gmail.com</a>
                                                </h5>
                                            </div>
                                            <div>&nbsp;</div>
                                            <div class="text-center">
                                                <h4>
                                                    <ul>Contact Number</ul>
                                                </h4>
                                                <h5><i class="fa fa-phone"></i>
                                                    +91 9890008158</h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    @push('scripts')
        <script src="{{ asset('/plugins/fullcalendar/main.js') }}"></script>
        <script>
            var pushdata = [];

            function getData(value) {
                var date = new Date(value);
                var FirstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                var LastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    data: {
                        firstDay: new Date(FirstDay).toLocaleDateString('en-CA'),
                        lastDay: new Date(LastDay).toLocaleDateString('en-CA'),
                    },
                    success: function(data) {
                        console.log("data", data);
                        pushdata.push(data)
                    }
                });
            }
            $(function() {
                var caseObj = {!! json_encode($cases) !!};
                let newObj = [];
                caseObj.map((item, i) => {
                    newObj.push({
                        title: item.caseCount,
                        start: item.caseDate,
                        allDay: true,
                        // display: 'background',
                        classNames: ['eventsUI'],
                    })
                })
                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date()
                var d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear()

                var Calendar = FullCalendar.Calendar;

                var calendarEl = document.getElementById('calendar');

                var calendar = new Calendar(calendarEl, {
                    // customButtons: {
                    //     prev: {
                    //         text: 'Prev',
                    //         click: function(date) {
                    //             calendar.prev();
                    //             var curdate = calendar.currentData.currentDate; 
                    //             console.log("calendar.currentData.currentDate", calendar
                    //                 .currentData
                    //                 .currentDate);
                    //         }
                    //     },
                    //     next: {
                    //         text: 'Next',
                    //         click: function() {
                    //             calendar.next();
                    //             var curdate = calendar.currentData.currentDate;
                    //             getData(curdate);

                    //             console.log("calendar", calendar.currentData.currentDate);
                    //             // alert("NEXT button executed")
                    //         }
                    //     },
                    // },
                    eventClick: function(info) {
                        let yourDate = new Date(info.event.start);
                        const offset = yourDate.getTimezoneOffset()
                        yourDate = new Date(yourDate.getTime() - (offset * 60 * 1000))
                        const formattedDate = yourDate.toISOString().split('T')[0];
                        $('#startDate').val(formattedDate);
                        $('#endDate').val(formattedDate);
                        $('#formSubmit').click();
                        // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                        // alert('View: ' + info.view.type);
                        // window.location.href = "google.com"
                        // change the border color just for fun
                        info.el.style.borderColor = 'red';
                    },
                    headerToolbar: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
                    fixedWeekCount: false,
                    eventStartEditable: false,
                    themeSystem: 'bootstrap',
                    events: newObj,
                    editable: true,
                    dayRenderInfo: function(date, cell) {

                        var today = new Date();
                        var end = new Date();
                        end.setDate(today.getDate() + 7);

                        if (date.getDate() === today.getDate()) {
                            cell.css("background-color", "red");
                        }

                        if (date > today && date <= end) {
                            cell.css("background-color", "yellow");
                        }

                    }
                });

                calendar.render();
            })
        </script>
    @endpush
@endsection
