<div class="col-md-12">
    <div class="form-group{{ $errors->has("client_id") ? ' has-error' : '' }}">
        {!! Form::label("client_id", 'Cliente', ['class' => '']) !!}
        {!! Form::select("client_id", $clients, null, ["class" => "form-control", 'id'=>'name','required','placeholder'=>"Escolha um cliente",'required'])  !!}
        <small class="text-danger">{{ $errors->first("client_id") }}</small>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group{{ $errors->has("observation") ? ' has-error' : '' }}">
        {!! Form::label("observation", 'Observação', ['class' => '']) !!}
        {!! Form::text("observation", null, ["class" => "form-control", 'id'=>'observation','placeholder'=>"Digite se tiver observação"])  !!}
        <small class="text-danger">{{ $errors->first("observation") }}</small>
    </div>
</div>
<div class="col-md-5" style="padding-top: 30px">
    <div class="form-group">
        {!! Form::label("select_day", 'Hoje?', ['class' => '']) !!}
        <input type="radio" name="select_day" id="today" value="today">

        <div class="pull-right">
            {!! Form::label("select_day", 'Selecionar o dia', ['class' => '']) !!}
            <input type="radio" name="select_day" id="select-day" value="select-day">
        </div>

        {!! Form::label("select_day", 'Amanhã?', ['class' => '']) !!}
        <input type="radio" name="select_day" id="tomorrow" value="tomorrow" checked>

    </div>
</div>
<div class="col-md-3">
    <div class="form-group{{ $errors->has("scheduled_day") ? ' has-error' : '' }}">
        {!! Form::label("scheduled_day", 'Data', ['class' => '']) !!}
        {!! Form::date("scheduled_day", null, ["class" => "form-control", 'id'=>'scheduled_day','placeholder'=>"Escolha a data",'disabled'])  !!}
        <small class="text-danger">{{ $errors->first("scheduled_day") }}</small>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group{{ $errors->has("scheduled_hour") ? ' has-error' : '' }}">
        {!! Form::label("scheduled_hour", 'Horário', ['class' => '']) !!}
        {!! Form::text("scheduled_hour", null, ["class" => "form-control", 'id'=>'scheduled_hour','required','placeholder'=>"Digite a hora",'required'])  !!}
        <small class="text-danger">{{ $errors->first("scheduled_hour") }}</small>
    </div>
</div>