@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-group">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('panel') }}" class="card-title text-dark">TABLERO
                        <img src="/img/procesos.png" class="card-img-top"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('clients.index') }}" class="card-title text-dark">CLIENTES
                        <img src="/img/clientes.png" class="card-img-top"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('cars.index') }}" class="card-title text-dark">VEHÍCULOS
                        <img src="/img/accord.png" class="card-img-top"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('output_quotes.index') }}" class="card-title text-dark">PRESUPUESTOS
                        <img src="/img/cotizar.png" class="card-img-top"></a>
                    </div>
                </div>
            </div>

            <div class="card-group">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('inventory.index') }}" class="card-title text-dark">INVENTARIOS
                        <img src="/img/ordenes.png" class="card-img-top"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <a href="#" class="card-title text-dark">REPORTES
                        <img src="/img/informe.png" class="card-img-top"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <a href="#" class="card-title text-dark">VENTAS
                        <img src="/img/ventas.png" class="card-img-top"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <a href="#" class="card-title text-dark">COMPRAS
                        <img src="/img/compras_1.png" class="card-img-top"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
