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
            <div class="pull-right">
                {!! Form::open(['url'=>route('schedules.filterByDate'),
                                'enctype'=> 'multipart/form-data',
                                'file'=>'true',
                                'id' => 'form-filter']) !!}
                {!! Form::date('filter_date',null,['id'=>'filter', 'class' => 'form-control']) !!}
                {!! Form::close() !!}
            </div>
            <div class="pull-right" style="margin: 0 10px 30px 0">
                {!! Form::label('filter_date','Selecionar dia: ') !!}
            </div>
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
                    <div class="box-body table-responsive">
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
                                        {!! Form::open(['url' => route('schedules.destroy', $service),'method' => 'delete','id' => 'form-destroy'.$service->id]) !!}

                                        {!! Form::close() !!}
                                        <a href="{{ route('schedules.edit',$service)}}"
                                           class="btn btn-sm btn-warning"> <i class="fa fa-edit"
                                                                              aria-hidden="true"></i></a>
                                        <a href="{{ route('schedules.show',$service)}}"
                                           class="btn btn-sm btn-info"> <i class="fa fa-eye"
                                                                           aria-hidden="true"></i></a>
                                        <button type="submit"
                                                class="btn btn-sm btn-danger btn-circle submit-destroy" value={{$service->id}}><i
                                                    class="fa fa-close"></i>
                                        </button>

                                        @if($service->status == "waiting")
                                        <!-- <a href="{{ route('schedules.done',$service)}}"
                                               class="btn btn-sm btn-success pull-right"> <i class="fa fa-check"
                                                                               aria-hidden="true"></i></a>
                                            <strong class="pull-right" style="margin: 5px 15px 0 0">Marcar como concluído</strong> !-->
                                            <a href="#" id="done" data-toggle="modal" data-target="#createmodaldone"
                                               class="btn btn-black btn-sm rounded-s pull-right"><i
                                                        class="fa fa-check"></i></a>
                                            @include("schedules._done")
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Nenhum registro foi encontrado!</td>
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
            $("#value_cash").on('input', function () {
                if ($("#value_cash").val() !== "") {
                    $("#value_credit").prop('required', false)
                }
            });

            $("#filter").change('on', function () {
                $('#form-filter').submit();
            });

            $(".submit-destroy").on('click', function () {
                $('#form-destroy'+this.value).submit();
            });

            if (screen.width < 560) {
                var doneElement = document.getElementById('done')
                doneElement.classList.remove('pull-right')
            }

            $("#select-day").click(function () {
                document.getElementById("scheduled_day").disabled = false;
            })
            $("#today").click(function () {
                document.getElementById("scheduled_day").disabled = true;
            })
            $("#tomorrow").click(function () {
                document.getElementById("scheduled_day").disabled = true;
            })
        })
    </script>
@endsection