<div class="form-row">
	<div class="col-sm-2">
		{!! Field::date('f1', ['label' => 'Desde', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::date('f2', ['label' => 'Hasta', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::select('seller_id', $sellers, ['empty' => 'Seleccionar', 'label' => 'Vendedor', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('status_id', config('options.quote_status'), ['empty' => 'Seleccionar', 'label' => 'Status', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('sn', ['label' => 'Número', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
</div>
