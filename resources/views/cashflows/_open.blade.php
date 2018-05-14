<div class="modal fade" id="abrircaixa" data-backdrop='false'>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url'=>route('cashflows.store'),
                                'enctype'=> 'multipart/form-data',
                                'file'=>'true']) !!}
            <div class="col-md-5">
                {!! Form::text("openVal", null, ["class" => "form-control", 'id'=>'openVal','placeholder'=>"Digite o valor"])  !!}
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
