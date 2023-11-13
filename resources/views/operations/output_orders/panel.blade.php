@extends('layouts.app')

@section('content')
<div class="container">

@php

$models_1 = $models->where('status', 'PEND');
$models_2 = $models->where('status', 'DIAG');
$models_3 = $models->where('status', 'REPU');
$models_4 = $models->where('status', 'APROB');
$models_5 = $models->where('status', 'REPAR');
$models_6 = $models->where('status', 'CONTR');
$models_7 = $models->where('status', 'ENTR');

@endphp
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="recepcion-tab" data-toggle="tab" data-target="#recepcion" type="button" role="tab" aria-controls="recepcion" aria-selected="true">{!! $icons['car'] !!} <br> <span class="badge badge-light">{{ $models_1->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="diagnostico-tab" data-toggle="tab" data-target="#diagnostico" type="button" role="tab" aria-controls="diagnostico" aria-selected="false">{!! $icons['view'] !!} <br> <span class="badge badge-light">{{ $models_2->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="repuestos-tab" data-toggle="tab" data-target="#repuestos" type="button" role="tab" aria-controls="repuestos" aria-selected="false"><i class="fas fa-box"></i> <br> <span class="badge badge-light">{{ $models_3->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="aprobacion-tab" data-toggle="tab" data-target="#aprobacion" type="button" role="tab" aria-controls="aprobacion" aria-selected="false"><i class="fas fa-check"></i> <br> <span class="badge badge-light">{{ $models_4->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="reparacion-tab" data-toggle="tab" data-target="#reparacion" type="button" role="tab" aria-controls="reparacion" aria-selected="false"><i class="fas fa-wrench"></i> <br> <span class="badge badge-light">{{ $models_5->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="control-tab" data-toggle="tab" data-target="#control" type="button" role="tab" aria-controls="control" aria-selected="false"><i class="fa-regular fa-circle-check"></i> <br> <span class="badge badge-light">{{ $models_6->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="entrega-tab" data-toggle="tab" data-target="#entrega" type="button" role="tab" aria-controls="entrega" aria-selected="false"><i class="fas fa-door-open"></i> <br> <span class="badge badge-light">{{ $models_7->count() }}</span> </button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="recepcion" role="tabpanel" aria-labelledby="recepcion-tab">
					<h3>RECEPCIÓN <a href="{{ route('recepcion.create') }}" type="button" class="btn btn-primary btn-sm btn-circle">{!! $icons['add'] !!}</a></h3>
					<div class="row">
						@foreach ($models_1 as $model)
						@php
						$texto = "Hola, Bienvenido a ".env('APP_NAME').". Gracias por preferirnos. Estamos a punto de ingresar tu vehículo {$model->car->modelo->brand->name} {$model->car->modelo->name} placa: {$model->car->placa}, es necesario aprobar el ingreso al taller en el siguiente link ".route( 'order_client' , $model->slug);
						$status_logs = collect($model->status_log);
						if( $status_logs->isNotEmpty() ) {
							$last_log = $status_logs->last();
							$last_log->created_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $last_log->created_at);
						} else {
							$last_log = (object) ['created_at' => $model->created_at, 'message' => '', 'aprobacion' => 1];
						}
						$class = ($last_log->aprobacion) ? '': 'text-danger';
						@endphp
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">#{{ $model->sn }} - {{ $model->car->modelo->brand->name }} {{ $model->car->modelo->name }} {{ $model->car->placa }}
										<a href="https://wa.me/+51{{ $model->company->mobile }}?text={{ $texto }}" target="_blank" class="btn btn-outline-info btn-sm btn-circle">{!! $icons['whatsapp'] !!}</a>
										<a href="{{ route( 'recepcion.edit' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ $model->company->company_name }}</h6>
									<p class="card-text {{ $class }}">{{ $last_log->message }} {{ $last_log->created_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>


				</div>
				<div class="tab-pane fade" id="diagnostico" role="tabpanel" aria-labelledby="diagnostico-tab">
					<h3>DIAGNÓSTICO</h3>
					<div class="row">
						@foreach ($models_2 as $model)
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">#{{ $model->sn }} - {{ $model->car->modelo->brand->name }} {{ $model->car->modelo->name }} {{ $model->car->placa }} 
										<a href="{{ route( 'diagnostico.edit' , $model) }}" class="btn btn-outline-info btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ $model->company->company_name }}</h6>
									<p class="card-text">{{ $model->diag_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="repuestos" role="tabpanel" aria-labelledby="repuestos-tab">
					<h3>REPUESTOS</h3>
					<div class="row">
						@foreach ($models_3 as $model)
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">#{{ $model->sn }} - {{ $model->car->modelo->brand->name }} {{ $model->car->modelo->name }} {{ $model->car->placa }}
										<a href="{{ route( 'recepcion.edit' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ $model->company->company_name }}</h6>
									<p class="card-text">{{ $model->repu_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="aprobacion" role="tabpanel" aria-labelledby="aprobacion-tab">
					<h3>APROBACION</h3>
					<div class="row">
						@foreach ($models_4 as $model)
						@php
						$texto = "Hola, el diagnóstico de tu vehículo {$model->car->modelo->brand->name} {$model->car->modelo->name} placa: {$model->car->placa} ya está listo, puedes ver los detalles y aprobar la reparación en el siguiente link {route( 'order_client' , $model->slug)}";
						@endphp
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">#{{ $model->sn }} - {{ $model->car->modelo->brand->name }} {{ $model->car->modelo->name }} {{ $model->car->placa }}
										<a href="https://wa.me/+51{{ $model->company->mobile }}?text={{ $texto }}" target="_blank" class="btn btn-outline-info btn-sm btn-circle">{!! $icons['whatsapp'] !!}</a>
										<a href="{{ route( 'recepcion.edit' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ $model->company->company_name }}</h6>
									<p class="card-text">{{ $model->approved_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="reparacion" role="tabpanel" aria-labelledby="reparacion-tab">
					<h3>REPARACION</h3>
					<div class="row">
						@foreach ($models_5 as $model)
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">#{{ $model->sn }} - {{ $model->car->modelo->brand->name }} {{ $model->car->modelo->name }} {{ $model->car->placa }}
										<a href="{{ route( 'recepcion.edit' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ $model->company->company_name }}</h6>
									<p class="card-text">{{ $model->repar_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="control" role="tabpanel" aria-labelledby="control-tab">
					<h3>CONTROL</h3>
					<div class="row">
						@foreach ($models_6 as $model)
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">#{{ $model->sn }} - {{ $model->car->modelo->brand->name }} {{ $model->car->modelo->name }} {{ $model->car->placa }}
										<a href="{{ route( 'recepcion.edit' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ $model->company->company_name }}</h6>
									<p class="card-text">{{ $model->checked_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="entrega" role="tabpanel" aria-labelledby="entrega-tab">
					<h3>ENTREGA</h3>
					<div class="row">
						@foreach ($models_7 as $model)
						@php
						$texto = "Hola, desde ".env('APP_NAME').". queremos agradecerte por usar nuestros servicios, por favor calificanos aquí ".route( 'order_client' , $model->slug) . ", queremos mejorar para ti";
						@endphp
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">#{{ $model->sn }} - {{ $model->car->modelo->brand->name }} {{ $model->car->modelo->name }} {{ $model->car->placa }}
										<a href="https://wa.me/+51{{ $model->company->mobile }}?text={{ $texto }}" target="_blank" class="btn btn-outline-info btn-sm btn-circle">{!! $icons['whatsapp'] !!}</a>
										<a href="{{ route( 'recepcion.edit' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ $model->company->company_name }}</h6>
									<p class="card-text">{{ $model->send_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

	</div>
</div>



@endsection

@section('scripts')
