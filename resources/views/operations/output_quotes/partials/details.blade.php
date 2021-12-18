@php $i=0; @endphp
<div class="">
<table class="table table-sm table-responsive">
	<thead>
		<tr>
			<th width="100px">Código</th>
			<th width="300px">Descripción</th>
			<th width="100px">Cantidad</th>
			<th class="withTax" width="100px">Precio</th>
			<th class="withoutTax" width="100px">Valor</th>
			<th width="100px">Dscto1(%)</th>
			<th width="100px" class="d-none">Dscto2(%)</th>
			<th class="withoutTax" width="100px">V.Total</th>
			<th class="withTax" width="100px">P.Total</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody id="tableItems">
	@if(isset($model->details))
	@foreach($model->details as $detail)
		@php $categories=[]; @endphp
		<tr data-id="{{ $detail->id }}">
			{!! Form::hidden("details[$i][id]", $detail->id, ['class'=>'detailId','data-detailId'=>'']) !!}
			{!! Form::hidden("details[$i][product_id]", $detail->product_id, ['class'=>'productId','data-productid'=>'']) !!}
			{!! Form::hidden("details[$i][unit_id]", $detail->unit_id, ['class'=>'unitId','data-unitid'=>'']) !!}
			{!! Form::hidden("details[$i][category_id]", $detail->category_id, ['class'=>'categoryId','data-categoryid'=>'']) !!}
			{!! Form::hidden("details[$i][sub_category_id]", $detail->sub_category_id, ['class'=>'subCategoryId','data-subcategoryid'=>'']) !!}
			<td><span class='form-control form-control-sm intern_code text-right' data-labelid>{{ $detail->product->intern_code }}</span></td>
			<td>{!! Form::text("details[$i][txtProduct]", $detail->product->name, ['class'=>'form-control form-control-sm txtProduct', 'data-product'=>'', 'required'=>'required', 'disabled']); !!}</td>
			<td>{!! Form::text("details[$i][quantity]", $detail->quantity, ['class'=>'form-control form-control-sm txtCantidad text-right', 'data-cantidad'=>'']) !!}</td>
			@if(config('options.cambiar_precios'))
				<td class="withTax">{!! Form::text("details[$i][price]", $detail->price, ['class'=>'form-control form-control-sm txtPrecio text-right', 'data-precio'=>'']) !!}</td>
				<td class="withoutTax">{!! Form::text("details[$i][value]", $detail->value, ['class'=>'form-control form-control-sm txtValue text-right', 'data-value'=>'']) !!}</td>
			@else
				<td class="withTax">{!! Form::text("details[$i][price]", $detail->price, ['class'=>'form-control form-control-sm txtPrecio text-right', 'data-precio'=>'', 'readonly'=>'readonly']) !!}</td>
				<td class="withoutTax">{!! Form::text("details[$i][value]", $detail->value, ['class'=>'form-control form-control-sm txtValue text-right', 'data-value'=>'', 'readonly'=>'readonly']) !!}</td>
			@endif
			<td>{!! Form::text("details[$i][d1]", $detail->d1, ['class'=>'form-control form-control-sm txtDscto text-right', 'data-dscto'=>'']) !!}</td>
			<td class="d-none">{!! Form::text("details[$i][d2]", $detail->d2, ['class'=>'form-control form-control-sm txtDscto2 text-right', 'data-dscto'=>'']) !!}</td>
			<td class="withoutTax"> <span class='form-control form-control-sm txtTotal text-right' data-total>{{ $detail->total }}</span> </td>
			<td class="withTax"> <span class='form-control form-control-sm txtPriceItem text-right' data-price_item>{{ $detail->price_item }}</span> </td>
			<td class="text-center form-inline">
				<a href="#" class="btn btn-outline-danger btn-sm btn-delete-item" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
		@php $i++; @endphp
	@endforeach
	@endif
	</tbody>
</table>
</div>
<template id="template-row-item">
	<tr>
		{!! Form::hidden('data1', null, ['class'=>'productId','data-productid'=>'']) !!}
		{!! Form::hidden('data2', null, ['class'=>'unitId','data-unitid'=>'']) !!}
		{!! Form::hidden('data0', null, ['class'=>'categoryId','data-categoryid'=>'']) !!}
		{!! Form::hidden('data0', null, ['class'=>'subCategoryId','data-subcategoryid'=>'']) !!}
		<td width="100px"><span class='form-control-plaintext form-control-sm intern_code text-right' data-labelid></span></td>
		<td width="100px">{!! Form::text('data3', null, ['class'=>'form-control form-control-sm txtProduct', 'data-product'=>'', 'required'=>'required']); !!}</td>
		<td width="100px">{!! Form::text('data4', null, ['class'=>'form-control form-control-sm txtCantidad text-right', 'data-cantidad'=>'']) !!}</td>
		@if(config('options.cambiar_precios'))
			<td width="100px" class="withTax">{!! Form::text('data5', null, ['class'=>'form-control form-control-sm txtPrecio text-right', 'data-precio'=>'']) !!}</td>
			<td width="100px" class="withoutTax">{!! Form::text('data7', null, ['class'=>'form-control form-control-sm txtValue text-right', 'data-value'=>'']) !!}</td>
		@else
			<td width="100px" class="withTax">{!! Form::text('data5', null, ['class'=>'form-control form-control-sm txtPrecio text-right', 'data-precio'=>'', 'readonly'=>'readonly']) !!}</td>
			<td width="100px" class="withoutTax">{!! Form::text('data7', null, ['class'=>'form-control form-control-sm txtValue text-right', 'data-value'=>'', 'readonly'=>'readonly']) !!}</td>
		@endif
		<td width="100px">{!! Form::text('data6', null, ['class'=>'form-control form-control-sm txtDscto text-right', 'data-dscto'=>'']) !!}</td>
		<td width="100px" class="d-none">{!! Form::text('data8', null, ['class'=>'form-control form-control-sm txtDscto2 text-right', 'data-dscto2'=>'']) !!}</td>
		<td width="100px" class="withoutTax"> <span class='form-control form-control-sm txtTotal text-right' data-total></span> </td>
		<td width="100px" class="withTax"> <span class='form-control form-control-sm txtPriceItem text-right' data-price_item></span> </td>
		<td width="100px" class="text-center form-inline">
			<a href="#" class="btn btn-outline-danger btn-sm btn-delete-item" title="Eliminar">{!! $icons['remove'] !!}</a>
		</td>
	</tr>
</template>
{!! Form::hidden('items', $i, ['id'=>'items']) !!}
<a href="#" id="btnAddProduct" class="btn btn-success btn-sm" title="Agregar Producto">{!! $icons['add'] !!} Agregar</a>
<table class="table table-condensed table-sm">
	<thead>
		<tr>
			<th class="text-center">V.Bruto</th>
			<th class="text-center">Dscto Total</th>
			<th class="text-center">SubTotal</th>
			<th class="text-center">Total</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="text-center"><span id="mGrossValue">{{ (isset($model)) ? $model->gross_value : "0.00" }}</span></td>
			<td class="text-center"><span id="mDiscount">{{ (isset($model)) ? $model->discount_items : "0.00" }}</span></td>
			<td class="text-center"><span id="mSubTotal">{{ (isset($model)) ? $model->subtotal : "0.00" }}</span></td>
			<td class="text-center"><span id="mTotal">{{ (isset($model)) ? $model->total : "0.00" }}</span></td>
		</tr>
	</tbody>
</table>
