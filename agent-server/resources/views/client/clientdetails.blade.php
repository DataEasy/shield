@extends('layout.main')

@section('content')

    <div class="content">
        <div class="container-fluid">

            @foreach($properties as $prop)

                @php( $cliProperties = json_decode($prop->config_properties, true))

                    <div class="col-lg-12 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Client Details</h4>
                            </div>

                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Client</label>
                                                <input type="text" class="form-control border-input" disabled value="{{ strtoupper($cliProperties['docflow.client']) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Environment</label>
                                                <input type="text" class="form-control border-input" disabled value="{{ $cliProperties['docflow.client.environment'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Version System</label>
                                                <input type="text" class="form-control border-input" disabled value="{{ $cliProperties['docflow.versao.sistema'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-12 col-md-7">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Config Properties</h4>
                        </div>

                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @foreach($cliProperties as $key => $value)
                                            @if ( ($key <> 'docflow.client') and ( $key <> 'docflow.client.cnpj') and ( $key <> 'docflow.client.environment') and ( $key <> 'docflow.versao.sistema') )
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ $key }}</label>
                                                        <input type="text" class="form-control border-input" disabled value="{{ $value }}">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                                </form>
                            </div>
                        </div>
                    </div>

            @endforeach
        </div>
    </div>





@stop
