@extends('layout.main')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-warning text-center">
                                        <i class="fa fa-user-friends"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Client</p>
                                        {{ $countClient  }}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <i class="ti-reload"></i> Updated
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-success text-center">
                                        <i class="fa fa-chart-bar"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Installed Versions</p>
                                        {{ $countVersion }}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <i class="ti-calendar"></i> Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-danger text-center">
                                        <i class="fa fa-cloud-upload-alt"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Last Update</p>
                                        {{ $lastUpdateDate }}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <i class="ti-timer"></i> Day of last update
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-info text-center">
                                        <i class="fa fa-code-branch"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Last Version</p>
                                        {{ $lastVersion }}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <i class="ti-reload"></i> Last installed version
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tables Cliente List -->

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Clients Versions System</h4>
                        <p class="category">Agent updated</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                            {{--<th>ID</th>--}}
                            <th>Name</th>
                            <th>Environment</th>
                            <th>Version</th>
                            <th>Updated Agent</th>
                            <th>Info</th>
                            </thead>
                            <tbody>
                                @foreach( $clients as $cli )
                                    <tr>
                                        {{--<td> {{ $cli->id }}</td>--}}
                                        <td> {{ strtoupper($cli->cli_name) }} </td>
                                        <td> {{ strtoupper($cli->cli_env) }} </td>
                                        <td> {{ $cli->cli_version_system }} </td>
                                        <td> {{ date('d.m.Y', strtotime($cli->updated_at)) }} </td>
                                        <td>
                                            <a href="/api/client/details/{{ $cli->id }}">
                                                <span class="fa fa-user-cog"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Versions Statistics (%)</h4>
                            <p class="category">List Versions Installed</p>
                        </div>
                        <div class="content">
                            <div id="versionBarChart" class="ct-chart ct-perfect-fourth"></div>

                            <div class="footer">
                                <hr>
                                <div class="stats">
                                    <i class="ti-timer"></i> Daily Updates
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-6">--}}
                    {{--<div class="card ">--}}
                        {{--<div class="header">--}}
                            {{--<h4 class="title">2015 Sales</h4>--}}
                            {{--<p class="category">All products including Taxes</p>--}}
                        {{--</div>--}}
                        {{--<div class="content">--}}
                            {{--<div id="chartActivity" class="ct-chart"></div>--}}

                            {{--<div class="footer">--}}
                                {{--<div class="chart-legend">--}}
                                    {{--<i class="fa fa-circle text-info"></i> Tesla Model S--}}
                                    {{--<i class="fa fa-circle text-warning"></i> BMW 5 Series--}}
                                {{--</div>--}}
                                {{--<hr>--}}
                                {{--<div class="stats">--}}
                                    {{--<i class="ti-check"></i> Data information certified--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

@stop

@section('content-script')

    <script type="text/javascript">

        $(function () {

            var dataSales = {
                labels: [
                    @foreach( $systemVersion as $svv)
                        '{{ $svv->version }}',
                    @endforeach
                ],
                series: [[
                    @foreach( $systemVersion as $svc)
                        {{ $svc->count }},
                    @endforeach
                ]]
            };

            var optionsSales = {
                lineSmooth: false,
                low: 0,
                high: {{ $systemVersionMax }},
                showArea: true,
                height: "245px",
                axisX: {
                    showGrid: false,
                },
                lineSmooth: Chartist.Interpolation.simple({
                    divisor: 0
                }),
                showLine: true,
                showPoint: false,
            };

            var responsiveSales = [
                ['screen and (max-width: 640px)', {
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return value[0];
                        }
                    }
                }]
            ];

            Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);


            var data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                series: [
                    [542, 543, 520, 680, 653, 753, 326, 434, 568, 610, 756, 895],
                    [230, 293, 380, 480, 503, 553, 600, 664, 698, 710, 736, 795]
                ]
            };

            var options = {
                seriesBarDistance: 10,
                axisX: {
                    showGrid: false
                },
                height: "245px"
            };

            var responsiveOptions = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return value[0];
                        }
                    }
                }]
            ];

            Chartist.Line('#chartActivity', data, options, responsiveOptions);

            // # BAR Char Versions (%)

            var dataBar = {
                labels: [
                    @foreach( $systemVersion as $sv)
                        '{{ $sv->version }}',
                    @endforeach
                ],
                series:[
                    @foreach( $systemVersion as $svc)
                    {{ round((100*$svc->count)/$sumVersions) }},
                    @endforeach
                ]
            };
            var distributeSeries = {
                distributeSeries: true
            };

            Chartist.Bar('#versionBarChart', dataBar, distributeSeries);
        });

    </script>



@stop