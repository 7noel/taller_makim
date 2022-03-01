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
	<div class="col-sm-4">
		{!! Field::text('brand_name', ['label' => 'Marca', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('paternal_surname', ['label' => 'Ap Paterno', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('maternal_surname', ['label' => 'Ap Materno', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('name', ['label' => 'Nombre', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
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
		{!! Field::email('email', ['label' => 'Email', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::date('birth', ['label' => 'Nacimiento', 'class'=>'form-control-sm']) !!}
	</div>
</div>
