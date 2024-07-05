@if(isset(session('my_company')->id))
	{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
	{!! Form::hidden('with_tax', 0, ['id'=>'with_tax']) !!}
	{!! Form::hidden('tax', null, ['id'=>'tax']) !!}
@endif
{!! Form::hidden('categoria', '', ['id'=>'categoria']) !!}
{!! Form::hidden('company_id', ((isset($car))? $car->company_id : null), ['id'=>'company_id']) !!}
{!! Form::hidden('car_id', ((isset($car))? $car->id : null), ['id'=>'car_id']) !!}
{!! Form::hidden('sn', null, ['id'=>'sn']) !!}
{!! Form::hidden('total', null, ['id'=>'total']) !!}
{!! Form::hidden('subtotal', null, ['id'=>'subtotal']) !!}
{!! Form::hidden('action', $action, ['id'=>'action']) !!}

@if(!isset($model) and isset($car))
<input type="hidden" name="last_page" value="{{ route('output_orders.index') }}">
@endif

<h3>RECEPCIÓN</h3>

@if((!isset($model) or (isset($model) and $model->status == 'PEND')) and $action != 'cliente')
<div class="form-row mb-3">
	<div class="col-sm-2">
		<a href="{{ route('cars.create') }}" class="btn btn-sm btn-link">[[ Crear Vehículo ]]</a>
	</div>
</div>

<div class="form-row">
	<div class="col-md-1 col-sm-2">
		{!! Form::label('sn', 'OT') !!}
		@if(isset($model) and $model->order_type == 'output_orders')
		{!! Form::text('sn', null, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
		@else
		{!! Form::text('sn', '',['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
		@endif
	</div>
	@if(isset($quote->id))
	<div class="col-md-1 col-sm-2">
		{!! Form::hidden('order_id', $quote->id, ['id'=>'order_id']) !!}
		{!! Form::label('quote_sn', 'Pres.') !!}
		{!! Form::text('quote_sn', $quote->sn, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
	</div>
	@endif
	<div class="col-md-1 col-sm-2">
		{!! Field::text('placa', ((isset($car))? $car->placa : null), ['label' => 'Placa', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-md-1 col-sm-2">
		{!! Field::number('kilometraje', null, ['label' => 'Kilom.', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-1">
		{!! Field::select('currency_id', config('options.table_sunat.moneda'), (isset($model) ? null : 1), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('type_service', config('options.types_service'), ['empty'=>'Seleccionar', 'label'=>'Servicio', 'class'=>'form-control-sm', 'required']) !!}
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
		{!! Field::select('payment_condition_id', $payment_conditions, (isset($model) ? null : 1), ['empty'=>'Seleccionar', 'label'=>'Cond. P.', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		<div id="field_inventory_combustible" class="form-group">
			<label for="inventory_combustible">
				Combustible
			</label>
			<input class="" id="inventory_combustible" name="inventory[combustible]" type="range" step='25' value="{{(isset($model->inventory->combustible))? $model->inventory->combustible:''}}">
		</div>
	</div>
	<div class="col-sm-2">
		{!! Field::select('inventory[comprobante]', ['FACTURA'=>'FACTURA', 'BOLETA'=>'BOLETA'], (isset($model->inventory->comprobante) ? $model->inventory->comprobante : ''), ['empty'=>'SIN COMPROBANTE', 'label'=>'Comprobante', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::date('inventory[entrega]', (isset($model->inventory->entrega) ? $model->inventory->entrega : date('Y-m-d')), ['label'=>'F. Entrega', 'class'=>'form-control-sm']) !!}
	</div>
</div>

<div class="form-row">
	<div class="col-sm-12">
		<div id="field_inventory_trabajos" class="form-group">
			<label for="inventory_trabajos">Trabajos</label>
			<textarea class="form-control form-control-sm" id="inventory_trabajos" rows="3" name="inventory[trabajos]">{{(isset($model->inventory->trabajos))? trim($model->inventory->trabajos):''}}</textarea>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="col-sm-12">
		<div id="field_inventory_observaciones" class="form-group">
			<label for="inventory_observaciones">Observaciones</label>
			<textarea class="form-control form-control-sm" id="inventory_observaciones" rows="3" name="inventory[observaciones]">{{(isset($model->inventory->observaciones))? trim($model->inventory->observaciones):''}}</textarea>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="col-sm-3">
	@foreach (config('options.inventory.col_1') as $label)
		<div class="custom-control custom-switch">
			<input type="checkbox" class="custom-control-input" id="{{$label}}" name="inventory[{{$label}}]" {{ ((isset($model->inventory->$label) and $model->inventory->$label==true))?'checked':'' }}>
			<label class="custom-control-label" for="{{$label}}">{{ $label }}</label>
		</div>
	@endforeach
	</div>
	<div class="col-sm-3">
	@foreach (config('options.inventory.col_2') as $label)
		<div class="custom-control custom-switch">
			<input type="checkbox" class="custom-control-input" id="{{$label}}" name="inventory[{{$label}}]" {{((isset($model->inventory->$label) and $model->inventory->$label==true))?'checked':''}}>
			<label class="custom-control-label" for="{{$label}}">{{ $label }}</label>
		</div>
	@endforeach
	</div>
</div>

<div class="form-row">
	<div class=" col-sm-12">FOTOS</div>
	<div class="col-sm-12" id="carouselExampleControlsFotos">
		@php $fotos_recepcion_items = 0; @endphp
		@if(isset($model->inventory->photos))
			@foreach($model->inventory->photos as $key => $photo)
				<input type="hidden" name="inventory[photos][0]" value="{{ $photo }}">
				@php $fotos_recepcion_items = $fotos_recepcion_items + 1; @endphp
			@endforeach
		@endif
		<div class="input-group" id='recepcion_div_{{ $fotos_recepcion_items }}'>
			<input type="file" name="inventory[photos][{{ $fotos_recepcion_items }}]" class="form-control form-control-sm input-files" accept="image/*" capture="camera" onchange="loadFile(event, 'carouselExampleControls')">
			<div class="input-group-append d-none">
				<button class="btn-delete btn btn-outline-danger btn-sm" type="button" title="Eliminar" onclick="eliminarElementos('carousel_element_{{ $fotos_recepcion_items }}', 'recepcion_div_{{ $fotos_recepcion_items }}')">{!! $icons['remove'] !!}</button>
			</div>
		</div>
	</div>
</div>

<div class="container mt-3 mb-3 col-sm-6">
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			@if(isset($model->inventory->photos))

				@foreach($model->inventory->photos as $key => $photo)
				@php
				$activo = ($key==0) ? 'active':'';
				@endphp
				<div class="carousel-item {{ $activo }}" id="carousel_element_{{ $key }}">
					<img class="d-block w-100" id="recepcion_img_{{ $key }}" src="/storage/{{ $photo }}">
				</div>
				@endforeach
			@endif
			<input type="hidden" value="{{ $fotos_recepcion_items }}" id="fotos_recepcion_items">
		</div>
		<button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</button>
	</div>
	
</div>
@else

<div class="form-row">
	<div class="col-md-1 col-sm-2">
		{!! Form::label('sn', 'OT', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ $model->sn }}</p>
	</div>
	@if(isset($quote->id))
	<div class="col-md-1 col-sm-2">
		{!! Form::hidden('order_id', $quote->id, ['id'=>'order_id']) !!}
		{!! Form::label('quote_sn', 'Pres.') !!}
		{!! Form::text('quote_sn', $quote->sn, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
	</div>
	@endif
	<div class="col-md-1 col-sm-2">
		{!! Form::label('sn', 'Placa', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ $model->placa }}</p>
	</div>
	<div class="col-md-1 col-sm-2">
		{!! Form::label('sn', 'Kilometraje', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ $model->kilometraje }}</p>
	</div>
	<div class="col-sm-1">
		{!! Form::label('sn', 'Moneda', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ config('options.table_sunat.moneda.'.$model->currency_id) }}</p>
	</div>
	<div class="col-sm-2">
		{!! Form::label('sn', 'Servicio', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ $model->type_service }}</p>
	</div>
	<div class="col-sm-1 d-none">
		{!! Form::label('sn', 'Preventivo', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ $model->preventivo }}</p>
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Form::label('sn', 'Asesor', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ $model->seller->company_name }}</p>
	</div>
	<div class="col-sm-2">
		{!! Form::label('sn', 'Cond. P.', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ isset($model->payment_condition->name) ? $model->payment_condition->name : "" }}</p>
	</div>
	<div class="col-sm-2">
		{!! Form::label('sn', 'Combustible', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ isset($model->inventory->combustible) ? $model->inventory->combustible.' %' : "" }}</p>
	</div>
	<div class="col-sm-2">
		{!! Form::label('sn', 'Comprobante', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ isset($model->inventory->comprobante) ? $model->inventory->comprobante : "" }}</p>
	</div>
	<div class="col-sm-2">
		{!! Form::label('sn', 'F. Entrega', ['class'=>'font-weight-bold']) !!}
		<p class="form-control-sm">{{ isset($model->inventory->entrega) ? $model->inventory->entrega : "" }}</p>
	</div>
</div>

<div class="form-row">
	<div class="col-sm-12">
		<div id="field_inventory_trabajos" class="form-group">
			<input class="" id="inventory_solicitud" name="inventory[solicitud]" type="hidden" value="{{(isset($model->inventory->solicitud))? $model->inventory->solicitud:''}}">
			<label for="inventory_solicitud" class="font-weight-bold">Solicitud:</label>
			<p>{{(isset($model->inventory->solicitud))? trim($model->inventory->solicitud):'-'}}</p>
		</div>
	</div>
	<div class="col-sm-12">
		<div id="field_inventory_observaciones" class="form-group">
			<input class="" id="inventory_observaciones" name="inventory[observaciones]" type="hidden" value="{{(isset($model->inventory->observaciones))? $model->inventory->observaciones:''}}">
			<input type="hidden" value="on">
			<label for="inventory_observaciones" class="font-weight-bold">Observaciones</label>
			<p>{{(isset($model->inventory->observaciones))? trim($model->inventory->observaciones):'-'}}</p>
		</div>
	</div>
</div>

<div class="form-row">
	<div class="col-sm-3">
	@foreach (config('options.inventory.col_1') as $label)
		<div class="">
			@if( isset($model->inventory->$label) and $model->inventory->$label==true )
			<input type="hidden" name="inventory[{{$label}}]" value="on">
			<label class="" for="{{$label}}">{!! $icons['check'] !!}  {{ $label }}</label>
			@else
			<label class="" for="{{$label}}">{!! $icons['close'] !!}  {{ $label }}</label>
			@endif
		</div>
	@endforeach
	</div>
	<div class="col-sm-3">
	@foreach (config('options.inventory.col_2') as $label)
		<div class="">
			@if( isset($model->inventory->$label) and $model->inventory->$label==true )
			<input type="hidden" name="inventory[{{$label}}]" value="on">
			<label class="" for="{{$label}}">{!! $icons['check'] !!}  {{ $label }}</label>
			@else
			<label class="" for="{{$label}}">{!! $icons['close'] !!}  {{ $label }}</label>
			@endif
		</div>
	@endforeach
	</div>
</div>

<div class="form-row mb-3">
	<div class=" col-sm-12 mt-3 font-weight-bold">
		Evidencia Fotográfica Recepción
		<button class="btn btn-outline-dark btn-sm" type="button" id="button-mostrar-fotos-recepcion" title="Ver" onclick="mostrarOcultarElementos('button-ocultar-fotos-recepcion,fotos-recepcion', 'button-mostrar-fotos-recepcion')">{!! $icons['view'] !!}</button>
		<button class="btn btn-outline-dark btn-sm d-none" type="button" id="button-ocultar-fotos-recepcion" title="Mostrar" onclick="mostrarOcultarElementos('button-mostrar-fotos-recepcion', 'button-ocultar-fotos-recepcion,fotos-recepcion')">{!! $icons['view-close'] !!}</button>
	</div>
	<div class="col-sm-12" id="carouselExampleControlsFotos">
		@php $fotos_recepcion_items = 0; @endphp

		@if(isset($model->inventory->photos))
			@foreach($model->inventory->photos as $key => $photo)
				<input type="hidden" name="inventory[photos][0]" value="{{ $photo }}">
				@php $fotos_recepcion_items = $fotos_recepcion_items + 1; @endphp
			@endforeach
		@endif
	</div>
</div>

<div class="container mb-3 col-sm-6 d-none" id="fotos-recepcion">
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			@if(isset($model->inventory->photos))
				@foreach($model->inventory->photos as $key => $photo)
				@php
				$activo = ($key==0) ? 'active':'';
				@endphp
				<div class="carousel-item {{ $activo }}" id="carousel_element_{{ $key }}">
					<img class="d-block w-100" id="recepcion_img_{{ $key }}" src="/storage/{{ $photo }}">
				</div>
				@endforeach
			@endif
			<input type="hidden" value="{{ $fotos_recepcion_items }}" id="fotos_recepcion_items">
		</div>
		<button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</button>
	</div>
</div>
@endif