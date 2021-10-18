{!! Form::hidden('country', 'PE') !!}
{!! Form::hidden('unit_id', '16') !!}
{!! Form::hidden('category_id', '17') !!}
<div class="form-row mb-3">
	<div class="col-sm-2">
		<div class="custom-control custom-switch">
			{!! Form::checkbox('visible', '1', ((isset($model))? null : '1'), ['class'=>'custom-control-input', 'id'=>'is_visible']) !!}
			<label class="custom-control-label" for="is_visible">Visible</label>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="col-sm-4">
		{!! Field::text('name', ['label' => 'Nombre', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-8">
		{!! Field::text('description', ['label' => 'Descripción', 'class'=>'form-control-sm']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::text('intern_code', ['label' => 'Cod Interno', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2 d-none">
		{!! Field::text('provider_code', ['label' => 'Cod Proveedor', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('sub_category_id', $sub_categories, ['empty'=>'Seleccionar', 'label'=>'Sub Categoría', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('currency_id', config('options.table_sunat.moneda'), (isset($model) ? null : '1'), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	@if(config('options.precio_en_items'))
		<div class="col-sm-2">
			{!! Field::number('price_cost', ['label' => 'Precio Costo', 'class'=>'form-control-sm col', 'id'=>'p_price_cost', 'step'=>"0.01"]) !!}
		</div>
		<div class="col-sm-2">
			{!! Field::number('price', ['label' => 'Precio Venta', 'class'=>'form-control-sm col', 'id'=>'p_price', 'step'=>"0.01"]) !!}
		</div>
		{!! Form::hidden('value_cost', null, ['id'=>'p_value_cost']) !!}
		{!! Form::hidden('value', null, ['id'=>'p_value']) !!}
	@else
		<div class="col-sm-2">
			{!! Field::number('value_cost', ['label' => 'Valor Costo', 'class'=>'form-control-sm col', 'id'=>'p_value_cost', 'step'=>"0.01"]) !!}
		</div>
		<div class="col-sm-2">
			{!! Field::number('value', ['label' => 'Valor Venta', 'class'=>'form-control-sm col', 'id'=>'p_value', 'step'=>"0.01"]) !!}
		</div>
		{!! Form::hidden('price_cost', null, ['id'=>'p_price_cost']) !!}
		{!! Form::hidden('price', null, ['id'=>'p_price']) !!}
	@endif
</div>