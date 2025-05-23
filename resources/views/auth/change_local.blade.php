@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="{{ config('options.styles.card_header') }}">Cambiar Local
				</h5>
				<div class="card-body">
					{!! Form::open(['route'=> 'update_local' , 'method'=>'POST', 'class'=>'']) !!}
						<div class="col-sm-3">
							{!! Field::select('my_company', $locales, \Auth::user()->my_company, ['label' => 'Local', 'empty'=>'Seleccionar', 'class'=>'form-control-sm', 'required'=>'required']) !!}
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-outline-success" id="submit">{!! $icons['save'] !!} Cambiar Local</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
