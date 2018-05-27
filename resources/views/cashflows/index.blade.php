@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Fluxo de Caixa
@endsection

@section('csspage')
    {{--{!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}--}}
    {{--{!! Html::style('plugins/datatables/jquery.dataTables.min.css') !!}--}}
@endsection
@section('contentheader_title')
    Fluxo de Caixa
@endsection


@section('breadcrumb')
    <li>
        <a href="{!! url('welcome')!!}"><i class="fa fa-dashboard"></i>Inicial</a>
    </li>
    <li class="active">
        Fluxo de Caixa
    </li>
@endsection
@section('main-content')
    <section class="content">
        <div class="row">
            <div class="pull-right">
                {!! Form::open(['url'=>route('cashflows.filterByDate'),
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
                        <h3 class="box-title">Itens</h3>
                        @if($actualDate === \Carbon\Carbon::now(-3)->format('Y-m-d'))
                            <div class="pull-right">
                                <!-- Button trigger modal -->
                                <a href="#" data-toggle="modal" data-target="#createmodal"
                                   class="btn btn-black btn-sm rounded-s"><i class="fa fa-plus icon"></i> Adicionar
                                    Item ao fluxo de caixa </a>
                                @include("cashflows._create")
                            </div>
                        @endif
                        <div class="pull-right col-md-2 abrir-fechar-caixa">
                            <!-- Button trigger modal -->
                            @if(!$opened)
                                <a href="#" data-toggle="modal" style="background-color: limegreen; color: white;"
                                   data-target="#abrircaixa"
                                   class="btn btn-sm rounded-s" id="abrir-caixa"><i class="fa fa-plus icon"></i>
                                    Abrir
                                    Caixa </a>
                            @elseif($opened === 'hide')
                            @else
                                <a href="#" data-toggle="modal" style="background-color: red; color: white;"
                                   data-target="#fecharcaixa"
                                   class="btn btn-sm rounded-s" id="fechar-caixa"><i class="fa fa-plus icon"></i>
                                    Fechar
                                    Caixa </a>
                            @endif
                            @include("cashflows._open")
                            @include("cashflows._close")
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="table-permission" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Descrição</th>
                                <th>Opções</th>
                            </tr>
                            @forelse($cashFlows as $item)
                                <tr>
                                    @if($item->type == 'input_stream' or $item->type == 'reserve')
                                        <td class="btn-success">Entrada</td>
                                    @else
                                        <td class="btn-danger">Saída</td>
                                    @endif

                                    <td>R${!! $item->value !!}</td>
                                    <td>{!! $item->description !!}</td>
                                    <td>
                                        <a href="{{ route('cashflows.edit',$item)}}"
                                           class="btn btn-sm btn-warning"> <i class="fa fa-edit"
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

            $("#filter").change("on", function () {
                $("#form-filter").submit();
                console.log('filtro')
            });

            if ($(window).width() <= 380) {
                document.getElementById('abrir-caixa').style.marginTop = "5px";
                document.getElementById('fechar-caixa').style.marginTop = "5px";
            }



            var description = $("#description");

            description.on('input', function () {
                $(this).val(function (_, val) {
                    return val.toUpperCase();
                });
            })

            description.on('change', function () {
                if (description.val() === "FUNDO DE CAIXA") {
                    document.getElementById("type").disabled = true;
                    document.getElementById("day").disabled = true;
                } else {
                    document.getElementById("type").disabled = false;
                    document.getElementById("day").disabled = false;
                }
            })
        })
    </script>
@endsection