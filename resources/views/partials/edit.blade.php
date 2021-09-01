@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="{{ config('options.styles.card_header') }}"> {{ $labels['edit'] }}
				</h5>
				<div class="card-body">
					{!! Form::model($model, ['route'=> [$routes['update'], $model] , 'method'=>'PUT', 'class'=>'', 'enctype'=>"multipart/form-data"]) !!}
						@if(Request::url() != URL::previous())
						<input type="hidden" name="last_page" value="{{ URL::previous() }}">
						@endif
						@include($views['fields'])
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-outline-success" id="submit">{!! $icons['save'] !!} {{ $labels['edit.update'] }}</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
			@include('partials.delete')
			<?php 
			$audits = $model->audits()->with('user')->get();
			 ?>
			@if($audits->isNotEmpty())
			<br>
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

<?php 
//dd($views['scripts']);
 ?>
@section('scripts')
@include( $views['scripts'] )


@endsection