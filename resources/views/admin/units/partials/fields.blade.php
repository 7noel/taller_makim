<div class="form-row">
	<div class="col-sm-4">
		{!! Field::text('name', ['label' => 'Nombre', 'class'=>'form-control-sm text-uppercase', 'required'=>'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('code', config('options.table_sunat.unidad_de_medida'), ['label'=>'Código', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('symbol', ['label' => 'Símbolo', 'class'=>'form-control-sm', 'required'=>'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('relation_id', config('options.unit_types'), ['label'=>'Tipo de Unidad', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('value_1', ['label' => 'Valor', 'class'=>'form-control-sm']) !!}
	</div>
</div>