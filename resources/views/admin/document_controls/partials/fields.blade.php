<div class="form-row">
	<div class="col-sm-2">
		{!! Field::select('description', config('options.table_sunat.docs'), ['empty'=>'Seleccionar', 'label'=>'Código', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('code', ['label' => 'Código', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('name', ['label' => 'Serie', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('value_1', ['label' => 'Número', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
</div>
