{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('is_downloadable', 0, ['id'=>'is_downloadable']) !!}
{!! Form::hidden('with_tax', 0, ['id'=>'with_tax']) !!}
{!! Form::hidden('company_id', null, ['id'=>'company_id']) !!}
{!! Form::hidden('car_id', null, ['id'=>'car_id']) !!}
<!-- {!! Form::hidden('sn', null, ['id'=>'sn']) !!} -->

@if(isset($model))
<div class="form-row">
	<a href="{{ route( 'panel', 'DIAG' ) }}" class="btn btn-outline-info btn-sm" title="Tablero"><i class="fa-solid fa-arrow-left"></i> TABLERO</a>
	<a href="{{ route( 'output_quotes.print_details' , $model->id ) }}" target="_blank" class="btn btn-outline-danger btn-sm" title="PDF">{!! $icons['pdf'] !!} PDF por Items</a>
	<a href="{{ route( 'output_quotes.print_categories' , $model->id ) }}" target="_blank" class="btn btn-outline-danger btn-sm" title="PDF">{!! $icons['pdf'] !!} PDF por Categorías</a>
	<br>
</div>
@endif
<div class="form-row">
	<div class="col-md-1 col-sm-2">
		{!! Form::label('sn', 'Presup.') !!}
		@if(isset($model) and $model->order_type == 'output_quotes')
		{!! Form::text('sn', null, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
		@else
		{!! Form::text('sn', '',['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
		@endif
	</div>
	@if(isset($inventory->id))
	<div class="col-md-1 col-sm-2">
		{!! Form::hidden('order_id', $inventory->id, ['id'=>'order_id']) !!}
		{!! Form::label('inventory_sn', 'Inventario') !!}
		{!! Form::text('inventory_sn', $inventory->sn, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
	</div>
	@endif
	<div class="col-md-1 col-sm-2">
		{!! Field::text('placa', null, ['label' => 'Placa', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
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
		{!! Field::number('diagnostico[tiempo]', (isset($model->diagnostico->tiempo)) ? $model->diagnostico->tiempo : null, ['label' => 'Días de trabajo', 'class'=>'form-control-sm text-uppercase text-center', ]) !!}
	</div>
	<div class="col-md-4 col-sm-6">
		{!! Field::text('comment', ($action=='create') ? '' : null,['label' => 'Comentarios', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
</div>
@if(isset($model) and $model->order_type == 'output_quotes')
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::number('diagnostico[p_hora]', null, ['label' => 'Precio x Hora', 'class'=>'form-control-sm text-uppercase', 'step'=>"0.01", 'min'=>"0.00"]) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('diagnostico[p_paño]', null, ['label' => 'Precio x Paño', 'class'=>'form-control-sm text-uppercase', 'step'=>"0.01", 'min'=>"0.00"]) !!}
	</div>
</div>

	@include('operations.output_quotes.partials.details')
@endif