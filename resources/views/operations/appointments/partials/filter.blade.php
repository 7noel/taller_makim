<div class="form-row">
	<div class="col-md-2">
		{!! Field::date('f1', ['label'=>'Desde','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2">
		{!! Field::date('f2', ['label'=>'Hasta','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('status_id', array_keys(config('options.appointment_status')), ['empty' => 'Seleccionar', 'label'=>'Estado','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('placa', ['label'=>'Placa','class'=>'form-control-sm']) !!}
	</div>
</div>
