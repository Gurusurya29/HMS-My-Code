@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OPERATION THEATRE" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">

            <div class="col-sm-6 mx-auto mb-1">
                @include('admin.operationtheatre.operationtheatrehelper.otnavbarhelper', [
                    'name' => 'otcalendar',
                ])
            </div>
            @can('OT-Calendar')
                <div class="bg-white shadow-sm p-4 mt-1 rounded" id='calendar'></div>
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            var calendar = $('#calendar').fullCalendar({

                editable: true,

                events: SITEURL + "/admin/otcalendar",

                displayEventTime: true,

                editable: true,

                displayEventTime: false,

                eventRender: function(event, element, view) {
                    element.css('background-color', '#3490dc');
                    element.css("color", "white");
                    element.popover({
                        animation: true,
                        delay: 300,
                        placement: 'top',
                        title: 'Surgery : ' + event.surgery_name,
                        content: 'Patient : ' + event.patient.name + ' (' + event.patient.uhid +
                            ') ' +
                            ' Surgeon : ' + event.doctor.name + ' (' + event.doctor.uniqid +
                            ') ' + '  Bed/Room No : ' +
                            event.bedorroomnumber.name,
                        trigger: 'hover'
                    });



                    if (event.allDay === 'true') {

                        event.allDay = true;

                    } else {

                        event.allDay = false;

                    }

                },

                selectable: true,

                selectHelper: true,

                eventClick: function(event) {

                    //  window.location.href = '/admin/wordpress/' + event.id;

                    window.location.href = '/admin/otschedulelist';

                }



            });

        });


        function displayMessage(message) {

            $(".response").html("<div class='success'>" + message + "</div>");

            setInterval(function() {
                $(".success").fadeOut();
            }, 1000);

        }
    </script>
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#ot_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')

    <style type="text/css">
        .hover-end {
            padding: 0;
            margin: 0;
            font-size: 75%;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
            opacity: .8
        }
    </style>
@endsection
