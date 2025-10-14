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
			<div class="row mb-2">
				<div class="col-md-7">
					<div class="input-group input-group-sm">
						<input type="text" id="txt-busqueda" class="form-control" placeholder="Escribe o pega una placa o cliente… (Ej: EGX098 o PODER JUDICIAL)" autocomplete="off">
					</div>
					<small id="busqueda-estado" class="form-text text-muted d-none"></small>
				</div>

				<div class="col-md-5 text-left">
					<div id="nav-resultados" class="btn-group btn-group-sm d-none" role="group">
						<button type="button" class="btn btn-outline-secondary" id="btn-prev">Anterior</button>
						<button type="button" class="btn btn-outline-secondary" id="btn-next">Siguiente</button>
					</div>
				</div>
			</div>



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
					<button class="nav-link" id="preap-tab" data-toggle="tab" data-target="#pre_aprobacion" type="button" role="tab" aria-controls="pre_aprobacion" aria-selected="false"><i class="fas fa-check"></i> <br> <span class="badge badge-light">{{ $models_3_2->count() }}</span> </button>
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
					<p>Listado de vehículos cuyos inventarios aún no han sido aprobados por el cliente</p>
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
						<div class="col-sm-6 col-md-4 item-buscable" data-placa="{{ optional($model->car)->placa }}" data-company="{{ optional($model->company)->company_name }}">
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
					<p>Listado de vehículos cuyos presupuestos aún están incompletos</p>
					<div class="row">
						@foreach ($models_2->sortByDesc('diag_at') as $model)
						<div class="col-sm-6 col-md-4 item-buscable" data-placa="{{ optional($model->car)->placa }}" data-company="{{ optional($model->company)->company_name }}">
							<div class="card">
								<div class="card-body">
									<h5>
										@if(isset($model->quotes[0]))
										<a href="{{ route( 'output_quotes.edit', $model->quotes[0]) }}" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
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
					<p>Listado de vehículos cuyos presupuestos aún no han sido aprobados por la compañía de seguros</p>
					<div class="row">
						@foreach ($models_3_2->sortByDesc('pre_approved_at') as $model)
						<div class="col-sm-6 col-md-4 item-buscable" data-placa="{{ optional($model->car)->placa }}" data-company="{{ optional($model->company)->company_name }}">
							<div class="card">
								<div class="card-body">
									<h5>
										@if(isset($model->quotes[0]))
										<a href="{{ route( 'output_quotes.edit', $model->quotes[0]) }}" class="btn btn-outline-primary btn-sm btn-circle">{!! $icons['edit'] !!}</a>
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
					<p>Listado de vehículos cuyos presupuestos aún no han sido aprobados por el cliente</p>
					<div class="row">
						@foreach ($models_4->sortByDesc('approved_at') as $model)
						@php
						$texto = "Hola, el diagnóstico de tu vehículo {optional($model->car->modelo->brand)->name} {optional($model->car->modelo)->name} placa: {optional($model->car)->placa} ya está listo, puedes ver los detalles y aprobar la reparación en el siguiente link {route( 'order_client' , $model->slug)}";
						@endphp
						<div class="col-sm-6 col-md-4 item-buscable" data-placa="{{ optional($model->car)->placa }}" data-company="{{ optional($model->company)->company_name }}">
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
					<p>Listado de vehículos que están en proceso de reparación</p>
					<div class="row">
						@foreach ($models_5->sortByDesc('repar_at') as $model)
						<div class="col-sm-6 col-md-4 item-buscable" data-placa="{{ optional($model->car)->placa }}" data-company="{{ optional($model->company)->company_name }}">
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
					<p>Listado de vehículos ya reparados y están pendientes del control de calidad</p>
					<div class="row">
						@foreach ($models_6->sortByDesc('checked_at') as $model)
						<div class="col-sm-6 col-md-4 item-buscable" data-placa="{{ optional($model->car)->placa }}" data-company="{{ optional($model->company)->company_name }}">
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
					<p>Listado de vehículos listos para entregar al cliente</p>
					<div class="row">
						@foreach ($models_7->sortByDesc('sent_at') as $model)
						@php
						$texto = "Hola, desde ".env('APP_NAME').". queremos agradecerte por usar nuestros servicios, por favor calificanos aquí ".route( 'order_client' , $model->slug) . ", queremos mejorar para ti";
						@endphp
						<div class="col-sm-6 col-md-4 item-buscable" data-placa="{{ optional($model->car)->placa }}" data-company="{{ optional($model->company)->company_name }}">
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

(function($){
  // === Utils (déjalas como las tienes si ya existen) ===
  function norm(str){
    return (str || '')
      .toString()
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .toUpperCase()
      .trim();
  }

  function highlight($el){
    $el.addClass('busca-highlight');
    setTimeout(function(){ $el.removeClass('busca-highlight'); }, 1800);
  }

  // >>> NUEVO: tus tabs son <button data-target="#pane"> <<<
  function showTabByPaneId(paneId){
    var $btn = $('.nav-tabs .nav-link[data-target="#' + paneId + '"]');
    if($btn.length){
      $btn.trigger('click'); // Bootstrap 4
      return true;
    }
    return false;
  }

  function revealItem($item){
    var $pane = $item.closest('.tab-pane');
    if(!$pane.length) return;

    var paneId = $pane.attr('id');
    if(showTabByPaneId(paneId)){
      setTimeout(function(){
        $('html,body').animate({ scrollTop: $item.offset().top - 100 }, 300);
        highlight($item);
      }, 120);
    }
  }

  // Estado de coincidencias (navegación entre matches)
  var matches = [];
  var idx = -1;

  function actualizarNavegacion(){
    if(matches.length > 1){
      $('#nav-resultados').removeClass('d-none');
    } else {
      $('#nav-resultados').addClass('d-none');
    }

    var estado = matches.length
      ? 'Coincidencias: ' + (idx + 1) + ' / ' + matches.length
      : ($('#txt-busqueda').val().trim() ? 'Sin resultados' : '');
    if(estado){
      $('#busqueda-estado').text(estado).removeClass('d-none');
    } else {
      $('#busqueda-estado').addClass('d-none').text('');
    }
  }

  function irA(i){
    if(matches.length === 0) return;
    idx = (i + matches.length) % matches.length;
    revealItem(matches[idx]);
    actualizarNavegacion();
  }

  $('#btn-prev').on('click', function(){ irA(idx - 1); });
  $('#btn-next').on('click', function(){ irA(idx + 1); });

  // >>> NUEVO: guardar contadores originales de badges una sola vez <<<
  function cacheOriginalBadges(){
    $('.nav-tabs .nav-link').each(function(){
      var $b = $(this).find('.badge');
      if($b.length && !$b.attr('data-original')){
        var n = parseInt($b.text(), 10) || 0;
        $b.attr('data-original', n);
      }
    });
  }

  // >>> NUEVO: restaurar vista sin filtro <<<
  function restaurarSinFiltro(){
    $('.item-buscable').removeClass('d-none');
    $('.empty-msg').addClass('d-none');
    // restaurar badges
    $('.nav-tabs .nav-link .badge').each(function(){
      var n = parseInt($(this).attr('data-original'), 10);
      if(!isNaN(n)) $(this).text(n);
    });
    // reset UI de búsqueda
    matches = [];
    idx = -1;
    $('#nav-resultados').addClass('d-none');
    $('#busqueda-estado').addClass('d-none').text('');
  }

  // >>> NUEVO: aplicar filtro (oculta no-coincidentes + actualiza badges) <<<
  function aplicarFiltro(q){
    matches = [];
    idx = -1;

    if(!q){
      restaurarSinFiltro();
      return;
    }

    $('.tab-pane').each(function(){
      var $pane = $(this);
      var paneId = $pane.attr('id');
      var visibles = 0;

      $pane.find('.item-buscable').each(function(){
        var $it = $(this);
        var placa   = norm($it.data('placa'));
        var company = norm($it.data('company'));
        var ok = (placa.indexOf(q) !== -1) || (company.indexOf(q) !== -1);

        $it.toggleClass('d-none', !ok);
        if(ok){
          matches.push($it);
          visibles++;
        }
      });

      // mensaje "vacío" dentro de la primera .row de la pestaña
      var $row = $pane.find('.row').first();
      var $empty = $row.find('.empty-msg');
      if(!$empty.length){
        $empty = $('<div class="col-12 empty-msg text-muted small py-3 d-none">Sin resultados para esta pestaña</div>');
        $row.prepend($empty);
      }
      $empty.toggleClass('d-none', visibles !== 0);

      // actualizar badge de esa pestaña
      var $badge = $('.nav-tabs .nav-link[data-target="#'+paneId+'"]').find('.badge');
      if($badge.length){
        $badge.text(visibles);
      }
    });

    if(matches.length){
      irA(0); // muestra el primer match y actualiza estado
    } else {
      actualizarNavegacion(); // mostrará "Sin resultados"
    }
  }

  // === Búsqueda reactiva (sin form) ===
  var debounceTimer = null;
  $('#txt-busqueda').on('input paste', function(){
    var q = norm($(this).val());
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function(){
      aplicarFiltro(q);
    }, 120);
  });

  // Atajos con teclado: Enter = siguiente, Shift+Enter = anterior
  $('#txt-busqueda').on('keydown', function(e){
    if(e.key === 'Enter'){
      e.preventDefault();
      if(e.shiftKey) irA(idx - 1); else irA(idx + 1);
    }
  });

  // Init
  $(function(){ cacheOriginalBadges(); });

  // Estilos highlight (déjalo como ya lo tienes si existe)
  var css = `
    .busca-highlight {
      animation: buscaFlash 1.2s ease-in-out 1;
      outline: 2px solid rgba(255,193,7,.9);
      box-shadow: 0 0 0 4px rgba(255,193,7,.35);
      transition: outline .2s ease, box-shadow .2s ease;
    }
    @keyframes buscaFlash {
      0%   { background-color: rgba(255,193,7,.25); }
      100% { background-color: transparent; }
    }
  `;
  if(!$('style:contains("buscaFlash")').length){ $('<style>').text(css).appendTo(document.head); }

})(jQuery);




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
