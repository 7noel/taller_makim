<div class="form-row">
	<div class="col-sm-4">
		{!! Field::select('relation_id', $list, ['empty'=>'Seleccionar', 'label'=>'Categoría', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('name', ['label' => 'Nombre', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('description', ['label' => 'Descripción', 'class'=>'form-control-sm']) !!}
	</div>
</div>