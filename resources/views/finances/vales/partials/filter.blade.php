<div class="form-row">
	<div class="col-md-2">
		{!! Field::date('f1', ['label'=>'Desde','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2">
		{!! Field::date('f2', ['label'=>'Hasta','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('technician_id', $masters, ['empty' => 'Seleccionar', 'label'=>'Maestro','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2 d-none">
		{!! Field::select('seller_id', $sellers, ['empty' => 'Seleccionar', 'label'=>'Asesor','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2 d-none">
		{!! Field::select('status_id', config('options.proof_status'), ['empty' => 'Seleccionar', 'label'=>'Status','class'=>'form-control-sm']) !!}
	</div>
</div>

<div class="form-row">
	<div class="col-sm-2">
		{!! Field::text('placa', ['label'=>'Placa','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('sn', ['label'=>'Serie-Número','class'=>'form-control-sm']) !!}
	</div>
</div>

<!-- Modal resultado envío -->
<div class="modal fade" id="resultadoModal" tabindex="-1" role="dialog" aria-labelledby="resultadoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="resultadoModalLabel">Resultado del envío</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" id="resultadoMensaje">
        <!-- mensaje dinámico -->
      </div>
      <div class="modal-footer justify-content-center">
        <a href="{{ route('planillas.index') }}" class="btn btn-outline-success">
            <i class="fas fa-clipboard-list mr-1"></i> Planilla
        </a>
        <button type="button" class="btn btn-outline-secondary" id="btn-recargar">
            <i class="fas fa-sync-alt mr-1"></i> Recargar página
        </button>
      </div>
    </div>
  </div>
</div>


<style>
/* Oculta la primera columna cuando la tabla tiene la clase .hide-select */
#tabla-vouchers.hide-select th.col-select,
#tabla-vouchers.hide-select td.col-select {
    display: none;
}
</style>

<script>
$(function () {
    var $tabla         = $('#tabla-vouchers');
    var $selectTech    = $('#technician_id'); // id autogenerado por Field::select
    var $checkAll      = $('#vouchersAll');
    var $btnEnviar     = $('#btn-enviar-seleccion');

    // 1) Cambiar de técnico
    $selectTech.on('change', function () {
        var techId = $(this).val() || '';

        // Limpia selección
        $checkAll.prop('checked', false);
        $('.voucher-individual').prop('checked', false);

        if (techId === '') {
            // Sin técnico => mostrar todas las filas y ocultar la columna de checkboxes
            $tabla.addClass('hide-select');
            $tabla.find('tbody tr').show();
            return;
        }

        // Mostrar columna de selección
        $tabla.removeClass('hide-select');

        // Filtrar filas: mostrar solo las del company_id == techId, ocultar el resto
        $tabla.find('tbody tr').each(function () {
            var rowCompany = String($(this).data('company-id') || '');
            if (rowCompany === String(techId)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // (Seguridad extra) deshabilitar cualquier checkbox que no esté en PEND o no visible
        $tabla.find('.voucher-individual').each(function () {
            var $row   = $(this).closest('tr');
            var status = String($row.data('status') || '');
            var visible = $row.is(':visible');

            // Si no es PEND o no visible, la dejo sin seleccionar
            if (status !== 'PEND' || !visible) {
                $(this).prop('checked', false);
            }
        });
        toggleBotonEnviar();
    });

    // 2) Encabezado: seleccionar/deseleccionar todos
    $checkAll.on('change', function () {
        var marcado = $(this).is(':checked');
        // Solo marcar checkboxes visibles y habilitados (PEND)
        $tabla.find('.voucher-individual:visible').each(function () {
            var $row   = $(this).closest('tr');
            var status = String($row.data('status') || '');
            if (status === 'PEND') {
                $(this).prop('checked', marcado);
            }
        });
        toggleBotonEnviar();
    });

    // 3) Al marcar individualmente, sincronizar el encabezado
    $(document).on('change', '.voucher-individual', function () {
        // Considerar solo las filas visibles y PEND
        var $visiblesPend = $tabla.find('tbody tr:visible').filter(function () {
            return String($(this).data('status') || '') === 'PEND';
        });

        var totalEligibles = $visiblesPend.find('.voucher-individual').length;
        var totalMarcados  = $visiblesPend.find('.voucher-individual:checked').length;

        $checkAll.prop('checked', totalEligibles > 0 && totalMarcados === totalEligibles);
        toggleBotonEnviar();
    });

    // 4) Enviar seleccionados (sin formulario)
    $btnEnviar.on('click', function (e) {
        e.preventDefault();

        // Recolectar IDs seleccionados (solo visibles + PEND)
        var ids = [];
        var descuento = $('#descuento').val() || 0;
        var sctr = $('#sctr').val() || 0;

        $tabla.find('tbody tr:visible').each(function () {
            var $row   = $(this);
            var status = String($row.data('status') || '');
            if (status === 'PEND') {
                var $chk = $row.find('.voucher-individual');
                if ($chk.length && $chk.is(':checked')) {
                    ids.push($row.data('id'));
                }
            }
        });

        if (ids.length === 0) {
            alert('No has seleccionado registros en estado PEND.');
            return;
        }
        // tipo get
        // var url = "{{ route('planillas.generarFromVales') }}" + "?ids=" + ids.join(",");
        var url = "{{ route('planillas.generarFromVales') }}"
            + "?ids=" + ids.join(",")
            + "&descuento=" + encodeURIComponent(descuento)
            + "&sctr=" + encodeURIComponent(sctr);


	    // Opción A: redirigir al backend (recarga la página)
	    // window.location.href = url;

	    // --- Opción B: si prefieres usar fetch GET sin recargar ---
	    
	    fetch(url, { method: 'GET' })
	        .then(res => res.json())
	        .then(json => {
                // mostrar mensaje de éxito en el modal
                $('#resultadoMensaje').html(`<p class="text-body">Enviado: ${ids.length} registros.<br>${json.message || ''}</p>`);
                $('#resultadoModal').modal('show');
	            // alert('Enviado: ' + ids.length + ' registros.');
	            $checkAll.prop('checked', false);
	            $('.voucher-individual').prop('checked', false);
	            toggleBotonEnviar();
	            // location.reload()
	        })
	        .catch(err => {
	            console.error(err);
                $('#resultadoMensaje').html('<p class="text-danger">Ocurrió un error al enviar los registros.</p>');
                $('#resultadoModal').modal('show');
	            // alert('Ocurrió un error al enviar los registros.');
	        });
	    
        // POST al backend (ajusta la URL a tu ruta)
        // var url = "{{ route('planillas.generarFromVales') }}"; // <-- AJUSTA ESTA RUTA
        // var token = $('meta[name="csrf-token"]').attr('content');

        // fetch(url, {
        //     method: 'GET',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': token,
        //         'X-Requested-With': 'XMLHttpRequest'
        //     },
        //     body: JSON.stringify({ ids: ids })
        // })
        // .then(res => {
        //     if (!res.ok) throw new Error('Error al enviar los datos.');
        //     return res.json();
        // })
        // .then(json => {
        //     // Aquí decides qué hacer con la respuesta
        //     // Por ejemplo, refrescar, mostrar toast, etc.
        //     alert('Enviado: ' + ids.length + ' registros.');
        //     // Limpia selección
        //     $checkAll.prop('checked', false);
        //     $('.voucher-individual').prop('checked', false);
		// 	toggleBotonEnviar(); // ⬅️ se oculta tras el envío
        // })
        // .catch(err => {
        //     console.error(err);
        //     alert('Ocurrió un error al enviar los registros seleccionados.');
        // });
    });
    // Recargar la página si se cierra el modal o se presiona el botón
    $('#resultadoModal').on('hidden.bs.modal', function () {
      location.reload();
    });
    $('#btn-recargar').on('click', function () {
      location.reload();
    });

    // (Inicial) Arrancar con la primera columna oculta
    $tabla.addClass('hide-select');

	function toggleBotonEnviar() {
	    // ¿Hay algún checkbox marcado y visible con estado PEND?
	    var haySeleccionados = $('#tabla-vouchers')
	        .find('tbody tr:visible')
	        .filter(function () {
	            return String($(this).data('status') || '') === 'PEND';
	        })
	        .find('.voucher-individual:checked')
	        .length > 0;

	    if (haySeleccionados) {
	        $('#btn-enviar-seleccion').parent('div').parent('div').removeClass('d-none');
	    } else {
	        $('#btn-enviar-seleccion').parent('div').parent('div').addClass('d-none');
	    }
	}

});
</script>
