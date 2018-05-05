@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Agendamentos
@endsection

@section('csspage')
    {{--{!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}--}}
    {{--{!! Html::style('plugins/datatables/jquery.dataTables.min.css') !!}--}}
@endsection
@section('contentheader_title')
    Agendamento de clientes
@endsection


@section('breadcrumb')
    <li>
        <a href="{!! url('welcome')!!}"><i class="fa fa-dashboard"></i>Inicial</a>
    </li>
    <li class="active">
        Listagem de Agendamentos

    </li>
@endsection
@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Agenda</h3>
                        <div class="pull-right">
                            <!-- Button trigger modal -->
                            <a href="#" data-toggle="modal" data-target="#createmodal"
                               class="btn btn-black btn-sm rounded-s"><i class="fa fa-plus icon"></i> Agendar novo
                                serviço </a>
                            @include("schedules._create")
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table-permission" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Dia</th>
                                <th>Horário</th>
                                <th>Observação</th>
                                <th>Opções</th>
                            </tr>
                            @forelse($services as $service)
                                <tr>
                                    <td>{!! $service->client->name !!}</td>
                                    <td>{!! \Carbon\Carbon::parse($service->scheduled_day)->format('d/m/Y')  !!}</td>
                                    <td>{!! $service->scheduled_hour !!}</td>
                                    <td>{!! $service->observation !!}</td>
                                    <td>
                                        <a href="{{ route('schedules.edit',$service)}}"
                                           class="btn btn-sm btn-warning"> <i class="fa fa-edit"
                                                                              aria-hidden="true"></i></a>
                                        <a href="{{ route('schedules.show',$service)}}"
                                           class="btn btn-sm btn-info"> <i class="fa fa-eye"
                                                                           aria-hidden="true"></i></a>
                                        @if($service->status == "waiting")
                                            <!-- <a href="{{ route('schedules.done',$service)}}"
                                               class="btn btn-sm btn-success pull-right"> <i class="fa fa-check"
                                                                               aria-hidden="true"></i></a>
                                            <strong class="pull-right" style="margin: 5px 15px 0 0">Marcar como concluído</strong> !-->
                                            <a href="#" data-toggle="modal" data-target="#createmodaldone"
                                               class="btn btn-black btn-sm rounded-s pull-right"><i class="fa fa-check"></i></a>
                                            @include("schedules._done")
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Nenhum registro foi encontrado!</td>
                                </tr>
                            @endforelse
                            </thead>
                            <tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('scriptpage')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
          rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            var input = document.querySelector('input');;
            input.addEventListener('input', function (){
                console.log(this.value);
            });
            formatReal($('#value_cash').val());
            function formatReal( int )
            {
                var tmp = int+'';
                tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
                if( tmp.length > 6 )
                    tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

                $('#value_cash').val(tmp);
            }
        })
    </script>
@endsection