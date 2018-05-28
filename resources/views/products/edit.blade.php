@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('message.home') }}
@endsection


@section('csspage')
    {!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('plugins/datatables/jquery.dataTables.min.css') !!}
@endsection
@section('contentheader_title')
    Edição de Produto
@endsection
@section('contentheader_description')
    Editar Produto
@endsection
@section('breadcrumb')
    <li>
        <a href="{!! route('home')!!}"><i class="fa fa-dashboard"></i>Inicial</a>
    </li>
    <li>
        <a href="{!! route('products.index')!!}"><i class="fa fa-feed"></i> Listagem de Produtos</a>
    </li>
    <li class="active">
        Edição de Produto - {!! $product->name !!}

    </li>
@endsection
@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    @include('errors._check')
                    <div class="box-body">
                        {!! Form::model($product,[
                            'route'=>['products.update', $product->id],
                            'method' => 'put',
                            'files' => true
                            ])
                        !!}
                        @include('products._form')
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::submit('Salvar', ['class'=>'btn btn-info pull-right publish']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
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
    <script>
        $(document).ready(function () {
            $('#price').keyup(function () {
                var val = $(this).val().replace(',', '.');
                $(this).val(val);
            });
        })
    </script>
@endsection