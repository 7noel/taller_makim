<div class="form-row">
	<div class="col-md-2">
		{!! Field::date('f1', ['label'=>'Desde','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2">
		{!! Field::date('f2', ['label'=>'Hasta','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('mycompany_id', $locals, ['empty' => 'Todos', 'label'=>'Taller','class'=>'form-control-sm']) !!}
	</div>
	<!-- <div class="col-sm-2">
		{!! Field::select('seller_id', $sellers, ['empty' => 'Todos', 'label'=>'Asesor','class'=>'form-control-sm']) !!}
	</div> -->
	<div class="col-sm-2">
		{!! Field::select('status_id', config('options.inventory_status'), ['empty' => 'Todos', 'label'=>'Status','class'=>'form-control-sm']) !!}
	</div>
</div>

<div class="form-row">
	<div class="col-sm-2">
		{!! Field::text('placa', ['label'=>'Placa','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('sn', ['label'=>'Número','class'=>'form-control-sm']) !!}
	</div>
</div>
