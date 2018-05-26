@extends('adminlte::layouts.app')

@section('htmlheader_title')

@endsection
@section('contentheader_title')
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-10 offset-md-1" id="calendario-row">
                {!! $calendar->calendar() !!}
                {!! $calendar->script() !!}
            </div>
        </div>
        <div class="row" style="margin-top: 50px; margin-bottom: 50px; ">
            <h2 style="text-align: center">Indicadores</h2>
            <div class="col-md-6">
                {!! $chartPayments->render() !!}
            </div>
            <div class="col-md-6" id="chart">
                {!! $chartReport->render() !!}
            </div>
        </div>
    </div>
@endsection
@section('scriptpage')
    <script>
        $(document).ready(function () {
            if ($(window).width() <= 426) {
                document.getElementsByClassName('fc-right')[0].style = "float: left; margin-top: 5px;"
                var calendarEl = document.getElementById('calendario-row')
                calendarEl.classList.remove('col-md-10')
                calendarEl.classList.remove('offset-md-1')
            }

            if ($(window).width() > 372) {
                document.getElementsByClassName('fc-right')[0].style = null
            }

            if ($(window).width() <= 972) {
                document.getElementById("chart").style = "margin-top: 30px;"
            }
            })
    </script>
@endsection
