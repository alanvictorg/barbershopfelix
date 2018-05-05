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
            <div class="col-xs-12">
                <div class="">
                    {!! Form::date('selectDate',null, ["class" => "form-control","id" => "selectDate"]) !!}
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Itens</h3>
                        <div class="pull-right">
                            <!-- Button trigger modal -->
                            <a href="#" data-toggle="modal" data-target="#createmodal"
                               class="btn btn-black btn-sm rounded-s"><i class="fa fa-plus icon"></i> Adicionar
                                Item ao fluxo de caixa </a>
                            @include("cashflows._create")
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
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
                                    @if($item->type == 'input_stream')
                                        <td class="btn-success">Entrada</td>
                                    @else
                                        <td class="btn-danger">Saída</td>
                                    @endif

                                    <td>R${!! $item->value !!},00</td>
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
                <nav class="text-xs-right">
                    {!!  $cashFlows->appends(['sort'=>'id'])->links() !!}
                </nav>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('scriptpage')
    <script>
        $(document).ready(function () {
            $('#selectDate').on("change", function () {
                data = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: "POST",
                    url: '{!! route('cashflows.filterByDate') !!}',
                    data: data,
                    enctype: 'multipart/form-data',

                    success: function (data) {
                        console.log("DEU");
                    }
                });
            });
        })
    </script>
@endsection