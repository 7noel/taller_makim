{!! Form::hidden('my_company', auth()->user()->my_company, ['id'=>'my_company']) !!}
{!! Form::hidden('is_downloadable', 0, ['id'=>'is_downloadable']) !!}
{!! Form::hidden('with_tax', 0, ['id'=>'with_tax']) !!}
{!! Form::hidden('company_id', null, ['id'=>'client_id']) !!}
{!! Form::hidden('car_id', null, ['id'=>'car_id']) !!}
<!-- {!! Form::hidden('sn', null, ['id'=>'sn']) !!} -->

@if(isset($model))
	@if(request()->input('type_service') == 'AMPLIACION')
		{!! Form::hidden('parent_quote_id', optional($inventory->mainSiniestro)->id, ['id'=>'parent_quote_id']) !!}
	@endif
	@php
	//dd($action);
	$panel_status = ($action == 'create') ? 'DIAG' : ($inventory->status ?? 'DIAG');
	@endphp

	@if(optional($inventory)->id)
		<a href="{{ route( 'panel', $panel_status ) }}" class="btn btn-outline-info btn-sm" title="Tablero"><i class="fa-solid fa-arrow-left"></i> TABLERO</a>
	@else
		<a href="{{ route( 'panel', $panel_status ) }}" class="btn btn-outline-info btn-sm" title="Listado"><i class="fa-solid fa-list"></i></i> Listado</a>
	@endif
	@if($model->order_type == 'output_quotes')
		@if(! optional($inventory)->id)
			{!! Form::hidden('is_walk_in', 1) !!}
		@endif
		<a href="{{ route( 'output_quotes.print_details' , $model->id ) }}" target="_blank" class="btn btn-outline-danger btn-sm" title="PDF por Items">{!! $icons['pdf'] !!} PDF Items</a>
		<a href="{{ route( 'output_quotes.print_categories' , $model->id ) }}" target="_blank" class="btn btn-outline-danger btn-sm" title="PDF por Categorias">{!! $icons['pdf'] !!} PDF Categorías</a>
		<a href="{{ route( 'output_quotes.print_taller' , $model->id ) }}" target="_blank" class="btn btn-outline-secondary btn-sm" title="PDF">{!! $icons['pdf'] !!} PDF Taller</a>

		@if(optional($inventory)->id)
		<div class="btn-group">
			<button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Otros Presupuestos
			</button>
			<div class="dropdown-menu">
			@if(optional($inventory)->mainSiniestro)
				<a class="dropdown-item btn-sm" href="{{ route('output_quotes.by_inventory', [$inventory->id, 'type_service'=>'AMPLIACION']) }}">Nuevo Ampliación</a>
				@if($model->id != $inventory->mainSiniestro->id)
					<a class="dropdown-item btn-sm" href="{{ route( 'output_quotes.edit' , $inventory->mainSiniestro ) }}" title="Presupuesto Principal">{{ $inventory->mainSiniestro->sn }} {{ $inventory->mainSiniestro->type_service }}</a>
				@endif
				@foreach($inventory->ampliaciones as $quote)
					@if($model->id != $quote->id)
						<a class="dropdown-item btn-sm" href="{{ route('output_quotes.edit', $quote->id) }}">{{ $quote->sn }} {{ $quote->type_service }}</a>
					@endif
				@endforeach
			@endif
				<!-- <div class="dropdown-divider"></div> -->
				<a class="dropdown-item btn-sm" href="{{ route('output_quotes.by_inventory', [$inventory->id, 'type_service'=>'PARTICULAR']) }}">Nuevo Particular</a>
				@foreach($inventory->particulares as $quote)
					@if($model->id != $quote->id)
						<a class="dropdown-item btn-sm" href="{{ route('output_quotes.edit', $quote->id) }}">{{ $quote->sn }}  {{ $quote->type_service }}</a>
					@endif
				@endforeach
			</div>
		</div>
		@endif
		<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle d-none">Sig. Estado <i class="fa-solid fa-arrow-right"></i></a>
		
	@endif
	<br>
@endif
<br>
<div class="form-row">
	<div class="col-md-1 col-sm-2">
		{!! Form::label('sn', 'Presup.') !!}
		@if(isset($model) and $model->order_type == 'output_quotes')
		{!! Form::text('sn', null, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
		@else
		{!! Form::text('sn', '',['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
		@endif
	</div>
	@if(isset($inventory->id))
	<div class="col-md-1 col-sm-2">
		{!! Form::hidden('order_id', $inventory->id, ['id'=>'order_id']) !!}
		{!! Form::label('inventory_sn', 'Inventario') !!}
		{!! Form::text('inventory_sn', $inventory->sn, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
	</div>
	@endif
	<div class="col-md-2 col-sm-4">
		{!! Field::text('placa', null, ['label' => 'Placa', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-md-1 col-sm-2">
		{!! Field::number('kilometraje', null, ['label' => 'Kilom.', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-1">
		{!! Field::select('currency_id', config('options.table_sunat.moneda'), (isset($model) ? null : 1), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('type_service', $service_types, ['empty'=>'Seleccionar', 'label'=>'Servicio', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('insurance_company_id', $insurance_companies, ['empty'=>'Seleccionar', 'label'=>'Cia Seguro', 'class'=>'form-control-sm', 'id'=>'seguro']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('claim_number', ['label'=>'#Siniestro', 'class'=>'form-control-sm', 'id'=>'claim_number']) !!}
	</div>
	<div class="col-sm-1 d-none">
		{!! Field::select('preventivo', config('options.preventivos'), ['empty'=>'Seleccionar', 'label'=>'Preventivo', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		@if(isset(\Auth::user()->employee->job_id) and (\Auth::user()->employee->job_id == 8 or \Auth::user()->id==3))
		{!! Field::select('seller_id', [\Auth::user()->employee->id => \Auth::user()->employee->full_name], ['empty'=>'Seleccionar', 'label'=>'Asesor', 'class'=>'form-control-sm', 'required']) !!}
		@else
		{!! Field::select('seller_id', $sellers, ['empty'=>'Seleccionar', 'label'=>'Asesor', 'class'=>'form-control-sm', 'required']) !!}
		@endif
	</div>
	<div class="col-sm-2">
		{!! Field::number('diagnostico[tiempo]', (isset($model->diagnostico->tiempo)) ? $model->diagnostico->tiempo : null, ['label' => 'Días de trabajo', 'class'=>'form-control-sm text-uppercase text-center', ]) !!}
	</div>
    <div class="col-md-2 col-sm-4">
        {!! Field::text('inventory[contact_name]', (isset($model->inventory->contact_name
        ) ? $model->inventory->contact_name : ''), ['label' => 'Contacto Nombre', 'class'=>'form-control-sm text-uppercase']) !!}
    </div>
    <div class="col-md-2 col-sm-4">
        {!! Field::text('inventory[contact_mobile]', (isset($model->inventory->contact_mobile
        ) ? $model->inventory->contact_mobile : ''), ['label' => 'Contacto Celular', 'class'=>'form-control-sm text-uppercase']) !!}
    </div>
	<div class="col-md-4 col-sm-6">
		{!! Field::text('comment', ($action=='create') ? '' : null,['label' => 'Comentarios', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
</div>
@if(isset($model) and $model->order_type == 'output_quotes')
	@php
		if(isset($model->diagnostico->p_hora)) {
			$p_hora = $model->diagnostico->p_hora;
			$p_paño = $model->diagnostico->p_paño;
		} elseif (!is_null($model->insurance_company)) {
			$p_hora = $model->insurance_company->config['p_hora'];
			$p_paño = $model->insurance_company->config['p_paño'];
		} else {
			$p_hora = 0;
			$p_paño = 0;		
		}
	@endphp
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::number('diagnostico[p_hora]', $p_hora, ['label' => 'Precio x Hora', 'class'=>'form-control-sm text-uppercase', 'step'=>"0.01", 'min'=>"0.00"]) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('diagnostico[p_paño]', $p_paño, ['label' => 'Precio x Paño', 'class'=>'form-control-sm text-uppercase', 'step'=>"0.01", 'min'=>"0.00"]) !!}
	</div>
</div>

	@include('operations.output_quotes.partials.details')
@endif

<script>

$(document).ready(function () {
    $('#btnConfirmCrearCar').on('click', function () {
        $('#confirmCrearCar').modal('hide');
        $('#link-crear-car').trigger('click'); // simula el click
        // $('#txtplaca').focus()
    });
    // Button trigger modal
    var boton_car = `<button type="button" class="btn btn-sm btn-link btn-label" data-toggle="modal" data-target="#carModal" id="link-crear-car">[[ Nuevo ]]</button>`;
    // Insertamos el botón justo después del <span> dentro del label
    $('label[for="placa"] span').after(boton_car)
    $('.crear_inventario').addClass('d-none')

	setTimeout(function() {
		removeRequiredCliente('#carModal');
	}, 200)

	// Cuando se abre el modal: restaurar required
	$('#carModal').on('show.bs.modal', function () {
 		restoreRequiredCliente('#carModal');
	});

    // Cuando se cierra el modal: quitar required otra vez
    $('#carModal').on('hidden.bs.modal', function () {
        removeRequiredCliente('#carModal');
    });

    $("#link-crear-car").click(function(e){
        resetFields('#carModal', ['my_company', 'txtplaca']);
        setTimeout(function() {
            if ($('#txtplaca').val()=='') {
                $('#txtplaca').focus()
            } else {
                $('#txtCompany').focus()
            }
        }, 500)

    })
    $("#btn-crear-car").click(function(e){
        crearCar()
    })
})

  function crearCar() {
    $wrap = $('#carModal');
    $btn = $('#btn-crear-car');

    if (!validateContainer()) return;

    const payload = collectData();

    console.log(payload)
    $.ajax({
      url: "{{ route('cars.ajax_crear') }}", // <- tu endpoint
      method: 'GET',
      data: payload,
      dataType: 'json',
      beforeSend: function () {
        $btn.prop('disabled', true);
      },
      success: function (res) {
        alert(res.message || 'Guardado con éxito');
        console.log(res)
        data = res.data.model
        $('#carModal').modal('hide')
        // console.log(data.company.company_name)
        $('#placa').val(data.placa)
        $('#car_id').val(data.id)
        $('#client_id').val(data.company_id)
        // $('#my_company').val(data.my_company)
        $('#txtbrand').val(data.modelo.brand.name)
        $('#txtmodelo').val(data.modelo.name)
        $('#txtyear').val(data.year)
        $('#txtcolor').val(data.color)
        $('#txtvin').val(data.vin)
        $('#txtcompany_name').val(data.company.company_name)
        $('#txtdoc').val(data.company.doc)
        $('#txtphone').val(data.company.phone)
        $('#txtmobile').val(data.company.mobile)
        $('#txtemail').val(data.company.email)
        $('#inventory_contact_name').val(data.contact_name)
        $('#inventory_contact_mobile').val(data.contact_mobile)
        $('#inventory_contact_email').val(data.contact_email)
        $('#inventory_driver_name').val(data.driver_name)
        $('#inventory_driver_mobile').val(data.driver_mobile)
        $('#inventory_driver_email').val(data.driver_email)
        $('#inventory_operator_company').val(data.operator_company)
        $('#inventory_operator_name').val(data.operator_name)
        $('#inventory_operator_mobile').val(data.operator_mobile)
        $('#inventory_combustible').focus()
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

</script>