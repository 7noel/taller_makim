@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="{{ config('options.styles.card_header') }}">CAMBIAR ESTADO DE INVENTARIO #{{ $model->sn }}
				</h5>
				<div class="card-body">
					{!! Form::model($model, ['route'=> ['update_status_order', $model] , 'method'=>'PUT', 'class'=>'', 'enctype'=>"multipart/form-data"]) !!}
						@if(Request::url() != URL::previous())
						<input type="hidden" name="last_page" value="{{ URL::previous() }}">
						@endif

						{!! Form::hidden('action', '', ['id'=>'action']) !!}
						<div class="form-row">
							<div class="col-sm-2">
				                {!! Field::text('placa', null, ['label' => 'Placa', 'class'=>'form-control-sm form-control-plaintext']) !!}
				            </div>
				            <div class="col-md-2 col-sm-4">
				                <div class="form-group">
				                    <label for="brand">Marca</label>
				                    {!! Form::text('brand', $model->car->brand->name, ['class'=>'form-control-sm form-control-plaintext']) !!}
				                </div>
				            </div>
				            <div class="col-md-2 col-sm-4">
				                <div class="form-group">
				                    <label for="modelo">Modelo</label>
				                    {!! Form::text('modelo', $model->car->modelo->name, ['class'=>'form-control-sm form-control-plaintext']) !!}
				                </div>
				            </div>
						</div>
						<div class="form-row">
				            <div class="col-md-2 col-sm-4">
				                <div class="form-group">
				                {!! Field::text('company', $model->company->company_name, ['label' => 'Propietario', 'class'=>'form-control-sm form-control-plaintext']) !!}
				                </div>
				            </div>
						</div>
						<div class="form-row">
							<div class="col-md-4 col-sm-6">

								{!! Field::select('status', config('options.inventory_status_'.$model->status) , null, ['label' => 'Siguiente Status', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-outline-success" id="submit">{!! $icons['save'] !!} Guardar</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')



@endsection