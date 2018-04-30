<div class="col-md-12">
    <div class="form-group{{ $errors->has("client_id") ? ' has-error' : '' }}">
        {!! Form::label("client_id", 'Cliente', ['class' => '']) !!}
        {!! Form::select("client_id", $clients, null, ["class" => "form-control", 'id'=>'name','required','placeholder'=>"Escolha um cliente",'required'])  !!}
        <small class="text-danger">{{ $errors->first("client_id") }}</small>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group{{ $errors->has("scheduled_day") ? ' has-error' : '' }}">
        {!! Form::label("scheduled_day", 'Dia', ['class' => '']) !!}
        {!! Form::date("scheduled_day", null, ["class" => "form-control", 'id'=>'scheduled_day','required','placeholder'=>"Digite o telefone",'required'])  !!}
        <small class="text-danger">{{ $errors->first("scheduled_day") }}</small>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has("scheduled_hour") ? ' has-error' : '' }}">
        {!! Form::label("scheduled_hour", 'Horário', ['class' => '']) !!}
        {!! Form::text("scheduled_hour", null, ["class" => "form-control", 'id'=>'scheduled_hour','required','placeholder'=>"Digite o horário",'required'])  !!}
        <small class="text-danger">{{ $errors->first("scheduled_hour") }}</small>
    </div>
</div>



