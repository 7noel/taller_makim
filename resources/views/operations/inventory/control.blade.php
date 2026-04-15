@extends('layouts.app')

@section('content')

@php
    $cc = $model->control_calidad ?? [];

    $resolucion = [
        'falla_resuelta'       => 'Falla resuelta',
        'motor_armado'         => 'Motor armado',
        'motor_limpio'         => 'Motor limpio, libre de fuga de fluidos',
        'tren_motriz_armado'   => 'Tren motriz armado',
        'tren_motriz_limpio'   => 'Tren motriz limpio, libre de fuga de fluidos',
        'llantas_aseguradas'   => 'Llantas aseguradas y verificadas',
        'llantas_calibradas'   => 'Llantas calibradas',
        'partes_moviles'       => 'Armado de partes móviles desarmadas'
    ];

    $estado = [
        'carroceria_limpia'      => 'Carrocería limpia, sin manchas de grasa',
        'cabina_limpia'          => 'Cabina limpia, sin basura',
        'cabina_sin_equipos'     => 'Cabina libre de equipo técnico',
        'motor_sin_herramientas' => 'Compartimiento libre de herramientas'
    ];

    $fluidos = [
        'aceite_motor'      => 'Aceite de Motor',
        'liquido_frenos'    => 'Líquido de Frenos',
        'liquido_embrague'  => 'Líquido de Embrague',
        'refrigerante'      => 'Refrigerante',
        'aceite_hidraulico' => 'Aceite Hidráulico'
    ];

    $causas = [
        'falla_tecnica'       => 'Falla técnica en reparación',
        'estado_inapropiado'  => 'Estado inapropiado del vehículo',
        'fluidos_incompletos' => 'Fluidos incompletos',
        'armado_incompleto'   => 'Proceso de armado incompleto'
    ];
@endphp


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <h5 class="{{ config('options.styles.card_header') }}">
                    CONTROL DE CALIDAD #{{ $model->sn }} // {{ $model->placa }}
                </h5>

                <div class="card-body">

                    {!! Form::model($model, [
                        'route'  => ['qc.update', $model],
                        'method' => 'PUT',
                        'class'  => 'form-loading',
                        'id'     => 'form-control-calidad'
                    ]) !!}

                    @if(Request::url() != URL::previous())
                        <input type="hidden" name="last_page" value="{{ URL::previous() }}">
                    @endif


                    {{-- DATOS GENERALES --}}
                    <div class="form-row">
                        <div class="col-sm-2">
                            {!! Field::select(
                                'control_calidad[nivel_combustible]',
                                config('options.combustible'),
                                $cc->nivel_combustible ?? null,
                                ['label'=>'Nivel combustible', 'class'=>'form-control-sm', 'empty'=>'Seleccionar', 'required'=>'required']
                            ) !!}
                        </div>
                        <div class="col-sm-2">
                            {!! Field::text(
                                'control_calidad[kilometraje]',
                                $cc->kilometraje ?? null,
                                ['label'=>'Kilometraje', 'class'=>'form-control-sm', 'required'=>'required']
                            ) !!}
                        </div>
                    </div>


                    {{-- RESOLUCION --}}
                    <hr>
                    <h5>Resolución de la avería</h5>

                    <div class="form-row">
                        @foreach($resolucion as $key => $text)
                            <div class="col-sm-6 col-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="res_{{ $key }}"
                                           name="control_calidad[resolucion_averia][]"
                                           value="{{ $key }}"
                                           @if(in_array($key,$cc->resolucion_averia ?? [])) checked @endif>

                                    <label class="custom-control-label" for="res_{{ $key }}">
                                        {{ $text }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    {{-- ESTADO --}}
                    <hr>
                    <h5>Estado del vehículo</h5>

                    <div class="form-row">
                        @foreach($estado as $key => $text)
                            <div class="col-sm-6 col-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="est_{{ $key }}"
                                           name="control_calidad[estado_vehiculo][]"
                                           value="{{ $key }}"
                                           @if(in_array($key,$cc->estado_vehiculo ?? [])) checked @endif>

                                    <label class="custom-control-label" for="est_{{ $key }}">
                                        {{ $text }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    {{-- FLUIDOS --}}
                    <hr>
                    <h5>Fluidos</h5>

                    <div class="form-row">
                        @foreach($fluidos as $key => $text)
                            <div class="col-sm-6 col-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="flu_{{ $key }}"
                                           name="control_calidad[fluidos][]"
                                           value="{{ $key }}"
                                           @if(in_array($key,$cc->fluidos ?? [])) checked @endif>

                                    <label class="custom-control-label" for="flu_{{ $key }}">
                                        {{ $text }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    {{-- OBSERVACIONES --}}
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-6">
                            {!! Field::textarea(
                                'control_calidad[observaciones]',
                                $cc->observaciones ?? null,
                                ['label'=>'Observaciones','class'=>'form-control-sm','rows'=>3]
                            ) !!}
                        </div>
                    </div>


                    {{-- APROBACION --}}
                    <hr>
                    <h5>¿Aprueba control de calidad?</h5>

                    <div class="form-row">
                        <div class="col-sm-4">

                            <div class="custom-control custom-radio">
                                <input type="radio"
                                       id="aprueba_si"
                                       name="control_calidad[aprueba]"
                                       value="si"
                                       class="custom-control-input aprueba-control"
                                       required
                                       @if(($cc->aprueba ?? '')=='si') checked @endif>

                                <label class="custom-control-label" for="aprueba_si">Sí</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio"
                                       id="aprueba_no"
                                       name="control_calidad[aprueba]"
                                       value="no"
                                       class="custom-control-input aprueba-control"
                                       required
                                       @if(($cc->aprueba ?? '')=='no') checked @endif>

                                <label class="custom-control-label" for="aprueba_no">No</label>
                            </div>

                        </div>
                    </div>


                    {{-- CAUSAS --}}
                    <div id="causa_no_aprueba" style="display:none;">
                        <hr>
                        <h5>Si no aprueba la causa es:</h5>

                        <div class="form-row">
                            @foreach($causas as $key => $text)
                                <div class="col-sm-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio"
                                               id="causa_{{ $key }}"
                                               name="control_calidad[causa_no_aprueba]"
                                               value="{{ $key }}"
                                               class="custom-control-input causa-radio"
                                               @if(($cc->causa_no_aprueba ?? '')==$key) checked @endif>

                                        <label class="custom-control-label" for="causa_{{ $key }}">
                                            {{ $text }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <hr>

                    <div class="form-row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-outline-success">
                                {!! $icons['save'] !!} Guardar
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
</div>


<script>

$(document).on('change','.aprueba-control',function(){

    if($(this).val()=='no'){
        $('#causa_no_aprueba').show();
        $('.causa-radio').prop('required',true);
    }
    else{
        $('#causa_no_aprueba').hide();
        $('.causa-radio').prop('checked',false).prop('required',false);
    }

});

$(document).ready(function(){

    if($('input[name="control_calidad[aprueba]"]:checked').val()=='no'){
        $('#causa_no_aprueba').show();
        $('.causa-radio').prop('required',true);
    }

});

</script>

@endsection