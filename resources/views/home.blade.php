@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-group">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('clients.index') }}" class="card-title text-dark">Clientes
                        <img src="/img/clientes.png" class="card-img-top"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('cars.index') }}" class="card-title text-dark">Vehículos
                        <img src="/img/accord.png" class="card-img-top"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('output_quotes.index') }}" class="card-title text-dark">Cotizaciones
                        <img src="/img/cotizar.png" class="card-img-top"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('output_orders.index') }}" class="card-title text-dark">Ordenes
                        <img src="/img/ordenes.png" class="card-img-top"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
