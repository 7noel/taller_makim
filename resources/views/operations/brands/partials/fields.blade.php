<div class="form-row">
	<div class="col-sm-4">
		{!! Field::text('name', null, ['class'=>'form-control-sm uppercase', 'required']) !!}
	</div>
	<div class="col-sm-8">
		{!! Field::text('description', null, ['class'=>'form-control-sm']) !!}
	</div>
</div>

@include('operations.brands.partials.details')