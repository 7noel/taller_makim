<div class="form-row">
	<div class="col-sm-2">
		{!! Field::select('description', $myCompanies, ['empty'=>'Seleccionar', 'label'=>'Establecimiento', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('code', config('options.document_types'), ['empty'=>'Seleccionar', 'label'=>'Código', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('series', ['label' => 'Serie', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('number', ['label' => 'Número (Iniciar)', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
</div>
