@if('cars' == \Str::before(\Route::currentRouteName(), '.'))
<!-- Modal Client | Solo se carga desde el registro de vehiculos -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="clientModalLabel">Crear Cliente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@include('finances.clients.partials.fields')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn-crear-cliente">Guardar Cliente</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Marca -->
<div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="marcaModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="marcaModalLabel">Crear Marca y Modelo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="marca_id">
					<label for="marca" class="col-form-label-sm">Marca</label>
					<input type="text" class="form-control form-control-sm text-uppercase" id="marca">
					<div id="marcaFeedback" class="invalid-feedback">Esta Marca ya existe</div>
				</div>
				<div class="form-group">
					<label for="modelo_name" class="col-form-label-sm">Modelo</label>
					<input type="text" class="form-control form-control-sm text-uppercase" id="modelo_name">
					<div id="modeloNameFeedback" class="invalid-feedback">Este Modelo ya existe</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn-crear-marca">Guardar Marca y Modelo</button>
			</div>
		</div>
	</div>
</div>
@endif

<!-- Modal Modelo -->
<!-- <div class="modal fade" id="modeloModal" tabindex="-1" aria-labelledby="modeloModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modeloModalLabel">Crear Modelo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="marca_id">
					<label for="marca" class="col-form-label-sm">Marca: </label>
				</div>
				<div class="form-group">
					<label for="modelo" class="col-form-label-sm">Modelo</label>
					<input type="text" class="form-control form-control-sm" id="modelo">
					<div id="modeloFeedback" class="invalid-feedback">Esta modelo ya existe</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn-crear-modelo">Grabar Modelo</button>
			</div>
		</div>
	</div>
</div> -->

{!! Form::hidden('my_company', \Auth::user()->my_company, ['id'=>'my_company']) !!}
{!! Form::hidden('company_id', ((isset($client->id)) ? $client->id : null), ['id'=>'company_id']) !!}
@if(!isset($model))
	{!! Form::hidden('slug', 24) !!}
@endif
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::text('placa', ['label' => 'Placa', 'id'=>'txtplaca', 'class'=>'form-control-sm text-uppercase', 'max'=>'7', 'required']) !!}
	</div>
	<div class="col-sm-4">
		@if(isset($client->id))
		{!! Field::text('txtCompany', $client->company_name, ['label' => 'Cliente', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
		@else
		{!! Field::text('txtCompany', ((isset($model->company_id)) ? $model->company->company_name : null), ['label' => 'Cliente', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
		@endif
	</div>
	<div class="col-sm-2">
		{!! Field::select('brand_id', $brands, ['empty'=>'Seleccionar', 'label'=>'Marca', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('modelo_id', $modelos, ['empty'=>'Seleccionar', 'label'=>'Modelo', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('body', $bodies, ['empty'=>'Seleccionar', 'label'=>'Tipo', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('color', ['label' => 'Color', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('vin', ['label' => 'VIN', 'class'=>'form-control-sm text-uppercase', 'max'=>'17', 'required']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('motor', ['label' => 'Nro Motor', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('codigo', ['label' => 'Codigo', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('year', ['label' => 'Año', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2 d-none">
		{!! Field::date('f_next-pr', ['label' => 'Prox_Preventivo', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2 d-none">
		{!! Field::date('f_revision', ['label' => 'Prox_Rev_Tec', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	{{--
	<div class="col-sm-2">
		<div class="custom-control custom-checkbox">
			{!! Form::checkbox('add_contact', '1', null,['class'=>'custom-control-input', 'id'=>'add_contact']) !!}
	  		<label class="custom-control-label" for="add_contact">Agregar un Contacto</label>
  		</div>
	</div>
	--}}
</div>
<div class="form-row contact">
	<div class="col-md-2 col-sm-4">
		{!! Field::text('contact_name', ((!isset($model) and isset($client))? $client->company_name :null), ['label' => 'Contacto Nombre', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('contact_mobile', ((!isset($model) and isset($client))? $client->mobile :null), ['label' => 'Contacto Celular', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::email('contact_email', ((!isset($model) and isset($client))? $client->email :null), ['label' => 'Contacto Email', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('driver_name', null, ['label' => 'Conductor Nombre', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('driver_mobile', null, ['label' => 'Conductor Celular', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::email('driver_email', null, ['label' => 'Conductor Email', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::email('operator_company', null, ['label' => 'Operador Empresa', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('operator_name', null, ['label' => 'Operador Contacto', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('operator_mobile', null, ['label' => 'Operador Celular', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
</div>

@if(isset($client->id) or !isset($model))
<div class="form-row mb-3 crear_inventario">
	<div class="col-sm-2">
		<div class="custom-control custom-switch">
			{!! Form::checkbox('crear_ingreso', 'on', true, ['class'=>'custom-control-input', 'id'=>'crear_ingreso']) !!}
			<label class="custom-control-label" for="crear_ingreso">Crear Recepción</label>
		</div>
	</div>
</div>
@endif

<script>
$(document).ready(function () {
  // Al inicio (modal cerrado): sin required
  setTimeout(function() {
      removeRequiredCliente('#clientModal');
  }, 1000)

  // Cuando se abre el modal: restaurar required
  $('#clientModal').on('show.bs.modal', function () {
    restoreRequiredCliente('#clientModal');
  });

  // Cuando se cierra el modal: quitar required otra vez
  $('#clientModal').on('hidden.bs.modal', function () {
    removeRequiredCliente('#clientModal');
  });

    const $name = $('#txtCompany');     // tu input de texto
    const $id   = $('#company_id');     // hidden con el id

    // Guarda el valor válido inicial
    $name.data('lastLabel', $name.val() || '');
    $name.data('lastId', $id.val() || '');

    // Cuando selecciona desde el autocomplete: fija el nuevo valor válido
    $name.on('autocompleteselect', function (e, ui) {
        $name.val(ui.item.value);
        $id.val(ui.item.id);

        // Actualiza último válido
        $name.data('lastLabel', ui.item.value);
        $name.data('lastId', ui.item.id);
        $(this).removeClass('is-invalid')
        $(this).prev().removeClass('text-danger')
    });

    // Si sale del input y NO hubo selección válida, restaurar
    $name.on('autocompletechange', function (e, ui) {
        if (!ui.item) {
            // No seleccionó un ítem del autocomplete
            $name.val($name.data('lastLabel') || '');
            $id.val($name.data('lastId') || '');
            if ($name.data('lastId')=='') {
            	$(this).addClass('is-invalid')
            	$(this).prev().addClass('text-danger')
            }
        }
    });

    // Definimos el HTML del botón
	// Button trigger modal
	var boton_marca = `<button type="button" class="btn btn-sm btn-link btn-label" data-toggle="modal" data-target="#marcaModal" id="link-crear-marca">[[ Nuevo ]]</button>`;
    var boton_modelo = `
        <button type="button" class="btn btn-sm btn-link d-none btn-label" data-toggle="modal" data-target="#marcaModal" id="link-crear-modelo">[[ Nuevo ]]</button>
    `;
    var boton_cliente = `<button type="button" class="btn btn-sm btn-link btn-label" data-toggle="modal" data-target="#clientModal" id="link-crear-cliente">[[ Nuevo ]]</button>`;
    // Insertamos el botón justo después del <span> dentro del label
    $('label[for="brand_id"] span').after(boton_marca)
    $('label[for="modelo_id"] span').after(boton_modelo)
    $('label[for="txtCompany"] span').after(boton_cliente)
    $('.aseguradora').addClass('d-none')
    $('.crear_vehiculo').addClass('d-none')


    $('#doc, #id_type').change(function(){
    	client_exist()
    })

    //carga modelos
    $('#brand_id').change(function(){
        if ($('#brand_id').val()=='') {
            $('#link-crear-marca').removeClass('d-none')
            $('#link-crear-modelo').addClass('d-none')
        } else {
            $('#link-crear-marca').addClass('d-none')
            $('#link-crear-modelo').removeClass('d-none')
        }
        cargaModelos()
    })

    $("#btn-crear-marca").click(function(e){
        crearMarcaYModelo()
    })

    $("#link-crear-cliente").click(function(e){
    	resetFields('#clientModal');
    })
    $("#btn-crear-cliente").click(function(e){
        crearCliente()
    })
    
    $('#link-crear-marca').click(function (e) {
        clearModalMarcaYModelo();
        setTimeout(function() {
            $('#marca').focus();
        }, 500)
    })
    $('#link-crear-modelo').click(function (e) {
        clearModalMarcaYModelo()
        $('#marca_id').val($('#brand_id').val())
        $('#marca').val($('#brand_id option:selected').text())
        $('#marca').prop('readonly', true);
        $('#modelo_name').focus();
    })
})

function client_exist() {
	$id_type = $('#id_type').val()
	$doc = $('#doc').val()
	$entity_type = 'clients'
    page = '/clients/ajax-list'
    if ($id_type!='' && $doc!='') {
	    $.get(page, {id_type: $id_type, doc: $doc, entity_type: $entity_type}, function(data){
	    	if (data!='') { // si existe cliente
				$('#doc').parent().find('label').addClass('text-danger')
				$('#doc').addClass('is-invalid')
				$('#doc').parent().append('<div class="invalid-feedback">Este cliente ya existe</div>')
				$('#btn-crear-cliente').prop('disabled', true)
	    	} else { // si no existe cliente
				$('#doc').parent().find('label').removeClass('text-danger')
				$('#doc').removeClass('is-invalid')
				$('#doc').parent().find('.invalid-feedback').remove()
				$('#btn-crear-cliente').prop('disabled', false)
	    	}
	    })
    }
}

function clearModalMarcaYModelo() {
    $('#marca_id').val('')
    $('#marca').removeClass('is-invalid')
    $('#marca').val('')
    $('#marca').prop('readonly', false)
    $('#modelo_name').removeClass('is-invalid')
    $('#modelo_name').val('')
}

function crearMarcaYModelo() {
    var $marca_id = $('#marca_id').val().trim()
    var $marca = $('#marca').val().trim()
    var $modelo = $('#modelo_name').val().trim()
    if ($marca=='') {
        $('#marca').addClass('is-invalid')
        $('#marcaFeedback').text('La Marca es obligatoria')
        return false
    } else {
        $('#marca').removeClass('is-invalid')
    }
    if ($modelo=='') {
        $('#modelo_name').addClass('is-invalid')
        $('#modeloNameFeedback').text('El Modelo es obligatorio')
        return false
    } else {
        $('#modelo_name').removeClass('is-invalid')
    }
    page = '/crear-marca'
    $.get(page, {brand_id: $marca_id, marca: $marca, modelo: $modelo}, function(data){
        if (data.error!=undefined) {
            if(data.error.marca!=undefined) {
                $('#marca').addClass('is-invalid')
                $('#marcaFeedback').text(data.error.marca)
                $('#modelo_name').removeClass('is-invalid')
            }
            if(data.error.modelo!=undefined) {
                $('#modelo_name').removeClass('is-invalid')
                $('#marcaFeedback').text(data.error.modelo)
                $('#modelo_name').addClass('is-invalid')
            }
        } else {
            $('#marca').removeClass('is-invalid')
            $('#modelo_name').removeClass('is-invalid')
            cargaMarcas(data.marca.id, data.modelo.id)
            //$('#brand_id').val(data.marca.id)
            //cargaModelos(data.modelo.id)
            //$('#modelo_id').val(data.modelo.id)
            $('#marcaModal').modal('hide')
        }
    })
}

/*cargar marcas*/
function cargaMarcas(id='', modelo_id=''){
    var $marcas = $('#brand_id')
    var $modelos=$('#modelo_id')
    var page = "/listarMarcas"
    $.get(page, function(data){
        $marcas.empty()
        $modelos.empty()
        $marcas.append("<option value=''>Seleccionar</option>");
        $.each(data, function (index, ModeloObj) {
            $marcas.append("<option value='"+ModeloObj.id+"'>"+ModeloObj.name+"</option>")
        })
        $('#brand_id').val(id)
        cargaModelos(modelo_id)
    })
}

/*cargar modelos*/
function cargaModelos(id=''){
    var $marca = $('#brand_id')
    var $modelos=$('#modelo_id')
    var page = "/listarModelos/" + $marca.val()
    if ($marca.val() == '') {
        $modelos.empty("")
    } else {
        $.get(page, function(data){
            $modelos.empty()
            $modelos.append("<option value=''>Seleccionar</option>");
            $.each(data, function (index, ModeloObj) {
                $modelos.append("<option value='"+ModeloObj.id+"'>"+ModeloObj.name+"</option>")
            })
            $('#modelo_id').val(id)
        })

    }
}

// Quita 'required' de todos los campos dentro de #clientModal.
// Toma un snapshot previo para poder restaurar luego.
function removeRequiredCliente(scope = '#clientModal') {
  const $scope = $(scope);

  // Snapshot individual
  if (!$scope.data('reqSnapshotDone')) {
    $scope.find('input, select, textarea').each(function () {
      const $el = $(this);
      $el.data('reqSnapshot', $el.prop('required')); // true/false
    });

    // Snapshot por grupo (radios/checkbox por name)
    const group = {};
    $scope.find('input[type="radio"], input[type="checkbox"]').each(function () {
      const name = this.name || '';
      if (!name) return;
      group[name] = (group[name] || false) || $(this).prop('required');
    });
    Object.keys(group).forEach(function (name) {
      $scope.find(`input[name="${name}"]`).data('reqSnapshotGroup', group[name]);
    });

    $scope.data('reqSnapshotDone', true);
  }

  setTimeout(function() {
	  // Quitar required
	  $scope.find('input, select, textarea')
	        .prop('required', false)
	        .removeAttr('required')
	        .removeAttr('aria-required');
  }, 200)
}

// Restaura 'required' exactamente como estaba antes de llamar a removeRequiredCliente()
function restoreRequiredCliente(scope = '#clientModal') {
  const $scope = $(scope);
  if (!$scope.data('reqSnapshotDone')) return;

  // Restaurar campos no agrupados
  $scope.find('input, select, textarea').each(function () {
    const $el = $(this);
    const type = ($el.attr('type') || '').toLowerCase();
    if (type === 'radio' || type === 'checkbox') return; // radios/checkbox abajo
    const was = !!$el.data('reqSnapshot');
    $el.prop('required', was);
    if (was) $el.attr('aria-required', 'true'); else $el.removeAttr('aria-required');
  });

  // Restaurar radios/checkbox por grupo (name)
  const handled = new Set();
  $scope.find('input[type="radio"], input[type="checkbox"]').each(function () {
    const name = this.name || '';
    if (!name || handled.has(name)) return;
    const groupWas = !!$(this).data('reqSnapshotGroup');
    const $group = $scope.find(`input[name="${name}"]`);
    $group.prop('required', groupWas);
    if (groupWas) $group.attr('aria-required', 'true'); else $group.removeAttr('aria-required');
    handled.add(name);
  });
}



  // Utilidad: marca/desmarca errores visuales (Bootstrap 4)
  function setFieldValidity($el, message) {
    $el.removeClass('is-invalid');
    $el.prev().removeClass('text-danger');
    $el.next('.invalid-feedback').remove();

    if (message) {
      $el.addClass('is-invalid');
    	$el.prev().addClass('text-danger');
      // Si es input-group, poner feedback después del grupo
      if ($el.parent('.input-group').length) {
        $el.parent().after('<div class="invalid-feedback d-block">' + message + '</div>');
      } else {
        $el.after('<div class="invalid-feedback">' + message + '</div>');
      }
    }
  }

  // Valida radios/checkboxes por name (si alguno requerido)
  function validateChoiceGroup(name) {
    const $group = $wrap.find('[name="'+name+'"]');
    if (!$group.length) return true;

    const required = $group.filter('[required]').length > 0;
    if (!required) return true;

    const anyChecked = $group.is(':checked');
    // Marca solo al primero del grupo
    setFieldValidity($group.first(), anyChecked ? '' : 'Este campo es obligatorio.');
    return anyChecked;
  }

  // Valida todos los campos del contenedor
  function validateContainer() {
    let isValid = true;

    // limpiar estados previos
    $wrap.find('.is-invalid').removeClass('is-invalid');
    $wrap.find('.invalid-feedback').remove();

    // 1) Validación de inputs/selects/textarea con HTML5
    const elements = $wrap.find('input, select, textarea').toArray();

    // Primero, agrupar radios/checkbox por name para validarlos como conjunto
    const handledGroupNames = new Set();

    for (const el of elements) {
      const $el = $(el);

      // Radios/checkboxes requeridos -> validar por grupo
      if ((el.type === 'radio' || el.type === 'checkbox') && el.name) {
        if (!handledGroupNames.has(el.name)) {
          handledGroupNames.add(el.name);
          if (!validateChoiceGroup(el.name)) isValid = false;
        }
        continue;
      }

      // Otros campos: usar checkValidity()
      if (typeof el.checkValidity === 'function') {
        if (!el.checkValidity()) {
          isValid = false;
          // Mensaje amigable (usa validationMessage del navegador)
          setFieldValidity($el, el.validationMessage || 'Campo inválido.');

          // Opcional: mostrar tooltip nativo del navegador (solo al primero inválido)
          // el.reportValidity && el.reportValidity();
        } else {
          setFieldValidity($el, '');
        }
      }
    }

    // Enfoque al primer inválido
    if (!isValid) {
      const $firstInvalid = $wrap.find('.is-invalid').first();
      if ($firstInvalid.length) {
        $firstInvalid.focus();
        // scroll suave al campo
        $('html, body').animate({ scrollTop: $firstInvalid.offset().top - 120 }, 200);
      }
    }

    return isValid;
  }

  // Serializa los campos por name (similar a serializeArray)
  function collectData() {
    const data = {};
    // Tomar solo los que tienen name
    $wrap.find('input[name], select[name], textarea[name]').each(function () {
      const $el = $(this);
      const name = $el.attr('name');

      if ($el.is(':checkbox')) {
        // checkbox: enviar "on" o valor si está marcado; si no, no enviar (o enviar 0 si prefieres)
        if ($el.is(':checked')) data[name] = $el.val() || 'on';
      } else if ($el.is(':radio')) {
        if ($el.is(':checked')) data[name] = $el.val();
      } else {
        data[name] = $el.val();
      }
    });
    return data;
  }

  // Click en Guardar
  function crearCliente() {
    $wrap = $('#clientModal');
    $btn = $('#btn-crear-cliente');

    if (!validateContainer()) return;

    const payload = collectData();
    console.log(payload)

    $.ajax({
      url: "{{ route('clients.ajax_crear') }}", // <- tu endpoint
      method: 'GET',
      data: payload,
      dataType: 'json',
      beforeSend: function () {
        $btn.prop('disabled', true);
      },
      success: function (res) {
        alert(res.message || 'Guardado con éxito');
        console.log(res)
        $('#txtCompany').removeClass('is-invalid')
        $('#txtCompany').prev().removeClass('text-danger')
        $('#clientModal').modal('hide')

        $('#txtCompany').val(res.data.company_name)
        $('#company_id').val(res.data.id)
		$('#contact_name').val(res.data.company_name)
		$('#contact_email').val(res.data.email)
		$('#contact_mobile').val(res.data.mobile)
		$('#brand_id').focus()
        // aquí puedes limpiar, cerrar modal, recargar tabla, etc.
        // Object.keys(payload).forEach(n => $wrap.find(`[name="${n}"]`).val(''));
      },
      error: function (xhr) {
        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
          // pintar errores de Laravel por campo
          const errors = xhr.responseJSON.errors;
          Object.keys(errors).forEach(function (name) {
            const $field = $wrap.find('[name="'+name+'"]');
            if ($field.length) setFieldValidity($field, errors[name][0]);
          });
          const $firstInvalid = $wrap.find('.is-invalid').first();
          $firstInvalid.length && $firstInvalid.focus();
        } else {
          alert('Error del servidor. Intenta nuevamente.');
        }
      },
      complete: function () {
        $btn.prop('disabled', false);
      }
    });
  }

// Limpia campos dentro de "scope" evitando ocultar selects por lógicas de cascada.
function resetFields(scope, exceptIds = ['departamento','provincia']) {
  const $scope  = scope ? $(scope) : $(document);
  const exclude = new Set(exceptIds);

  // 0) limpiar labels
  $scope.find('label').removeClass('text-danger');
  $scope.find('label .text-danger').removeClass('text-danger');

  // 1) inputs y textareas
  $scope.find('input, textarea').each(function () {
    const $el = $(this);
    const id  = this.id || '';
    if (exclude.has(id)) return;

    $el.removeClass('is-invalid is-valid');
    $el.next('.invalid-feedback, .valid-feedback').remove();

    const type = ($el.attr('type') || '').toLowerCase();
    if (type === 'checkbox' || type === 'radio') {
      $el.prop('checked', false);
    } else if (type === 'file') {
      $el.val(null);
    } else if ($el.attr('name') !== '_token') {
      $el.val('');
    }
  });

  // 2) selects (no disparar 'change' que activa tu cascada)
  $scope.find('select').each(function () {
    const $el = $(this);
    const id  = this.id || '';
    if (exclude.has(id)) return;

    $el.removeClass('is-invalid is-valid');

    const hasEmpty = $el.find('option[value=""]').length > 0;
    const newVal   = hasEmpty ? '' : ($el.find('option:first').val() || '');

    if ($el.hasClass('select2-hidden-accessible')) {
      // Actualiza solo la UI de Select2; evita listeners genéricos en 'change'
      $el.val(newVal).trigger('change.select2');
    } else {
      // Select normal: NO dispares 'change' para no ocultar dependientes
      if (hasEmpty) $el.val('');
      else this.selectedIndex = 0;
    }
  });

  // 3) feedback suelto
  $scope.find('.invalid-feedback, .valid-feedback').remove();
}

</script>