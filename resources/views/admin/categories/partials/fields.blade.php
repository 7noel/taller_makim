<?php 
if (isset($model)) {
	if ($model->value_3 == '1') {
		$units = $units_product;
	} else {
		$units = $units_service;
	}
	
} else {
	$units = $units_service;
}

 ?>
<div class="form-row">
	<div class="col-sm-4">
		{!! Field::text('name', null, ['class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('value_3', ['1'=>'REPUESTOS'], ['label' => 'Tipo de Categoría', 'empty'=>'SERVICIOS', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('description', $units, null,['empty'=>'Seleccionar', 'label'=>'Unidad', 'class'=>'form-control-sm', 'required']) !!}

	</div>
</div>
<div class="form-row">
	<label for="">Seleccionar los maestros</label>
</div>
<div class="form-row">
{!! Form::checkboxes('data', $maestros, $model->data) !!}

</div>
<br>
{{-- Pasamos los datos de Laravel a JavaScript --}}
<script>
    let unitsService = @json($units_service);
    let unitsProduct = @json($units_product);

    $(document).ready(function () {
        $('#value_3').change(function () {
            let selectedValue = $(this).val();
            let options = selectedValue == '1' ? unitsProduct : unitsService;

            // Limpiar el select
            $('#description').empty();
            $('.description').empty();

            // Agregar nuevas opciones
            $.each(options, function (id, name) {
                $('#description').append(new Option(name, id));
                $('.description').append(new Option(name, id));
            });
        });

        // Disparar el evento change al cargar la página para establecer los valores iniciales
        //$('#value_3').trigger('change');
    });
</script>

@include('admin.categories.partials.details')

@section('scripts')
	@include('admin.categories.scripts')
@endsection