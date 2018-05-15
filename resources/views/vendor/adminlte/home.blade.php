@extends('adminlte::layouts.app')

@section('htmlheader_title')

@endsection
@section('contentheader_title')
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                {!! $calendar->calendar() !!}
                {!! $calendar->script() !!}
            </div>
        </div>
        <div class="row" style="margin-top: 50px; margin-bottom: 50px; ">
            <h2 style="text-align: center">Indicadores</h2>
            <div class="col-md-6">
                {!! $chartPayments->render() !!}
            </div>
            <div class="col-md-6">
                {!! $chartReport->render() !!}
            </div>
        </div>
    </div>
@endsection
@section('scriptpage')
@endsection
