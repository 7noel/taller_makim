@php $i=0; @endphp
@if(request()->route()->getName() == 'output_quotes.edit')
<a href="#" id="btnAddService" class="btn btn-outline-info btn-sm mb-3" data-toggle="modal" data-target="#exampleModalx" title="Agregar Servicio">{!! $icons['add'] !!} Agregar Servicio</a>
<a href="#" id="btnAddProduct" class="btn btn-outline-info btn-sm mb-3" data-toggle="modal" data-target="#exampleModalx" title="Agregar Producto">{!! $icons['add'] !!} Agregar Productos</a>
@endif
<div class="table-responsive">
<table class="table table-sm table-hover">
	<thead>
		<tr>
			<th class="text-center">Código</th>
			<th style="min-width: 50px">Categoría</th>
			<th style="min-width: 250px">Descripción</th>
			<th class="text-center">Cantidad</th>
			<th class="text-center withTax">Precio</th>
			<th class="text-center withoutTax">Valor</th>
			<th class="text-center">Dscto(%)</th>
			<th class="text-center withoutTax">V.Total</th>
			<th class="text-center withTax">P.Total</th>
			<th class="text-center text-center">Acciones</th>
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
			<td><span class='spanCodigo text-right'>{{ $detail->product->intern_code }}</span></td>
			<td><span class='spanCategory'>{{ $detail->comment }}</span></td>
			<td><span class='spanProduct'>{{ $detail->product->name }}</span></td>
			<td class="text-center"><span class='spanCantidad'>{{ $detail->quantity }} {{ $detail->unit->symbol }}</span><input class="txtCantidad" name="details[{{ $i }}][quantity]" type="hidden" value="{{ $detail->quantity }}"></td>

			<td class="withTax text-right"><span class='spanPrecio'>{{ $detail->price_item }}</span><input class="txtPrecio" name="details[{{ $i }}][price]" type="hidden" value="{{ $detail->price_item }}"></td>
            <td class="withoutTax text-right"><span class='spanValue'>{{ $detail->value }}</span><input class="txtValue" name="details[{{ $i }}][value]" type="hidden" value="{{ $detail->value }}"></td>

			<td class="text-center"><span class='spanDscto2'>{{ round($detail->d2) }}</span>{!! Form::hidden("details[$i][d2]", $detail->d2, ['class'=>'txtDscto2']) !!}</td>

			<td class="withoutTax text-right"> <span class='txtTotal' data-total>{{ $detail->total }}</span> </td>
			<td class="withTax text-right"> <span class='txtPriceItem' data-price_item>{{ $detail->price_item }}</span> </td>

			<td class="text-center" style="white-space: nowrap;">
                <a href="#" class="btn btn-outline-primary btn-sm btn-edit-item" title="Editar">{!! $icons['edit'] !!}</a>
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
				<h5 class="modal-title" id="exampleModalLabel">Agregar/Editar <span class="spanTypeItem">Servicio</span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form-row">
				<div class="form-group col-sm-5">
					{!! Field::select('category', [], '', ['label'=>'Categoría', 'empty'=>'Seleccionar', 'class'=>'form-control form-control-sm']) !!}
				</div>
				<div class="form-group col-sm-5 d-none">
					{!! Field::select('sub_category', [], '', ['label'=>'Sub_Categoría', 'empty'=>'Seleccionar', 'class'=>'form-control form-control-sm']) !!}
				</div>
				<div class="form-group col-sm-2">
					{!! Field::select('unitId', [], '', ['label'=>'Unidad', 'empty'=>'Seleccionar', 'class'=>'form-control form-control-sm']) !!}
				</div>
				<div class="form-group col-sm-12">
					<label for="txtProducto"><span class="spanTypeItem">Servicio</span></label>
					<small id="txtCodigo"></small>
					<small id="txtProId" class="d-none"></small>

					<input type="text" class="form-control form-control-sm text-uppercase" id="txtProducto">

					<span class="badge badge-light" id="alert-items"></span>
					<span class="badge badge-info" id="alert-stock"></span>
					<input type="hidden" id="txtProduct">
					<input type="hidden" id="is_downloadable">
					<!-- <input type="hidden" id="unitId"> -->
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
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{!! $icons['close'] !!} Cerrar</button>
				<button type="button" class="btn btn-sm btn-outline-info d-none" id="btn-create-item">{!! $icons['add'] !!} Crear <span class="spanTypeItem">Servicio</span></button>
				<button type="button" class="btn btn-sm btn-primary" id="btn-add-product">{!! $icons['add'] !!} Grabar</button>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function () {
	@if(isset($model))
		var categories_service = @json($categories_service);
		window.opts_cat_ser = `<option value="">Seleccionar</option>`
		categories_service.forEach(function (item) {
			window.opts_cat_ser += `<option value="${item.id}">${item.name}</option>`
		})

		var category = categories_service.find(item => item.id === 17);
		sub_categories_service = category.childs
		// console.log(category.childs)
		window.opts_sub_cat_ser = `<option value="0">Seleccionar</option>`
		sub_categories_service.forEach(function (item) {
			window.opts_sub_cat_ser += `<option value="${item.id}">${item.name}</option>`
		})
		document.getElementById("sub_category").innerHTML = opts_sub_cat_ser;
		
		var categories_product = @json($categories_product);
		window.opts_cat_pro = `<option value="">Seleccionar</option>`
		categories_product.forEach(function (item) {
			window.opts_cat_pro += `<option value="${item.id}">${item.name}</option>`
		})

		var units_product = @json($units_product);
		window.opts_uni_pro = `<option value="">Seleccionar</option>`
		units_product.forEach(function (item) {
			window.opts_uni_pro += `<option value="${item.id}">${item.symbol}</option>`
		})

		var units_service = @json($units_service);
		window.opts_uni_ser = `<option value="">Seleccionar</option>`
		units_service.forEach(function (item) {
			window.opts_uni_ser += `<option value="${item.id}">${item.symbol}</option>`
		})
		document.getElementById("unitId").innerHTML = opts_uni_ser;
		ordenarTabla()
	@endif
})


</script>