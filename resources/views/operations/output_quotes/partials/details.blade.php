@php $i=0; @endphp
@if(request()->route()->getName() == 'output_quotes.edit')
	<a href="#" id="btnAddService" class="btn btn-outline-info btn-sm mb-3" data-toggle="modal" data-target="#exampleModalx" title="Agregar Servicio">{!! $icons['add'] !!} Agregar Servicio</a>
	<a href="#" id="btnAddProduct" class="btn btn-outline-info btn-sm mb-3" data-toggle="modal" data-target="#exampleModalx" title="Agregar Producto">{!! $icons['add'] !!} Agregar Repuestos</a>
	<!-- Botón en tu tiles.blade o donde listes los ítems -->
	<button type="button" class="btn btn-sm btn-outline-primary mb-3" id="btnAjustarHoras">
	  <i class="fa-regular fa-clock"></i> Ajustar Cantidades
	</button>
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
	@foreach($model->details->sortBy('id') as $detail)
		@php $categories=[]; @endphp
		<tr class="js-det-row" data-category="{{ $detail->comment }}" data-id="{{ $detail->id }}">
			{!! Form::hidden("details[$i][id]", $detail->id, ['class'=>'detailId','data-detailId'=>'']) !!}
			{!! Form::hidden("details[$i][product_id]", $detail->product_id, ['class'=>'productId','data-productid'=>'']) !!}
			{!! Form::hidden("details[$i][unit_id]", $detail->unit_id, ['class'=>'unitId','data-unitid'=>'']) !!}
			{!! Form::hidden("details[$i][category_id]", $detail->category_id, ['class'=>'categoryId','data-categoryid'=>'']) !!}
			{!! Form::hidden("details[$i][sub_category_id]", $detail->sub_category_id, ['class'=>'subCategoryId','data-subcategoryid'=>'']) !!}
			{!! Form::hidden("details[$i][is_downloadable]", $detail->is_downloadable, ['class'=>'is_downloadable','data-is_downloadable'=>'']) !!}
			{!! Form::hidden("details[$i][description]", $detail->description, ['class'=>'description','data-description'=>'']) !!}
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
	<thead class="thead-light">
		<tr>
			<th class="text-center">V.Bruto</th>
			<th class="text-center">Dscto Total</th>
			<th class="text-center" id="presupuesto_total">SubTotal</th>
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

<hr class="my-2">

<h5 class="mb-2">Órdenes de compra de terceros {{--<button type="button" class="btn btn-outline-primary btn-sm" id="btn-oc-add">
          <i class="fa fa-plus"></i> Agregar OC
        </button>--}}</h5>

<table class="table table-sm table-bordered" id="tabla-oc">
  <thead class="thead-light">
    <tr>
      <th style="width: 60%">Descripción</th>
      <th style="width: 25%">Monto del servicio</th>
      <th style="width: 15%">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @php $ocs = old('oc', $model->diagnostico->oc ?? []); @endphp
    @forelse($ocs as $i => $oc)
      <tr>
        <td>
          <input type="text" name="diagnostico[oc][{{ $i }}][descripcion]" class="form-control form-control-sm text-uppercase" 
                 value="{{ $oc->descripcion ?? '' }}">
        </td>
        <td>
          <input type="number" step="0.01" min="0" name="diagnostico[oc][{{ $i }}][monto]" 
                 class="form-control form-control-sm js-oc-monto text-right" 
                 value="{{ $oc->monto ?? 0 }}">
        </td>
        <td class="text-center">
          <button type="button" class="btn btn-outline-danger btn-sm js-oc-del">
            <i class="far fa-trash-alt"></i>
          </button>
        </td>
      </tr>
    @empty
      {{-- fila inicial vacía --}}
      <tr>
        <td><input type="text" name="diagnostico[oc][0][descripcion]" class="form-control form-control-sm"></td>
        <td><input type="number" step="0.01" min="0" name="diagnostico[oc][0][monto]" class="form-control form-control-sm js-oc-monto text-right" value="0"></td>
        <td class="text-center">
          <button type="button" class="btn btn-outline-danger btn-sm js-oc-del"><i class="far fa-trash-alt"></i></button>
        </td>
      </tr>
    @endforelse
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" class="text-right">
        <button type="button" class="btn btn-outline-primary btn-sm" id="btn-oc-add">
          <i class="fa fa-plus"></i> Agregar orden de compra
        </button>
      </td>
    </tr>
  </tfoot>
</table>

<hr class="my-2">

<div class="form-row">
  <div class="form-group col-md-4">
    <label>Monto mínimo de franquicia</label>
    <input type="number" step="0.01" min="0" class="form-control form-control-sm" 
           id="franquicia_min" name="diagnostico[franquicia_min]" value="{{ old('franquicia_min', optional($model->diagnostico)->franquicia_min ?? 0) }}">
  </div>
  <div class="form-group col-md-4">
    <label>% de franquicia</label>
    <div class="input-group input-group-sm">
      <input type="number" step="0.01" min="0" max="100" class="form-control" 
             id="franquicia_pct" name="diagnostico[franquicia_pct]" value="{{ old('franquicia_pct', optional($model->diagnostico)->franquicia_pct ?? 10) }}">
      <div class="input-group-append"><span class="input-group-text">%</span></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <label>Franquicia a pagar (calculada)</label>
    <input type="text" readonly class="form-control form-control-sm font-weight-bold" 
           id="franquicia_total_display" value="0.00">
    <input type="hidden" name="diagnostico[franquicia_total]" id="franquicia_total" value="0">
  </div>
</div>

<div class="small text-muted mb-2">
  <div>Suma OCs: <span id="sum_oc_display">0.00</span></div>
  <div>Base (Presupuesto + OCs): <span id="base_display">0.00</span></div>
  <div>% aplicado: <span id="pct_aplicado_display">0.00</span></div>
  <div>Mínimo: <span id="minimo_display">0.00</span></div>
</div>


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
				<div class="form-group col-sm-12 d-none">
					<textarea id="txtDescription" rows="3" class="form-control text-uppercase"></textarea>
				</div>
				<div class="form-group col-3 text-center">
					<label for="txtCantidad">Cantidad <span id="label-cantidad"></span> </label>
					<input type="number" class="form-control form-control-sm text-center" id="txtCantidad">
				</div>
				<div class="form-group col-3 text-center">
					<label for="txtValue">Valor</label>
					<input type="number" class="form-control form-control-sm text-center" id="txtValue">
				</div>
				<div class="form-group col-3 text-center d-none">
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

<!-- Modal Bootstrap 4 -->
<div class="modal fade" id="modalAjustarHoras" tabindex="-1" role="dialog" aria-labelledby="modalAjustarHorasLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title" id="modalAjustarHorasLabel">Ajustar horas por categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-3">
        <div class="form-group mb-2">
          <label class="mb-1">Categoría</label>
          <select id="ajCat" class="form-control form-control-sm"></select>
        </div>

        <div class="form-row">
          <div class="form-group col-6 mb-2">
            <label class="mb-1">Horas actuales</label>
            <input type="text" id="ajHorasActuales" class="form-control form-control-sm text-right" readonly>
          </div>
          <div class="form-group col-6 mb-2">
            <label class="mb-1">Horas objetivo</label>
            <input type="number" step="0.25" min="0" id="ajHorasObjetivo" class="form-control form-control-sm text-right" placeholder="Ej: 20">
          </div>
        </div>

        <div class="custom-control custom-checkbox mb-2">
          <input type="checkbox" class="custom-control-input" id="ajPermitHalf">
          <label class="custom-control-label" for="ajPermitHalf">Permitir cuartos de horas (0.25)</label>
        </div>

        <small class="text-muted d-block">
          Tip: Si el cliente pide 20.25 horas, marca “Permitir cuartos de horas”.
        </small>
      </div>
      <div class="modal-footer py-2">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-sm" id="ajAplicar">Aplicar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {

	// Delegación: eliminar fila
	$(document).on('click', '.js-oc-del', function(){
		var $tr = $(this).closest('tr');
		var $tbody = $tr.closest('tbody');
		$tr.remove();
		if ($tbody.children('tr').length === 0){
			addOCRow();
		}
		recalcFranquicia();
	});

	// Agregar fila
	$('#btn-oc-add').on('click', function(){
		addOCRow();
	});

	// Recalcular en cambios
	$(document).on('input change', '#presupuesto_total, #franquicia_min, #franquicia_pct, .js-oc-monto', recalcFranquicia);

	// Primer cálculo
	recalcFranquicia();



	@if(isset($model))
		var categories_service = @json($categories_service);
		window.opts_cat_ser = `<option value="">Seleccionar</option>`
		categories_service.forEach(function (item) {
			window.opts_cat_ser += `<option value="${item.id}">${item.name}</option>`
		})

		var categories_product = @json($categories_product);
		window.opts_cat_pro = ``
		// window.opts_cat_pro = `<option value="">Seleccionar</option>`
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

    $('#category').change(function () {
    	my_cat = $('#category').val()
    	if (window.type == 'ser') {
			var category = categories_service.find(item => item.id == my_cat);
    	} else {
			var category = categories_product.find(item => item.id == my_cat);
    	}
    	unit = category.description
    	if (unit !='') {
    		$('#unitId').val(unit)
            $('#unit').val(unit)
    	}
		sub_categories_service = category.childs
		window.opts_sub_cat_ser = `<option value="0">Seleccionar</option>`
		sub_categories_service.forEach(function (item) {
			window.opts_sub_cat_ser += `<option value="${item.id}">${item.name}</option>`
		})
		document.getElementById("sub_category").innerHTML = opts_sub_cat_ser;
        if (category.childs.length) {
            $('#sub_category').parent().parent().removeClass('d-none')
        } else {
            $('#sub_category').parent().parent().addClass('d-none')
            $('#sub_category').val('0')
        }

    	if ($('#unitId option:selected').text()=='pño' && $('#diagnostico_p_paño').val()!='') {
    		$('#txtValue').val($('#diagnostico_p_paño').val())
    	}
    	if ($('#unitId option:selected').text()=='hr' && $('#diagnostico_p_hora').val()!='') {
    		$('#txtValue').val($('#diagnostico_p_hora').val())
    	}
    	my_cat_text = $("#category option:selected").text()
    	if (my_cat_text == 'MECANICA') {
    		$('#txtDescription').parent().removeClass('d-none')
    	} else {
    		$('#txtDescription').parent().addClass('d-none')
    	}
    })
})

// ---- Utilidades numéricas (globales) ----
function toNumber(v){
  if (typeof v === 'number') return v;
  if (!v) return 0;
  v = (''+v).replace(/\./g, '').replace(',', '.'); // opcional: quita miles con punto
  var n = parseFloat(v);
  return isNaN(n) ? 0 : n;
}
function fmt(n){ return (Math.round(n * 100) / 100).toFixed(2); }

// ---- Recalcular franquicia ----
function recalcFranquicia(){
  var presupuesto = parseFloat($('#mSubTotal').text());
  var sumOC = 0;
  $('.js-oc-monto').each(function(){ sumOC += parseFloat($(this).val()); });

  var base = presupuesto + sumOC;
  console.log(`subtotal: ${$('#mSubTotal').text()}, presupuesto: ${presupuesto} | sumaOC: ${sumOC} | base: ${base}`)
  var pct = parseFloat($('#franquicia_pct').val());
  if (pct < 0) pct = 0;
  if (pct > 100) pct = 100;

  var minimo = parseFloat($('#franquicia_min').val());
  if (minimo < 0) minimo = 0;

  var porPct = base * (pct/100.0);
  var result = Math.max(porPct, minimo);

  // pintar
  $('#sum_oc_display').text(fmt(sumOC));
  $('#base_display').text(fmt(base));
  $('#pct_aplicado_display').text(fmt(porPct));
  $('#minimo_display').text(fmt(minimo));
  $('#franquicia_total_display').val(fmt(result));
  $('#franquicia_total').val(fmt(result));
}

// ---- Agregar fila de OC ----
function addOCRow(focusTarget = 'descripcion'){
  var $tbody = $('#tabla-oc tbody');
  var idx = $tbody.children('tr').length;
  var tpl =
    '<tr>' +
      '<td><input type="text" name="diagnostico[oc]['+idx+'][descripcion]" class="form-control form-control-sm text-uppercase"></td>' +
      '<td><input type="number" step="0.01" min="0" name="diagnostico[oc]['+idx+'][monto]" class="form-control form-control-sm js-oc-monto text-right" value="0"></td>' +
      '<td class="text-center">' +
        '<button type="button" class="btn btn-outline-danger btn-sm js-oc-del"><i class="far fa-trash-alt"></i></button>' +
      '</td>' +
    '</tr>';
  // $tbody.append(tpl);

  // Agrega y captura la nueva fila
  var $row = $(tpl).appendTo($tbody);

  // Opcional: lleva la fila a la vista si el contenedor tiene scroll
  $row[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });

  // Enfoca el campo deseado
  // (setTimeout(0) ayuda dentro de modales Bootstrap/iOS)
  setTimeout(function () {
    if (focusTarget === 'monto') {
      $row.find('input[name$="[monto]"]').trigger('focus').select();
    } else {
      // por defecto, descripcion
      $row.find('input[name$="[descripcion]"]').trigger('focus').select();
    }
  }, 0);
}

(function($){

  // ====== SELECTORES AJUSTABLES (si difieren en tu HTML, cámbialos aquí) ======
  const ROW_SELECTOR        = '.js-det-row';       // fila de cada ítem
  const CAT_ATTR            = 'data-category';     // atributo con la categoría
  const VISIBLE_QTY_SEL     = 'span.spanCantidad';     // span visible
  const HIDDEN_QTY_SEL      = 'input.txtCantidad'; // input oculto que se envía
  const MIN_STEP_IF_HALF    = 0.25;                 // paso cuando permites cuartos de hora
  const MIN_STEP_IF_INTEGER = 1;                   // paso cuando NO permites cuartos de hora

  // ====== Helpers numéricos ======
  const toNumber = v => {
    if (typeof v === 'number') return v;
    if (!v) return 0;
    // asume punto decimal
    return parseFloat( (''+v).replace(/,/g,'') ) || 0;
  };

  const formatQty = (n, allowHalf) => {
    // Muestra sin decimales si es entero; si no, muestra 1 decimal (soporta .5)
    if (Number.isInteger(n)) return n.toString();
    return allowHalf ? n.toFixed(1) : Math.round(n).toString();
  };

  const roundToStep = (x, step) => Math.round(x / step) * step;

	// Detecta la unidad desde data-attributes o, si no existen, la infiere del texto del span.
	// Prioridades: data-unit en el span > data-unit en la fila > parseo del texto > 'hr' por defecto.
	function detectUnit($span, $row){
	  let unit = ($span.data('unit') || $row.data('unit') || '').toString().trim();

	  if (!unit) {
	    const txt = ($span.text() || '').trim();
	    // Intenta capturar lo que venga DESPUÉS del número (incluye símbolos como hr, h, min, %, etc.)
	    // Ejemplos válidos: "6 hr", "6.5 h", "2,00 hr", "1.5min"
	    const m = txt.match(/^\s*[-+]?\d+(?:[.,]\d+)?\s*([^\d\s].*)$/);
	    if (m) unit = m[1].trim();
	  }
	  return unit || 'hr';
	}

	// Siempre 2 decimales para que salga "6.00"
	function formatQtyLabel(n){
	  return Number(n).toFixed(2);
	}

  // ====== Lee categorías únicas desde las filas ======
  function collectCategories(){
    const set = new Set();
    i = 0
    $(ROW_SELECTOR).each(function(){
    	i = i+1
      const cat = ($(this).attr(CAT_ATTR) || '').trim();
      if (cat) set.add(cat);
    });
    return Array.from(set).sort((a,b)=>a.localeCompare(b));
  }

  // ====== Filtra filas por categoría ======
  function rowsByCategory(cat){
    return $(ROW_SELECTOR).filter(function(){
      return ($(this).attr(CAT_ATTR) || '').trim() === cat;
    });
  }

  // ====== Suma cantidades visibles/ocultas de un conjunto de filas ======
  function sumQty($rows){
    let sum = 0;
    $rows.each(function(){
      // Prioriza el input hidden, si no, toma el span
      const $hidden = $(this).find(HIDDEN_QTY_SEL);
      const $span   = $(this).find(VISIBLE_QTY_SEL);

      let q = 0;
      if ($hidden.length) q = toNumber($hidden.val());
      else if ($span.length) q = toNumber($span.text());
      sum += q;
    });
    return sum;
  }

  // ====== Construye arreglo de items con referencias DOM y qty actual ======
  function collectItems($rows){
    const items = [];
    $rows.each(function(){
      const $row    = $(this);
      const $hidden = $row.find(HIDDEN_QTY_SEL);
      const $span   = $row.find(VISIBLE_QTY_SEL);

      const current = $hidden.length ? toNumber($hidden.val()) : toNumber($span.text());
      const unit    = detectUnit($span, $row); // <<--- NUEVO
      items.push({
        $row, $hidden, $span,
        current,
        unit,
        newQty: null
      });
    });
    return items;
  }

	// ====== Ajuste proporcional + corrección por “mayores restos” ======
	function adjustQuantities(items, targetTotal, allowHalf){
	  const step = allowHalf ? MIN_STEP_IF_HALF : MIN_STEP_IF_INTEGER;

	  // 1) Proporción base
	  const currentTotal = items.reduce((a,it)=>a+it.current,0);
	  if (currentTotal <= 0) {
	    // Si todo está en 0, reparte uniformemente en el paso elegido.
	    const per = roundToStep(targetTotal / Math.max(1,items.length), step);
	    items.forEach(it => it.newQty = per);
	  } else {
	    const factor = targetTotal / currentTotal;
	    items.forEach(it => {
	      const raw = it.current * factor;
	      it.raw = raw;
	    });

	    // 2) Redondeo inicial al paso
	    items.forEach(it => it.newQty = roundToStep(it.raw, step));
	  }

	  // 3) Ajuste final para cuadrar exactamente la suma al objetivo
	  let sumRounded = items.reduce((a,it)=>a+it.newQty,0);                          // CAMBIO: antes era const
	  let remaining  = +(targetTotal - sumRounded).toFixed(4);                       // CAMBIO: antes era const

	  // ====== IMPONER MÍNIMOS POR ÍTEM (>0 si antes era >0) ======
	  items.forEach(it => {
	    it.lowerBound = (it.current > 0 ? step : 0);                                 // NUEVO
	    if (it.newQty < it.lowerBound) it.newQty = it.lowerBound;                    // NUEVO
	  });

	  // Recalcular suma y restante tras subir a mínimos
	  sumRounded = items.reduce((a,it)=>a+it.newQty,0);                              // NUEVO
	  remaining  = +(targetTotal - sumRounded).toFixed(4);                           // NUEVO

	  if (Math.abs(remaining) < 1e-9) {
	    return items; // ya cuadró
	  }

	  const delta = remaining > 0 ? step : -step;
	  const moves = Math.round(Math.abs(remaining) / step); // cuántos “pasos” ajustar

	  // Residuales = raw - newQty (después de imponer mínimos)
	  items.forEach(it => { it.residual = (it.raw ?? it.newQty) - it.newQty; });     // CAMBIO (reubicado)

	  if (remaining > 0) {
	    // Necesitamos sumar “moves” pasos: prioriza los de residual más alto
	    items.sort((a,b)=> (b.residual - a.residual));
	    let i = 0, count = 0;
	    while (count < moves && items.length > 0) {
	      const it = items[i % items.length];
	      it.newQty = +(it.newQty + step).toFixed(4);
	      count++; i++;
	    }
	  } else {
	    // Necesitamos restar “moves” pasos: prioriza los de residual más bajo
	    items.sort((a,b)=> (a.residual - b.residual));
	    let i = 0, count = 0;
	    let attempts = 0;                                                            // NUEVO
	    const maxAttempts = items.length * 4;                                        // NUEVO
	    while (count < moves && items.length > 0 && attempts < maxAttempts) {        // CAMBIO
	      const it = items[i % items.length];
	      const next = +(it.newQty - step).toFixed(4);
	      // Respetar el mínimo por ítem (evita 0 en ítems que eran >0)
	      if (next >= it.lowerBound) {                                              // CAMBIO
	        it.newQty = next;
	        count++;
	      }
	      i++;
	      attempts++;                                                                // NUEVO
	    }
	  }

	  return items;
	}

  // ====== UI: abrir modal, poblar categorías, actualizar horas actuales ======
  function openModal(){
    const cats = collectCategories();
    const $sel = $('#ajCat').empty();
  	$sel.append('<option value="">SELECCIONAR</option>'); // NUEVO
    cats.forEach(c => $sel.append(new Option(c, c)));

    // Setea categoría inicial y horas actuales
    updateHorasActuales();

    $('#ajHorasObjetivo').val('');
    $('#ajPermitHalf').prop('checked', false);
    $('#modalAjustarHoras').modal('show');
  }

  function updateHorasActuales(){
    const cat = $('#ajCat').val();
	  if (!cat) {                            // NUEVO
	    $('#ajHorasActuales').val('');       // NUEVO (o '0' si prefieres)
	    return;                              // NUEVO
	  }
    const $rows = rowsByCategory(cat);
    const total = sumQty($rows);
    $('#ajHorasActuales').val(total);
  }

  // ====== Aplicar ajuste ======
  function applyAdjustment(){
    const cat = $('#ajCat').val();
	  if (!cat) {                                              // NUEVO
	    alert('Es necesario seleccionar la categoría.');       // NUEVO
	    $('#ajCat').focus();                                   // NUEVO
	    return;                                                // NUEVO
	  }
    const $rows = rowsByCategory(cat);
    const items = collectItems($rows);

    const currentTotal = items.reduce((a,it)=>a+it.current,0);
    const target = toNumber($('#ajHorasObjetivo').val());
    const allowHalf = $('#ajPermitHalf').is(':checked');
	  const enforcePositive = true;               // activa “no permitir 0” por ítem
	  const minPerItem = enforcePositive ? (allowHalf ? MIN_STEP_IF_HALF : MIN_STEP_IF_INTEGER) : 0;

	  // Suma mínima que necesitarías para que todos queden > 0
	  const minTotal = items.reduce((a,it)=> a + (it.current > 0 ? minPerItem : 0), 0);
	  if (target < minTotal) {
	    alert(`Con ${target} h no se puede mantener todas las filas > 0.
	Mínimo requerido: ${minTotal} h.`);
	    return;
	  }

    if (target < 0) {
      alert('Las horas objetivo no pueden ser negativas.');
      return;
    }
    if (currentTotal === 0 && target === 0) {
      // Nada que hacer
      $('#modalAjustarHoras').modal('hide');
      return;
    }

    const adjusted = adjustQuantities(items, target, allowHalf);

    // Escribir en DOM (span + input hidden)
    adjusted.forEach(it => {
      const v = it.newQty;
      if (it.$hidden.length) it.$hidden.val(v);
      if (it.$span.length)  it.$span.text(`${formatQtyLabel(v)} ${it.unit || 'hr'}`);

    });

    calcTotal()

    $('#modalAjustarHoras').modal('hide');
  }

  // ====== Bindings ======
  $(document).on('click', '#btnAjustarHoras', openModal);
  $(document).on('change', '#ajCat', updateHorasActuales);
  $(document).on('click', '#ajAplicar', applyAdjustment);

})(jQuery);
</script>
