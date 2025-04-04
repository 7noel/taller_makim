<div class="form-row">
	<div class="col-sm-3">
		{!! Field::text('name', ['label' => 'Nombre', 'class'=>'form-control-sm', 'required'=>'required']) !!}
	</div>
	<div class="col-sm-3">
		{!! Field::email('email', ['label' => 'Correo Electrónico', 'class'=>'form-control-sm', 'required'=>'required']) !!}
	</div>
	<div class="col-sm-3">
		{!! Field::password('password', ['label' => 'Contraseña', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-3">
		{!! Field::select('my_company', $locales, ['label' => 'Local', 'empty'=>'Seleccionar', 'class'=>'form-control-sm', 'required'=>'required']) !!}
	</div>
</div>
<div  class="form-row">
	{!! Form::label('select-roles','Seleccionar Roles', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		@if(\Auth::user()->is_superuser)
		<div class="custom-control custom-checkbox">
			{!! Form::checkbox('is_superuser', '1', null,['class'=>'custom-control-input', 'id'=>'is_superuser']) !!}
  			<label class="custom-control-label" for="is_superuser">SUPER USUARIO</label>
		</div>
		@endif
		@if(isset($model))
			{!! Form::checkboxes('roles', $roles->pluck('name', 'id'), $model->roles->pluck('id')->toArray()) !!}
		@else
			{!! Form::checkboxes('roles', $roles->pluck('name', 'id'), []) !!}
		@endif
	</div>
</div>