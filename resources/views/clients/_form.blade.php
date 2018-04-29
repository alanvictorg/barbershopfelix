<div class="col-md-12">
    <div class="form-group{{ $errors->has("name") ? ' has-error' : '' }}">
        {!! Form::label("name", 'Nome', ['class' => '']) !!}
        {!! Form::text("name", null, ["class" => "form-control", 'id'=>'name','required','placeholder'=>"Digite um Nome",'required'])  !!}
        <small class="text-danger">{{ $errors->first("name") }}</small>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group{{ $errors->has("phone") ? ' has-error' : '' }}">
        {!! Form::label("phone", 'Telefone', ['class' => '']) !!}
        {!! Form::text("phone", null, ["class" => "form-control", 'id'=>'phone','required','placeholder'=>"Digite o telefone",'required'])  !!}
        <small class="text-danger">{{ $errors->first("phone") }}</small>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has("address") ? ' has-error' : '' }}">
        {!! Form::label("address", 'Endereço', ['class' => '']) !!}
        {!! Form::text("address", null, ["class" => "form-control", 'id'=>'address','required','placeholder'=>"Digite o endereço",'required'])  !!}
        <small class="text-danger">{{ $errors->first("address") }}</small>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has("email") ? ' has-error' : '' }}">
        {!! Form::label("email", 'Email', ['class' => '']) !!}
        {!! Form::email("email", null, ["class" => "form-control", 'id'=>'email','required','placeholder'=>"Digite um email",'required'])  !!}
        <small class="text-danger">{{ $errors->first("email") }}</small>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has("birthday") ? ' has-error' : '' }}">
        {!! Form::label("birthday", 'Data de Nascimento', ['class' => '']) !!}
        {!! Form::date("birthday", null, ["class" => "form-control", 'id'=>'birthday','required','required'])  !!}
        <small class="text-danger">{{ $errors->first("birthday") }}</small>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group{{ $errors->has("imagepath") ? ' has-error' : '' }}">
        {!! Form::label("imagepath", 'Foto', ['class' => '']) !!}
        {!! Form::file("imagepath", ['class' => 'form-control']) !!}
        <small class="text-danger">{{ $errors->first("imagepath") }}</small>
    </div>
</div>



