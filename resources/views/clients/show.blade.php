@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('message.home') }}
@endsection


@section('csspage')
    {!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('plugins/datatables/jquery.dataTables.min.css') !!}
@endsection
@section('contentheader_title')
    Informações do Cliente
@endsection
@section('contentheader_description')
    Informação do Cliente
@endsection
@section('breadcrumb')
    <li>
        <a href="{!! route('home')!!}"><i class="fa fa-dashboard"></i>Inicial</a>
    </li>
    <li>
        <a href="{!! route('clients.index')!!}"><i class="fa fa-feed"></i> Listagem de Clientes</a>
    </li>
    <li class="active">
        Informações do Cliente - {!! $client->name !!}

    </li>
@endsection
@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua-active">
                                        <h3 class="widget-user-username">{!! $client->name !!}</h3>
                                        <h5 class="widget-user-desc"></h5>
                                    </div>
                                    <div class="widget-user-image">
                                        @if($client->imagepath)
                                            <img class="img-circle" src="{{asset($client->imagepath)}}" alt="User Avatar">
                                        @else
                                            <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="User Image">
                                        @endif
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">TELEFONE</h5>
                                                    <span class="description-text">{!! $client->phone !!}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">EMAIL</h5>
                                                    <span class="description-text">{!! $client->email !!}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">NASCIMENTO</h5>
                                                    <span class="description-text">{!! $client->birthday !!}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">CLIENTE DESDE</h5>
                                                    <span class="description-text">{!! \Carbon\Carbon::parse($client->created_at)->format('d-m-Y')  !!}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">IDAS AO BARBEIRO</h5>
                                                    <span class="description-text">{!! $amountGone !!}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">QUANTIDADE DE SERVIÇOS</h5>
                                                    <span class="description-text">{!! $quantityServices !!}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                            </div>
                        </div>
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