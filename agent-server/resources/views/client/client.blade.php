@extends('layout.main')

@section('content')

    <div class="content">
        <div class="container-fluid">

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Clients Versions System</h4>
                        <p class="category">Agent updated</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Environment</th>
                            <th>Version</th>
                            <th>Updated Agent</th>
                            <th>Info</th>
                            </thead>
                            <tbody>
                            @foreach( $clients as $cli )
                                <tr>
                                    <td> {{ $cli->id }}</td>
                                    <td> {{ strtoupper($cli->cli_name) }} </td>
                                    <td> {{ strtoupper($cli->cli_env) }} </td>
                                    <td> {{ $cli->cli_version_system }} </td>
                                    <td> {{ date('d.m.Y', strtotime($cli->updated_at)) }} </td>
                                    <td>
                                        <a href="/api/client/details/{{ $cli->id }}">
                                            <span class="ti-settings"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop