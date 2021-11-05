@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="{{ config('options.styles.card_header') }}"> {{ $labels['show'] }} </h5>
				<div class="card-body">
					{!! Form::model($model, ['route' => $routes['store'], 'class'=>'']) !!}
					@include($views['fields'])
					{!! Form::close() !!}
				</div>
			</div>
			<?php 
			$audits = $model->audits()->with('user')->get();
			 ?>
			@if($audits->isNotEmpty())
			<br>
			<a class="btn btn-sm btn-info" href="#" onclick="history.go(-1)"> << Regresar</a>
			<div>
				<a class="btn btn-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
					Ver Historial
			  </a>
			</div>
			<div class="collapse col-md-6" id="collapseExample">
				<table class="table table-sm table-striped">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Usuario</th>
						</tr>
					</thead>
					<tbody>
				@foreach ($audits as $audit)
					<tr>
						<td>{{ $audit->created_at->format('Y-m-d') }}</td>
						<td>{{ $audit->created_at->format('h:i:s A') }}</td>
						<td>{{ $audit->user->name }}</td>
					</tr>
				@endforeach
						
					</tbody>
				</table>
			</div>
			@endif
		</div>
	</div>
</div>

@endsection

@section('scripts')



@endsection