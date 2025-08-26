@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="{{ config('options.styles.card_header') }}"> 
				@if($action == "edit")
				Editar Inventario
				@else
				Nuevo Inventario
				@endif
				</h5>
				<div class="card-body padding-0">
				@if($action == "edit")
					{!! Form::model($model, ['route'=> ['inventory.update', $model] , 'method'=>'PUT', 'class'=>'form-loading', 'enctype'=>"multipart/form-data"]) !!}
				@else
					{!! Form::open(['route'=> 'inventory.store' , 'method'=>'POST', 'class'=>'', 'enctype'=>"multipart/form-data"]) !!}
				@endif
						@if(Request::url() != URL::previous())
						<input type="hidden" name="last_page" value="{{ URL::previous() }}">
						@endif
						@include('operations.inventory.partials.fields')
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-outline-success" id="submit">{!! $icons['save'] !!} Crear Inventario</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		@if($action == "edit")

			@include('partials.delete')
			<?php 
			if (method_exists($model, 'audits')) {
				$audits = $model->audits()->with('user')->get();
			} else {
				$audits = collect([]);
			}
			
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
		@endif
		</div>
	</div>
</div>

<!-- Modal Car -->
<div class="modal fade" id="carModal" tabindex="-1" aria-labelledby="carModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carModalLabel">Crear Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('operations.cars.partials.fields')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-crear-car">Guardar Vehículo</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Client -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel">Crear Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('finances.clients.partials.fields')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-crear-cliente">Guardar Cliente</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Marca -->
<div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="marcaModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="marcaModalLabel">Crear Marca y Modelo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="marca_id">
					<label for="marca" class="col-form-label-sm">Marca</label>
					<input type="text" class="form-control form-control-sm text-uppercase" id="marca">
					<div id="marcaFeedback" class="invalid-feedback">Esta Marca ya existe</div>
				</div>
				<div class="form-group">
					<label for="modelo_name" class="col-form-label-sm">Modelo</label>
					<input type="text" class="form-control form-control-sm text-uppercase" id="modelo_name">
					<div id="modeloNameFeedback" class="invalid-feedback">Este Modelo ya existe</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn-crear-marca">Guardar Marca y Modelo</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Confirmar Crear Vehiculo -->
<div class="modal fade" id="confirmCrearCar" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="marcaModalLabel">Placa <span id="spanPlaca"></span> no encontrada</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				¿Deseas crear la ficha vehicular para continuar?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
				<button type="button" class="btn btn-primary btn-sm" id="btnConfirmCrearCar">Registrar vehículo</button>
			</div>
		</div>
	</div>
</div>

@endsection