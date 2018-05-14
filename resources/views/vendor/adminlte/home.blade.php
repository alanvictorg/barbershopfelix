@extends('adminlte::layouts.app')

@section('htmlheader_title')

@endsection
@section('contentheader_title')
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-light-blue-gradient">
                        <div class="inner">
                            <h3>{!! $paymentCash !!}</h3>

                            <p>Pagamentos em dinheiro</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mais informações <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-lime-active">
                        <div class="inner">
                            <h3>{!! $paymentCredit !!}</h3>

                            <p>Pagamentos com cartão</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mais informações <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                </div>
                  <div>{!! $chartjs->render() !!}</div>
            </div>
        </div>
    </div>
@endsection
@section('scriptpage')
@endsection
