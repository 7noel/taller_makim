<div class="form-row">
	<div class="col-sm-2">
		{!! Field::select('id_type', config('options.client_doc'), ['empty'=>'Seleccionar', 'label' => 'Tipo', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('doc', ['label' => 'Número doc', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('company_name', ['label' => 'Razón Social', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<!-- <div class="col-sm-4">
		{!! Field::text('brand_name', ['label' => 'Marca', 'class'=>'form-control-sm text-uppercase']) !!}
	</div> -->
	<div class="col-sm-2">
		{!! Field::text('paternal_surname', ['label' => 'Ap Paterno', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('maternal_surname', ['label' => 'Ap Materno', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('name', ['label' => 'Nombre', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2 d-none">
		{!! Field::select('country', config('countries'), (isset($model) ? null : 'PE'), ['empty'=>'Seleccionar', 'label'=>'País', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('departamento', $ubigeo['departamento'], $ubigeo['value']['departamento'], ['empty'=>'Seleccionar', 'label'=>'Departamento', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('provincia', $ubigeo['provincia'], $ubigeo['value']['provincia'], ['empty'=>'Seleccionar', 'label'=>'Provincia', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('ubigeo_code', $ubigeo['distrito'], $ubigeo['value']['distrito'], ['empty'=>'Seleccionar', 'label'=>'Distrito', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('address', ['label' => 'Dirección', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('phone', ['label' => 'Tel Fijo', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('mobile', ['label' => 'Celular', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::email('email', ['label' => 'Email', 'class'=>'form-control-sm', 'required']) !!} 
	</div>
</div>

<div class="form-row aseguradora">
	<div class="col-sm-2 mb-3">
    	{!! Field::select('config[seguro]', ['on'=>'SI'], ['empty'=>'No', 'label'=>'Es Aseguradora', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('brand_name', ['label' => 'Nombre Comercial', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('config[currency_id]', config('options.table_sunat.moneda'), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('config[p_hora]', null, ['label' => 'Precio x Hora', 'class'=>'form-control-sm text-uppercase', 'step'=>"0.01", 'min'=>"0.00"]) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('config[p_paño]', null, ['label' => 'Precio x Paño', 'class'=>'form-control-sm text-uppercase', 'step'=>"0.01", 'min'=>"0.00"]) !!}
	</div>
</div>

@if(!isset($model))
<div class="form-row crear_vehiculo">
	<div class="col-sm-2 mb-3">
		<div class="custom-control custom-switch">
			{!! Form::checkbox('crear_vehiculo', 'on', true, ['class'=>'custom-control-input', 'id'=>'crear_vehiculo']) !!}
			<label class="custom-control-label" for="crear_vehiculo">Crear Vehículo</label>
		</div>
	</div>
</div>
@endif

@if(isset($model) and method_exists($model, 'cars'))
<table class="table table-sm table-responsive-xl">
	<thead>
		<tr>
			<th scope="col">Placa</th>
			<th scope="col">Modelo</th>
			<th scope="col">VIN</th>
			<th scope="col">Contacto</th>
			<th scope="col">Celular</th>
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody id="tableItems">
	@foreach($model->cars as $car)
		<tr data-id="{{ $car->id }}">
			<td>{{ $car->placa }}</td>
			<td>{{ $car->modelo->brand->name.' '.$car->modelo->name }}</td>
			<td>{{ $car->VIN }}</td>
			<td>{{ $car->contact_name }}</td>
			<td>{{ $car->contact_mobile }}</td>

			<td class="text-center form-inline">
				<a href="{{ route('cars.edit' , $car) }}" class="btn btn-outline-primary btn-sm" title="Edit">{!! $icons['edit'] !!}</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<a href="{!! route('cars.create_by_client', $model->id) !!}" id="btnAddCar" class="btn btn-outline-primary btn-sm" title="Agregar Vehículo">{!! $icons['add'] !!} Agregar Vehículo</a>
@endif
<br><br>

<script>
$(document).ready(function(){
	actualizar_campos()
	$('#config_seguro').change(function() {
		actualizar_campos()
	})
})
function actualizar_campos() {
	seguro = $('#config_seguro').val()
	if (seguro == 'on') {
		$('#field_brand_name').show()
		$('#field_config_currency_id').show()
		$('#field_config_p_hora').show()
		$('#field_config_p_paño').show()
	} else {
		$('#field_brand_name').hide()
		$('#field_config_currency_id').hide()
		$('#field_config_p_hora').hide()
		$('#field_config_p_paño').hide()
	}
}
</script>