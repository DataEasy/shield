@extends('layout.main')

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-info alert-with-icon">
                    <span data-notify="message"> {{ $message }}</span>
                </div>
            </div>
        </div>
    </div>

@stop