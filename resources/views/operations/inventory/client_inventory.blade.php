@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="{{ config('options.styles.card_header') }}">ORDEN DE TRABAJO {{ $model->sn }}
				</h5>
				<div class="card-body">
					@include('operations.inventory.partials.fields_reception')

					{!! Form::model($model, ['route'=> ['update_status_order', $model] , 'method'=>'PUT', 'class'=>'', 'enctype'=>"multipart/form-data"]) !!}
						@if(Request::url() != URL::previous())
						<input type="hidden" name="last_page" value="{{ URL::previous() }}">
						@endif

						@if($model->status == 'PEND')
						<p class="font-weight-bold">¿Todo en orden? Si deseas continuar con la orden de trabajo presiona la opción "SI", de lo contrario presiona la opción "NO" y el asesor encargdo revisará tu caso.</p>
						<div class="form-row mb-3">
							<div class="col-sm-12">
								<div class="custom-control custom-radio">
									<input type="radio" id="aprobacion1" name="aprobacion" class="custom-control-input" value="1">
									<label class="custom-control-label" for="aprobacion1">SI</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="aprobacion2" name="aprobacion" class="custom-control-input" value="0">
									<label class="custom-control-label" for="aprobacion2">NO</label>
								</div>
							</div>
						</div>
						<input type="hidden" name="status" value="DIAG">
						<input type="hidden" name="action" value="cliente">
						@endif
						@if($model->status == 'APROB')
						<p class="font-weight-bold">¿Deseas contnuar con el proceso de reparación por un valor de xx ? Solo debes presionala opción "SI" y tu proceso avanzará. De lo contrario presiona la opción "NO" y nuestros asesores se pondrán en contacto contigo.</p>
						<div class="form-row mb-3">
							<div class="col-sm-12">
								<div class="custom-control custom-radio">
									<input type="radio" id="aprobacion1" name="aprobacion" class="custom-control-input" value="1">
									<label class="custom-control-label" for="aprobacion1">SI</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="aprobacion2" name="aprobacion" class="custom-control-input" value="0">
									<label class="custom-control-label" for="aprobacion2">NO</label>
								</div>
							</div>
						</div>
						<input type="hidden" name="status" value="REPAR">
						<input type="hidden" name="action" value="cliente">
						@endif
						@if( in_array($model->status, ['PEND', 'APROB']) )
						<div class="form-group">
							<div class="mx-auto col-sm-6 col-md-4 col-lg-2">
								<button type="submit" class="btn btn-outline-success" id="submit">{!! $icons['save'] !!} GRABAR</button>
							</div>
						</div>
						@endif
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')



@endsection