@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Clientes
@endsection

@section('csspage')
    {{--{!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}--}}
    {{--{!! Html::style('plugins/datatables/jquery.dataTables.min.css') !!}--}}
@endsection
@section('contentheader_title')
    Listagem de Clientes
@endsection


@section('breadcrumb')
    <li>
        <a href="{!! url('welcome')!!}"><i class="fa fa-dashboard"></i>Inicial</a>
    </li>
    <li class="active">
        Listagem de Clientes

    </li>
@endsection
@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Clientes</h3>
                        <div class="pull-right">
                            <!-- Button trigger modal -->
                            <a href="#" data-toggle="modal" data-target="#createmodal"
                               class="btn btn-black btn-sm rounded-s"><i class="fa fa-plus icon"></i> Adicionar
                                Cliente </a>
                            @include("clients._create")
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="table-permission" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Opções</th>
                            </tr>
                            @forelse($clients as $client)
                                <tr>
                                    <td>{!! $client->id !!}</td>
                                    <td>{!! $client->name  !!}</td>
                                    <td>{!! $client->phone !!}</td>
                                    <td>
                                        <a href="{{ route('clients.edit',$client)}}"
                                           class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-edit"
                                                                                            aria-hidden="true"></i></a>
                                        <a class='btn btn-sm btn-info btn-danger-outline'
                                           href="{{route('clients.show',[$client])}}" data-toggle="tooltip" data-placement="top" title="Visualizar perfil"><i class="fa fa-eye"
                                                                                         aria-hidden="true"></i></a>
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
                <nav class="text-xs-right">
                    {!!  $clients->appends(['sort'=>'id'])->links() !!}
                </nav>
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
        $.fn.select2.defaults.set("theme", "bootstrap");
        $.fn.select2.defaults.set('language', 'pt-BR');
        $(document).ready(function () {
            $('#service_id').select2({
                placeholder: 'Seleciona um serviço',
                width: '100%'
            });
            $('#client_id').select2({
                placeholder: 'Seleciona um serviço',
                width: '100%'
            });
            $('#form_of_payment_id').select2({
                placeholder: 'Seleciona uma Forma de Pagamento',
                width: '100%'
            });
            console.log('oi');
        })
    </script>
@endsection