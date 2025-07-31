@extends('layouts.app')

@section('content')
<div class="container">

@php

$models_1 = $models->where('status', 'PEND');
$models_2 = $models->where('status', 'DIAG');
$models_3 = $models->where('status', 'REPU');
$models_3_2 = $models->where('status', 'PREAP');
$models_4 = $models->where('status', 'APROB');
$models_5 = $models->where('status', 'REPAR');
$models_6 = $models->where('status', 'CONTR');
$models_7 = $models->where('status', 'ENTR');

@endphp
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="pend-tab" data-toggle="tab" data-target="#recepcion" type="button" role="tab" aria-controls="recepcion" aria-selected="true">{!! $icons['car'] !!} <br> <span class="badge badge-light">{{ $models_1->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="diag-tab" data-toggle="tab" data-target="#diagnostico" type="button" role="tab" aria-controls="diagnostico" aria-selected="false">{!! $icons['view'] !!} <br> <span class="badge badge-light">{{ $models_2->count() }}</span> </button>
				</li>
				<!-- <li class="nav-item" role="presentation">
					<button class="nav-link" id="repu-tab" data-toggle="tab" data-target="#repuestos" type="button" role="tab" aria-controls="repuestos" aria-selected="false"><i class="fas fa-box"></i> <br> <span class="badge badge-light">{{ $models_3->count() }}</span> </button>
				</li> -->
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="repu-tab" data-toggle="tab" data-target="#pre_aprobacion" type="button" role="tab" aria-controls="pre_aprobacion" aria-selected="false"><i class="fas fa-check"></i> <br> <span class="badge badge-light">{{ $models_3_2->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="aprob-tab" data-toggle="tab" data-target="#aprobacion" type="button" role="tab" aria-controls="aprobacion" aria-selected="false"><i class="fa-solid fa-check-double"></i> <br> <span class="badge badge-light">{{ $models_4->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="repar-tab" data-toggle="tab" data-target="#reparacion" type="button" role="tab" aria-controls="reparacion" aria-selected="false"><i class="fas fa-wrench"></i> <br> <span class="badge badge-light">{{ $models_5->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="contr-tab" data-toggle="tab" data-target="#control" type="button" role="tab" aria-controls="control" aria-selected="false"><i class="fa-regular fa-circle-check"></i> <br> <span class="badge badge-light">{{ $models_6->count() }}</span> </button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="entr-tab" data-toggle="tab" data-target="#entrega" type="button" role="tab" aria-controls="entrega" aria-selected="false"><i class="fas fa-door-open"></i> <br> <span class="badge badge-light">{{ $models_7->count() }}</span> </button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-center" id="exampleModalLabel">Enviar Mensaje</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<!-- <label for="mobile">Celular</label> -->
								<input type="number" id="mobile" class="form-control form-control-sm text-center" placeholder="Celular">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
								<a href="#" target="_blank" class="btn btn-outline-success" id="btn-whatsapp">{!! $icons['whatsapp'] !!} Whatsapp</a>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade show active" id="recepcion" role="tabpanel" aria-labelledby="pend-tab">
					<h3>INVENTARIO VEHICULAR <a href="{{ route('inventory.create') }}" type="button" class="btn btn-primary btn-sm btn-circle">{!! $icons['add'] !!}</a></h3>
					<div class="row">
						@foreach ($models_1 as $model)
						@php
						$texto = "Hola, Bienvenido a ".env('APP_NAME').". Gracias por preferirnos. Estamos a punto de ingresar tu vehículo {optional($model->car->modelo->brand)->name} {optional($model->car)->modelo)->name} placa: {optional($model->car)->placa}, es necesario aprobar el ingreso al taller en el siguiente link: ".route( 'order_client' , $model->slug);
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
									<h5>
										<input class="input_mobile" type="hidden" value="{{ optional($model->company)->mobile }}">
										<input class="input_texto" type="hidden" value="{{ $texto }}">
										<!-- Button trigger modal -->
										{{-- <button type="button" class="btn btn-outline-success btn-sm btn-circle btn-modal-mobile" data-toggle="modal" data-target="#exampleModal">
										  {!! $icons['whatsapp'] !!}
										</button> --}}
										{{-- <a href="https://wa.me/+51{{ optional($model->company)->mobile }}?text={{ $texto }}" target="_blank" class="btn btn-outline-info btn-sm btn-circle">{!! $icons['whatsapp'] !!}</a> --}}
										<a href="{{ route( 'inventory.edit' , $model) }}" type="button" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'order.print_inventory' , $model->id ) }}" target="_blank" class="btn btn-outline-danger btn-sm" title="Inventario">{!! $icons['pdf'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h5 class="card-title">#{{ $model->sn }} - {{ optional($model->car->modelo->brand)->name }} {{ optional($model->car->modelo)->name }} {{ optional($model->car)->placa }}</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ optional($model->company)->company_name }}</h6>
									<p class="card-text {{ $class }}">{{ $last_log->message }} {{ $last_log->created_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>


				</div>
				<div class="tab-pane fade" id="diagnostico" role="tabpanel" aria-labelledby="diag-tab">
					<h3>DIAGNÓSTICO (PRESUPUESTO)</h3>
					<div class="row">
						@foreach ($models_2->sortByDesc('diag_at') as $model)
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5>
										@if(isset($model->orders[0]))
										<a href="{{ route( 'output_quotes.edit', $model->orders[0]) }}" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										@else
										<a href="{{ route( 'output_quotes.by_inventory', $model) }}" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										@endif
										<a href="{{ route( 'change_status_order' , $model) }}" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h5 class="card-title">#{{ $model->sn }} - {{ optional($model->car->modelo->brand)->name }} {{ optional($model->car->modelo)->name }} {{ optional($model->car)->placa }} 
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ optional($model->company)->company_name }}</h6>
									<p class="card-text">{{ $model->diag_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<!-- <div class="tab-pane fade" id="repuestos" role="tabpanel" aria-labelledby="repu-tab">
					<h3>REPUESTOS</h3>
					<div class="row">
						@foreach ($models_3 as $model)
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5>
										<a href="{{ route( 'repuestos.edit' , $model) }}" type="button" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h5 class="card-title">#{{ $model->sn }} - {{ optional($model->car->modelo->brand)->name }} {{ optional($model->car->modelo)->name }} {{ optional($model->car)->placa }}
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ optional($model->company)->company_name }}</h6>
									<p class="card-text">{{ $model->repu_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div> -->
				<div class="tab-pane fade" id="pre_aprobacion" role="tabpanel" aria-labelledby="repu-tab">
					<h3>APROBACIÓN DEL SEGURO</h3>
					<div class="row">
						@foreach ($models_3_2->sortByDesc('pre_approved_at') as $model)
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5>
										@if(isset($model->orders[0]))
										<a href="{{ route( 'output_quotes.edit', $model->orders[0]) }}" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										@else
										<a href="{{ route( 'output_quotes.by_inventory', $model) }}" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										@endif
										<!-- <a href="{{ route( 'pre_aprobacion.edit' , $model) }}" type="button" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a> -->
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h5 class="card-title">#{{ $model->sn }} - {{ optional($model->car->modelo->brand)->name }} {{ optional($model->car->modelo)->name }} {{ optional($model->car)->placa }}
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ optional($model->company)->company_name }}</h6>
									<p class="card-text">{{ $model->pre_approved_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="aprobacion" role="tabpanel" aria-labelledby="aprob-tab">
					<h3>APROBACION DEL CLIENTE</h3>
					<div class="row">
						@foreach ($models_4->sortByDesc('approved_at') as $model)
						@php
						$texto = "Hola, el diagnóstico de tu vehículo {optional($model->car->modelo->brand)->name} {optional($model->car->modelo)->name} placa: {optional($model->car)->placa} ya está listo, puedes ver los detalles y aprobar la reparación en el siguiente link {route( 'order_client' , $model->slug)}";
						@endphp
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5>
										<a href="https://wa.me/+51{{ optional($model->company)->mobile }}?text={{ $texto }}" target="_blank" class="btn btn-outline-success btn-sm btn-circle">{!! $icons['whatsapp'] !!}</a>
										<!-- <a href="{{ route( 'aprobacion.edit' , $model) }}" type="button" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a> -->
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h5 class="card-title">#{{ $model->sn }} - {{ optional($model->car->modelo->brand)->name }} {{ optional($model->car->modelo)->name }} {{ optional($model->car)->placa }}
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ optional($model->company)->company_name }}</h6>
									<p class="card-text">{{ $model->approved_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="reparacion" role="tabpanel" aria-labelledby="repar-tab">
					<h3>REPARACION</h3>
					<div class="row">
						@foreach ($models_5->sortByDesc('repar_at') as $model)
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5>
										<a href="{{ route( 'repair.edit' , $model) }}" type="button" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h5 class="card-title">#{{ $model->sn }} - {{ optional($model->car->modelo->brand)->name }} {{ optional($model->car->modelo)->name }} {{ optional($model->car)->placa }}
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ optional($model->company)->company_name }}</h6>
									<p class="card-text">{{ $model->repar_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="control" role="tabpanel" aria-labelledby="contr-tab">
					<h3>CONTROL DE CALIDAD</h3>
					<div class="row">
						@foreach ($models_6->sortByDesc('checked_at') as $model)
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5>
										<a href="{{ route( 'qc.edit' , $model) }}" type="button" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h5 class="card-title">#{{ $model->sn }} - {{ optional($model->car->modelo->brand)->name }} {{ optional($model->car->modelo)->name }} {{ optional($model->car)->placa }}
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ optional($model->company)->company_name }}</h6>
									<p class="card-text">{{ $model->checked_at->diffForHumans() }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="entrega" role="tabpanel" aria-labelledby="entr-tab">
					<h3>ENTREGA</h3>
					<div class="row">
						@foreach ($models_7->sortByDesc('sent_at') as $model)
						@php
						$texto = "Hola, desde ".env('APP_NAME').". queremos agradecerte por usar nuestros servicios, por favor calificanos aquí ".route( 'order_client' , $model->slug) . ", queremos mejorar para ti";
						@endphp
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="card-body">
									<h5>
										<a href="https://wa.me/+51{{ optional($model->company)->mobile }}?text={{ $texto }}" target="_blank" class="btn btn-outline-success btn-sm btn-circle">{!! $icons['whatsapp'] !!}</a>
										<a href="{{ route( 'entrega.edit' , $model) }}" type="button" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
										<a href="{{ route( 'change_status_order' , $model) }}" type="button" class="btn btn-outline-info btn-sm btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
									</h5>
									<h5 class="card-title">#{{ $model->sn }} - {{ optional($model->car->modelo->brand)->name }} {{ optional($model->car->modelo)->name }} {{ optional($model->car)->placa }}
									</h5>
									<h6 class="card-subtitle mb-2 text-muted">{{ optional($model->company)->company_name }}</h6>
									<p class="card-text">{{ $model->sent_at->diffForHumans() }}</p>
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

<script>
$(document).ready(function () {
    $(".btn-modal-mobile").click(function (e) {
		$('#mobile').val($(this).parent().find('.input_mobile').val())
    	mobile = $('#mobile').val()
		window.texto = $(this).parent().find('.input_texto').val()
    	$("#btn-whatsapp").attr('href', `https://wa.me/+51${mobile}?text=${window.texto}`)
    })
    $("#mobile").change(function (e) {
		mobile = $('#mobile').val()
    	$("#btn-whatsapp").attr('href', `https://wa.me/+51${mobile}?text=${window.texto}`)
    })
    @if(session('panel-status'))
    	status = '{{ session('panel-status') }}'
    	id_tab = '#' + status.toLowerCase() + '-tab'
    	console.log(id_tab)
        $(id_tab).click()
	@endif
})
</script>

@endsection

@section('scripts')
