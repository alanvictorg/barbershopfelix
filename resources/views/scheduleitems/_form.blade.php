{!!  Form::hidden('service_id', $service->id) !!}

<div class="col-md-6">
    <div class="form-group{{ $errors->has("product_id") ? ' has-error' : '' }}">
        {!! Form::label("product_id", 'Produto', ['class' => '']) !!}
        {!! Form::select("product_id", $products, null, ["class" => "form-control", 'id'=>'product_id','required','placeholder'=>"Escolha o produto",'required'])  !!}
        <small class="text-danger">{{ $errors->first("product_id") }}</small>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has("discount") ? ' has-error' : '' }}">
        {!! Form::label("discount", 'Desconto', ['class' => '']) !!}
        {!! Form::text("discount", null, ["class" => "form-control", 'id'=>'discount','placeholder'=>"Existe desconto?"])  !!}
        <small class="text-danger">{{ $errors->first("discount") }}</small>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group{{ $errors->has("observation") ? ' has-error' : '' }}">
        {!! Form::label("observation", 'Observação', ['class' => '']) !!}
        {!! Form::text("observation", null, ["class" => "form-control", 'id'=>'observation','placeholder'=>"Observações"])  !!}
        <small class="text-danger">{{ $errors->first("observation") }}</small>
    </div>
</div>



