@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="DASHBOARD" />
@endsection

@section('main-content')
    @can('Dashboard')
        <div class="card col-sm-12 mx-auto border-0">
            <div class="card-body bg-light p-0">
                @livewire('admin.patientregistration.inpatientlist.inpatientlistlivewire')
            </div>
        </div>
    @endcan
@endsection
@section('footerSection')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'New Patient', 'Out Patient', 'In Patient'],
                ["{{ $chat[0]['date'] }}",
                    {{ $chat[0]['newpatient'] }},
                    {{ $chat[0]['outpatient'] }},
                    {{ $chat[0]['inpatient'] }}
                ],
                ["{{ $chat[1]['date'] }}",
                    {{ $chat[1]['newpatient'] }},
                    {{ $chat[1]['outpatient'] }},
                    {{ $chat[1]['inpatient'] }}
                ],
                ["{{ $chat[2]['date'] }}",
                    {{ $chat[2]['newpatient'] }},
                    {{ $chat[2]['outpatient'] }},
                    {{ $chat[2]['inpatient'] }}
                ],
                ["{{ $chat[3]['date'] }}",
                    {{ $chat[3]['newpatient'] }},
                    {{ $chat[3]['outpatient'] }},
                    {{ $chat[3]['inpatient'] }}
                ],
                ["{{ $chat[4]['date'] }}",
                    {{ $chat[4]['newpatient'] }},
                    {{ $chat[4]['outpatient'] }},
                    {{ $chat[4]['inpatient'] }}
                ],
                ["{{ $chat[5]['date'] }}",
                    {{ $chat[5]['newpatient'] }},
                    {{ $chat[5]['outpatient'] }},
                    {{ $chat[5]['inpatient'] }}
                ],
                ["{{ $chat[6]['date'] }}",
                    {{ $chat[6]['newpatient'] }},
                    {{ $chat[6]['outpatient'] }},
                    {{ $chat[6]['inpatient'] }}
                ],
            ]);

            var options = {
                chart: {
                    title: 'Patient Visit Last 7 Days',
                    subtitle: 'New Patient, Out Patient, In Patient',
                },
                bars: 'vertical',
                colors: ['#1b9e77', '#4285f4', '#7570b3']
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>


    //
    <script type="text/javascript">
        //     google.charts.load('current', {
        //         packages: ["orgchart"]
        //     });
        //     google.charts.setOnLoadCallback(drawChart);

        //     function drawChart() {
        //         var data = new google.visualization.DataTable();
        //         data.addColumn('string', 'Name');
        //         data.addColumn('string', 'Manager');
        //         data.addColumn('string', 'ToolTip');

        //         // For each orgchart box, provide the name, manager, and tooltip to show.
        //         data.addRows([
        //             [{
        //                     'v': 'Mike',
        //                     'f': 'Mike<div style="color:red; font-style:italic">President</div>'
        //                 },
        //                 '', 'The President'
        //             ],
        //             [{
        //                     'v': 'Jim',
        //                     'f': 'Jim<div style="color:red; font-style:italic">Vice President</div>'
        //                 },
        //                 'Mike', 'VP'
        //             ],
        //             ['Alice', 'Mike', ''],
        //             ['Bob', 'Jim', 'Bob Sponge'],
        //             ['Carol', 'Bob', '']
        //         ]);

        //         // Create the chart.
        //         var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        //         // Draw the chart, setting the allowHtml option to true for the tooltips.
        //         chart.draw(data, {
        //             'allowHtml': true
        //         });
        //     }
        //
    </script>

    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#dashboard_sidenav',
    ])
@endsection
