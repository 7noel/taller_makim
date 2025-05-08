<div class="form-row">
	<div class="col-md-2">
		{!! Field::date('f1', ['label'=>'Desde','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2">
		{!! Field::date('f2', ['label'=>'Hasta','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('mycompany_id', $locals, ['empty' => 'Todos', 'label'=>'Taller','class'=>'form-control-sm']) !!}
	</div>
	<!-- <div class="col-sm-2">
		{!! Field::select('seller_id', $sellers, ['empty' => 'Todos', 'label'=>'Asesor','class'=>'form-control-sm']) !!}
	</div> -->
	<div class="col-sm-2">
		{!! Field::select('status_id', config('options.inventory_status'), ['empty' => 'Todos', 'label'=>'Status','class'=>'form-control-sm']) !!}
	</div>
</div>

<div class="form-row">
	<div class="col-sm-2">
		{!! Field::text('placa', ['label'=>'Placa','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('sn', ['label'=>'Número','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2 align-self-end">
		<div class="form-group">
			<a href="#" target="_blank" id="btnExcel" class="btn btn-sm btn-outline-info">{!! $icons['excel'] !!} Descargar Excel</a>
		</div>
	</div>
</div>

<script>
$('#btnExcel').on('click', function () {
	let params = {
		f1: $('input[name="f1"]').val(),
		f2: $('input[name="f2"]').val(),
		mycompany_id: $('select[name="mycompany_id"]').val(),
		status_id: $('select[name="status_id"]').val(),
		placa: $('input[name="placa"]').val(),
		sn: $('input[name="sn"]').val(),
		excel: 1
	};

	let query = $.param(params);
	let url = "{{ route('inventory.index') }}?" + query;

	window.open(url, '_blank'); // Abre en nueva pestaña/ventana
});
</script>