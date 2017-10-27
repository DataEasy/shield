@extends('layout.main')

@section('conteudo')
    <div class="row">

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $countversion }}</h3>
                    <p>Versões Instaladas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $countclient  }} </h3>
                    <!-- <sup style="font-size: 20px">%</sup></h3> -->
                    <p>Clientes Ativos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $lastupdate_date }}</h3>
                    <p>Última Atualização</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-stopwatch-outline"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $lastversion }}</h3>
                    <p>Versão Mais Recente</p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="box box-default">
        <div class="box-header with-border">
            <i class="fa fa-bar-chart-o"></i>
            <h3 class="box-title">Versões - Instaladas</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
            </div>
        </div>
        <div class="box-body">
            <div id="bar-chart" style="height: 300px;"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Versões - Clientes</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Cliente</th>
                            <th>Ambiente</th>
                            <th>Versão</th>
                            <th>Agent Update - Date</th>
                            <th>Agent Update - Time</th>
                            <th>Configuração</th>
                        </tr>

                        @foreach( $listclient as $lc)

                        <tr>
                            <td>{{ $lc->cli_name }}</td>

                            @if ( $lc->cli_env == "PRODUCTION" )
                                <td><span class="label label-primary">{{ $lc->cli_env }}</span></td>
                            @elseif( $lc->cli_env == "HOMOLOGATION" )
                                <td><span class="label label-info">{{ $lc->cli_env }}</span></td>
                            @elseif( $lc->cli_env == "TRAINING" || $lc->cli_env == "DEMO" )
                                <td><span class="label label-default">{{ $lc->cli_env }}</span></td>
                            @endif

                            <td>{{ $lc->cli_version_system }}</td>
                            <td>{{ date('d / M / Y', strtotime($lc->updated_at)) }}</td>
                            <td>{{ date('H:i:s', strtotime($lc->updated_at)) }}</td>
                            <!-- <td></td> -->
                            <td>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#{{ $lc->id }}">
                                    <i class="ion ion-android-options"></i>
                                </button>
                            </td>
                        </tr>

                        @endforeach
                    </table>
                    @foreach( $listclient as $lc)
                        <div class="modal fade" id="{{ $lc->id }}">
                            <div class="modal-body">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Cliente: {{ $lc->cli_name }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $lc->config_properties }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>

                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    @endforeach
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

@stop

@section('javascript')
<script>
    $(function () {
        /*
        * BAR CHART
        * ---------
        */
        var bar_data = {
                //data : [['January', 100], ['February', 8], ['March', 4], ['April', 13], ['May', 17], ['June', 9]],
                data : [
                        @foreach( $systemversion as $sv)
                            ['{{ $sv->version }}', {{ $sv->count }}],
                        @endforeach
                    ],
                color: '#2156bc'
            }
        $.plot('#bar-chart', [bar_data], {
            grid  : {
                borderWidth: 1,
                borderColor: '#f3f3f3',
                tickColor  : '#f3f3f3'
            },
            series: {
                bars: {
                show    : true,
                barWidth: 0.5,
                align   : 'center'
            }
        },
            xaxis : {
                mode      : 'categories',
                tickLength: 0
            }
        })
        /* END BAR CHART */
    })

    /*
    * Custom Label formatter
    * ----------------------
    */
    function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + '<br>'
        + Math.round(series.percent) + '%</div>'
    }
</script>
@stop