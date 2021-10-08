{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}

<div class="form-row">
	<div class="col-sm-2">
		{!! Field::date('fecha', null, ['label'=>'Fecha', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('venta', null, ['label'=>'Venta', 'class'=>'form-control-sm', 'step'=>0.001, 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('compra', null, ['label'=>'Compra','class'=>'form-control-sm', 'step'=>0.001, 'required']) !!}
	</div>
</div>