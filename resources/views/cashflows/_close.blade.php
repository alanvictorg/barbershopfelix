<div class="modal fade" id="fecharcaixa" data-backdrop='false'>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Saldo do dia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url'=>route('cashflows.closeDay'),
                                'enctype'=> 'multipart/form-data',
                                'file'=>'true']) !!}
                <div class="col-md-5">
                    R${!! $balance !!}
                </div>
                {!! Form::submit( 'OK', ['class'=>'btn btn-primary pull-right']) !!}

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
