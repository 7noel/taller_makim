@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="{{ config('options.styles.card_header') }}">CONSULTAR NACIMIENTOS
				</div>
				<div class="card-body">
					{!! Form::model($filter, ['route'=>'cars.nacimiento', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
					<div class="">
						<div class="form-row">
							<div class="col-md-2">
								{!! Field::select('f1', config('options.months'), ['empty' => 'Seleccionar', 'label'=>'Mes','class'=>'form-control-sm', 'required']) !!}
							</div>
						</div>
						<div class="form-row mb-3">
							<div class="col-sm-2 offset-sm-1">
								<button type="submit" class="btn btn-outline-success btn-sm">{!! $icons['search'] !!} Buscar</button>
							</div>
						</div>
					</div>
					{!! Form::close() !!}

					<table class="{{ config('options.styles.table') }}">
						<thead class="{{ config('options.styles.thead') }}">
							<tr>
								<th>Nacimiento</th>
								<th>Contacto</th>
								<th>Email</th>
								<th>Celular</th>
								<th>Placa</th>
								<th>Modelo</th>
								<th>Año</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($models as $model)
							<tr data-id="{{ $model->id }}">
								<td>{{ date('d/m/Y', strtotime($model->company->birth)) }}</td>
								<td>{{ $model->contact_name }} </td>
								<td>{{ $model->contact_email }} </td>
								<td><a href="https://wa.me/+51{{ $model->contact_mobile }}" target="_blank" class="btn btn-sm btn-link">{{ $model->contact_mobile }}</a></td>
								<td>{{ $model->placa }}</td>
								<td>{{ $model->modelo->brand->name." ".$model->modelo->name }} </td>
								<td>{{ $model->year }} </td>
								<td>
									<a href="{{ route('clients.show', $model->company->id) }}" class="btn btn-outline-secondary btn-sm" title="Ver">{!! $icons['view'] !!}</a>
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
