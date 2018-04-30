@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('message.home') }}
@endsection


@section('csspage')
    {!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('plugins/datatables/jquery.dataTables.min.css') !!}
@endsection
@section('contentheader_title')
    Informações do Agendamento
@endsection
@section('contentheader_description')
    Serviços a realizar
@endsection
@section('breadcrumb')
    <li>
        <a href="{!! route('home')!!}"><i class="fa fa-dashboard"></i>Inicial</a>
    </li>
    <li>
        <a href="{!! route('schedules.index')!!}"><i class="fa fa-feed"></i> Lista de Agendamentos</a>
    </li>
    <li class="active">
        Informações do Agendamento - {!! $service->name !!}

    </li>
@endsection
@section('main-content')
    <section class="content">
        <div class="pull-left">
            <h4><strong>Valor total a ser cobrado:</strong>  R${!! $valorTotal !!},00</h4>
        </div>

        <div class="pull-right">
            <a href="#" data-toggle="modal" data-target="#createmodal"
               class="btn btn-black btn-sm rounded-s"><i class="fa fa-plus icon"></i> Adicionar serviço
            </a>
            @include('scheduleitems._create')
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="table-permission" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Serviço</th>
                                <th>Valor</th>
                                <th>Opções</th>
                            </tr>
                            @forelse($serviceItems as $item)
                                <tr>
                                    <td>{!! $item->product->name !!}</td>
                                    <td>R${!! $item->product->price->price !!},00</td>
                                    <td>
                                        {!! Form::open(['url' => route('scheduleitems.destroy', $item),'method' => 'delete']) !!}
                                        <button type="submit"
                                                class="btn btn-danger btn-circle" ><i
                                                    class="fa fa-close"></i>
                                        </button>
                                        {!! Form::close() !!}

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

    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/i18n/pt-BR.js') }}"></script>

@endsection