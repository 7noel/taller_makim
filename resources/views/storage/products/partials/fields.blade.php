<div class="form-row">
	<div class="col-sm-4">
		{!! Field::text('name', ['label' => 'Nombre', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-8">
		{!! Field::text('description', ['label' => 'Descripción', 'class'=>'form-control-sm']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::text('intern_code', ['label' => 'Cod Interno', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('provider_code', ['label' => 'Cod Proveedor', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('manufacturer_code', ['label' => 'Cod Fabricante', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('sub_category_id', $sub_categories, ['empty'=>'Seleccionar', 'label'=>'SubCategoría', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('unit_id', $units, (isset($model) ? null : '7'), ['empty'=>'Seleccionar', 'label'=>'Unidad', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('status', config('options.product_status'), (isset($model) ? null : '1'), ['empty'=>'Seleccionar', 'label'=>'Status', 'class'=>'form-control-sm', 'required']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::select('is_downloadable', ['1' => 'SI', '0' => 'NO'], ['empty'=>'Seleccionar', 'label'=>'Descargable', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('brand', $brands, ['empty'=>'Seleccionar', 'label'=>'Marca', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('country', config('countries'), (isset($model) ? null : 'PE'), ['empty'=>'Seleccionar', 'label'=>'País', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('currency_id', config('options.table_sunat.moneda'), (isset($model) ? null : '1'), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('price', (isset($model) ? round($model->value * (100+config('options.tax.igv'))/100, 2) : ''), ['label' => 'Precio', 'class'=>'form-control-sm col']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('value', ['label' => 'V Venta', 'class'=>'form-control-sm col']) !!}
	</div>
</div>

@if(isset($model) or 1==1)
	@include('storage.products.partials.accordion')
@endif
