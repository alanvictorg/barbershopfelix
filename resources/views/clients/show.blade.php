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
                            <div class="col-md-12" style="text-align: center">
                                <h1 style="text-align: center">{!! $client->name !!}</h1>
                                @if($client->imagepath)
                                    <img src="{{asset($client->imagepath)}}" style="width: 200px" class="img-circle"
                                         alt="User Image">
                                @else
                                    <img src="{{asset('img/avatar.png')}}" style="width: 200px" class="img-circle"
                                         alt="User Image">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h4><strong>Telefone:</strong> {!! $client->phone !!}</h4>
                                <h4><strong>Email:</strong> {!! $client->email !!}</h4>
                                <h4><strong>Nascimento:</strong> {!! $client->birthday !!}</h4>
                                <h4><strong>Cliente
                                        desde:</strong> {!! \Carbon\Carbon::parse($client->created_at)->format('d-m-Y')  !!}
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <h4><strong>Quantidade de <br>idas ao barbeiro:</strong> {!! $amountGone !!}</h4>
                                <h4><strong>Quantidade de <br>serviços realizados</b>
                                        :</strong> {!! $quantityServices !!}</h4>
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