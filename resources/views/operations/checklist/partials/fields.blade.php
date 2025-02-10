<div class="form-row">
	<div class="col-sm-4">
		{!! Field::text('name', null, ['class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-8">
		{!! Field::select('type', $types, ['label' => 'Tipo', 'class'=>'form-control-sm', 'required']) !!}
	</div>
</div>

@include('operations.checklist.partials.details')

@section('scripts')
	@include('operations.checklist.scripts')
@endsection