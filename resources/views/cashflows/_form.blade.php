<div class="col-md-12">
    <div class="form-group{{ $errors->has("value") ? ' has-error' : '' }}">
        {!! Form::label("value", 'Valor', ['class' => '']) !!}
        {!! Form::text("value", null, ["class" => "form-control", 'id'=>'value','required','placeholder'=>"Digite o valor",'required'])  !!}
        <small class="text-danger">{{ $errors->first("value") }}</small>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group{{ $errors->has("description") ? ' has-error' : '' }}">
        {!! Form::label("description", 'Descrição', ['class' => '']) !!}
        {!! Form::text("description", null, ["class" => "form-control", 'id'=>'description','placeholder'=>"Digite uma descrição",'required'])  !!}
        <small class="text-danger">{{ $errors->first("description") }}</small>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has("day") ? ' has-error' : '' }}">
        {!! Form::label("day", 'Dia da movimentação', ['class' => '']) !!}
        {!! Form::date("day", null, ["class" => "form-control", 'id'=>'day','required','placeholder'=>"Selecione a data",'required'])  !!}
        <small class="text-danger">{{ $errors->first("day") }}</small>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has("type") ? ' has-error' : '' }}">
        {!! Form::label("type", 'Tipo', ['class' => '']) !!}
        {!! Form::select("type", $types, null, ["class" => "form-control", 'id'=>'type','required','placeholder'=>"Escolha o tipo do item",'required'])  !!}
        <small class="text-danger">{{ $errors->first("type") }}</small>
    </div>
</div>


