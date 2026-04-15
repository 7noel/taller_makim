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
			<br>
			<a class="btn btn-sm btn-info" href="#" onclick="history.go(-1)"> << Regresar</a>
			@include('partials.audit-history')
		</div>
	</div>
</div>

@endsection

@section('scripts')



@endsection