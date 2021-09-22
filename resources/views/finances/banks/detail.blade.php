@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="{{ config('options.styles.card_header') }}"> {{ $labels['show'].' '.$model->name.' ('.config('options.table_sunat.moneda.'.$model->currency_id).')' }}
				</h5>
				<div class="card-body">

<div class="form-row">
	<div class="col-sm-3">
		<label for="">#Cuenta</label>
		<p class="form-control-plaintext">{{ $model->number }}</p>
	</div>
	<div class="col-sm-3">
		<label for="">#CCI</label>
		<p class="form-control-plaintext">{{ $model->cci }}</p>
	</div>
	<div class="col-sm-2">
		<label for="">Tipo de Cuenta</label>
		<p class="form-control-plaintext">{{ config('options.tipo_banco.'.$model->type) }}</p>
	</div>
	<div class="col-sm-2">
		<label for="">Saldo Inicial</label>
		<p class="form-control-plaintext">{{ $model->initial }}</p>
	</div>
	<div class="col-sm-2">
		<label for="">Saldo</label>
		<p class="form-control-plaintext">{{ $model->total }}</p>
	</div>
</div>
<br>
<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>Fecha</th>
			<th>Cliente/Proveedor</th>
			<th>Entrada</th>
			<th>Salida</th>
			<th>Documento</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($model->payments as $payment)
		<tr data-id="{{ $model->id }}">
			<td>{{ date('d/m/Y', strtotime($model->issued_at)) }}</td>
			<td>{{ $payment->proof->company->company_name }}</td>
			<td>{{ $payment->input }} </td>
			<td>{{ $payment->output }} </td>
			<td>{{ $payment->proof->document_type->description." ".$payment->proof->sn }}</td>
			<td>
				<a href="#" class="btn btn-outline-success btn-sm" title="Visualizar">{!! $icons['view'] !!}</a>
				<a href="#" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-delete btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')



@endsection