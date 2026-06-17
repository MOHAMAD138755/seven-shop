@extends('DashboardAdmin.layout.layout')


@section('title', 'Chart')

@section('content')

    {!! $my_chart->container() !!}
    <script src="{{ $my_chart->cdn() }}"></script>
    {{ $my_chart->script() }}

@endsection
