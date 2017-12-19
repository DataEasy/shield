@extends('layout.mainresume')

@section('resume')

    <pre>
        @foreach($properties as $key => $value)
                {{ $key }} : {{ $value }}
        @endforeach
    </pre>

@stop
