<div class="form-row">
	<div class="col-sm-2">
		{!! Field::select('my_company', $locales, ['label' => 'Local', 'empty'=>'Seleccionar', 'class'=>'form-control-sm', 'required'=>'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('id_type', config('options.employee_doc'), ['empty'=>'Seleccionar', 'label' => 'Tipo', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('doc', ['label' => 'Número doc', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('paternal_surname', ['label' => 'Ap Paterno', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('maternal_surname', ['label' => 'Ap Materno', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('name', ['label' => 'Nombre', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('job_id', $jobs, ['empty'=>'Seleccionar', 'label'=>'Cargo', 'class'=>'form-control-sm', 'required']) !!}
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
		{!! Field::text('phone', ['label' => 'Teléfono', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('mobile', ['label' => 'Celular', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::email('email', ['label' => 'Email', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::date('birth', ['label' => 'Nacimiento', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('bank_bcp', ['label' => 'Banco Bcp', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('bank_other', ['label' => 'Otro Banco', 'class'=>'form-control-sm']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-sm-12">
		<div class="custom-control custom-switch">
			<input type="checkbox" class="custom-control-input" id="customSwitch1" name="config[vale]" {{ (isset($model->config['vale']) and $model->config['vale']!='' ) ? 'checked' : '' }}>
			<label class="custom-control-label" for="customSwitch1">Se le genera Vales (para maestros pintores, planchadores, etc que necesiten vales)</label>
		</div>
	</div>
</div>
<br>
<div class="form-row">
	<div class="col-sm-12">
		<div class="form-group">
			{!! Form::label('user','Usuario', ['class'=>'control-label']) !!}
			{!! Form::hidden('user_id', null, ['id'=>'user_id']) !!}
			{!! Form::text('user', ((isset($model->user->email)) ? $model->user->email.' '.$model->user->name : ''), ['class'=>'form-control', 'id'=>'txtuser']) !!}
		</div>
	</div>
</div>