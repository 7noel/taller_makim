@php $i=0; @endphp
@if(request()->route()->getName() == 'output_quotes.edit')
<a href="#" id="btnAddProduct" class="btn btn-outline-info btn-sm mb-3" data-toggle="modal" data-target="#exampleModalx" title="Agregar Producto">{!! $icons['add'] !!} Agregar</a>
@endif
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
			{!! Form::hidden("details[$i][is_downloadable]", $detail->is_downloadable, ['class'=>'is_downloadable','data-is_downloadable'=>'']) !!}
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


{!! Form::hidden('items', $i, ['id'=>'items']) !!}

<!-- Modal -->
<div class="modal fade" id="exampleModalx" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar/Editar Servicio</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form-row">
				<div class="form-group col-sm-9">
					{!! Field::select('categories', $categories, '', ['label'=>'Categoría', 'empty'=>'Seleccionar', 'class'=>'form-control form-control-sm']) !!}
				</div>
				<div class="form-group col-sm-3">
					{!! Field::select('unit', $units, '', ['label'=>'Unidad', 'empty'=>'Seleccionar', 'class'=>'form-control form-control-sm']) !!}
				</div>
				<div class="form-group col-sm-12">
					<label for="txtProducto">Producto</label>
					<small id="txtCodigo"></small>
					<input type="text" class="form-control form-control-sm" id="txtProducto">
					<span class="badge badge-light" id="alert-items"></span>
					<span class="badge badge-info" id="alert-stock"></span>
					<input type="hidden" id="txtProduct">
					<input type="hidden" id="unitId">
				</div>
				<div class="form-group col-3 text-center">
					<label for="txtCantidad">Cantidad <span id="label-cantidad"></span> </label>
					<input type="number" class="form-control form-control-sm text-center" id="txtCantidad">
				</div>
				<div class="form-group col-3 text-center">
					<label for="txtValue">Valor</label>
					<input type="number" class="form-control form-control-sm text-center" id="txtValue">
				</div>
				<div class="form-group col-3 text-center">
					<label for="txtDscto2">Dscto2 (%)</label>
					<input type="number" class="form-control form-control-sm text-center" id="txtDscto2">
				</div>
				<div class="form-group col-3 text-center">
					<label>Total</label>
					<span id="spanPriceItem" class="d-none form-control-sm form-control-plaintext"></span>
					<span id="spanValueItem" class="form-control-sm form-control-plaintext"></span>
					<input type="hidden" id="txtTotal">
					<input type="hidden" id="txtPriceItem">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{!! $icons['close'] !!} Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn-add-product">{!! $icons['add'] !!} Grabar</button>
			</div>
		</div>
	</div>
</div>
