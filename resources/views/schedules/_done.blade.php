<div class="modal" id="createmodaldone" data-backdrop='false'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pagamento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                {{--@include('errors._check')--}}

                {!! Form::open(['url'=> route('schedules.done'),
                                'enctype'=> 'multipart/form-data',
                                'file'=>'true']) !!}
                {!! Form::hidden('service_id',$service->id) !!}
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has("value_cash") ? ' has-error' : '' }}">
                        {!! Form::text("value_cash", null, ["class" => "form-control", 'id'=>'value_cash','placeholder'=>"Valor pago em dinheiro",'required'])  !!}
                        <i class="fa fa-money forms-pay" aria-hidden="true"></i>
                        <small class="text-danger">{{ $errors->first("value_cash") }}</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has("value_credit") ? ' has-error' : '' }}">
                        {!! Form::text("value_credit", null, ["class" => "form-control", 'id'=>'value_credit','placeholder'=>"Valor pago com crédito",'required'])  !!}
                        <i class="fa fa-credit-card credit-pay" aria-hidden="true"></i>
                        <small class="text-danger">{{ $errors->first("value_credit") }}</small>
                    </div>
                </div>
                {!! Form::submit( 'Salvar', ['class'=>'btn btn-primary pull-right']) !!}

            </div>
            {{-- /.modal-body --}}
            <div class="modal-footer">
                <div id="category-success">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
