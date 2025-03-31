<style>
/*    #selectedImage.zoomed {
        transform: scale(2);
        cursor: zoom-out;
    }

    #selectedImage {
        transition: transform 0.3s ease;
        max-width: 100%;
        height: auto;
        cursor: zoom-in;
    }
*/

    .padding-1 {padding-bottom: 1px; padding-top: 1px;}
    .padding-0 { padding-left:0; padding-right:0; }
    .radio-green input[type="radio"] + label { color: green; }
    .radio-amber input[type="radio"] + label { color: orange; }
    .radio-red input[type="radio"] + label { color: red; }
    .radio-black input[type="radio"] + label { color: black; }
    .radio-blue input[type="radio"] + label { color: blue; }

    /* Alinear en una sola línea para PC */
    @media (min-width: 768px) {
      .checklist-item {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
        align-items: start;
        gap: 10px;
        padding: 5px 0;
        transition: background-color 0.2s;
      }
      .checklist-item:hover {
        background-color: rgba(0, 0, 0, 0.075); /* Similar al efecto de .table-hover */
      }
      .checklist-item .item-name {
        word-wrap: break-word;
        max-width: 100%;
      }
      .checklist-item .options {
        display: flex;
        justify-content: space-evenly;
      }
    }

    /* Separación entre ítems en móviles */
    @media (max-width: 767px) {
      .checklist-item {
        margin-bottom: 20px;
      }
    }

    .comment {
      max-width: 100%;
    }
    nvas-container {
        position: relative;
        width: 100%;
        max-width: 800px;
        margin: auto;
    }
    canvas {
        border: 1px solid #ccc;
        width: 100%;
        height: auto;
    }
</style>

{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('is_downloadable', 1, ['id'=>'is_downloadable']) !!}
{!! Form::hidden('with_tax', 1, ['id'=>'with_tax']) !!}
{!! Form::hidden('company_id', (isset($car)) ? $car->company_id : null, ['id'=>'company_id']) !!}
{!! Form::hidden('car_id', (isset($car)) ? $car->id : null, ['id'=>'car_id']) !!}
{!! Form::hidden('action', $action, ['id'=>'action']) !!}

<div class="accordion mb-4" id="accordionExample">
  <div class="card">
    <div class="card-header padding-1" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Vehículo
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <div class="mb-2">
            <a href="{{ route('cars.create') }}" class="btn btn-sm btn-link">[[ Crear Vehiculo ]]</a>
            <a href="{{ route('clients.create') }}" class="btn btn-sm btn-link">[[ Crear Cliente ]]</a>
            
        </div>

        <div class="form-row">
            <div class="col-sm-2">
                <div class="form-group">
                    {!! Form::label('sn', 'Inventario') !!}
                    @if(isset($model) and $model->order_type == 'inventory')
                    {!! Form::text('sn', null, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
                    @else
                    {!! Form::text('sn', '',['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
                    @endif
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    @if(isset(\Auth::user()->employee->job_id) and (\Auth::user()->employee->job_id == 8 or \Auth::user()->id==3))
                    {!! Field::select('seller_id', [\Auth::user()->employee->id => \Auth::user()->employee->full_name], ['empty'=>'Seleccionar', 'label'=>'Asesor', 'class'=>'form-control-sm', 'required']) !!}
                    @else
                    {!! Field::select('seller_id', $sellers, ['empty'=>'Seleccionar', 'label'=>'Asesor', 'class'=>'form-control-sm', 'required']) !!}
                @endif
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    {!! Field::select('type_service', config('options.types_service'), ['empty'=>'Seleccionar', 'label'=>'Servicio', 'class'=>'form-control-sm', 'required']) !!}
                </div>
            </div>
            <div class="col-sm-2 d-none">
                <div class="form-group">
                    {!! Field::select('preventivo', config('options.preventivos'), ['empty'=>'Seleccionar', 'label'=>'Preventivo', 'class'=>'form-control-sm']) !!}
                </div>
            </div>
            <div class="col-sm-2 d-none">
                <div class="form-group">
                    {!! Field::select('inventory[seguro]', config('options.cia_seguros'), ['empty'=>'Seleccionar', 'label'=>'Cia Seguro', 'class'=>'form-control-sm', 'id'=>'seguro']) !!}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-2">
                {!! Field::text('placa', (isset($car)) ? $car->placa : null, ['label' => 'Placa', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="brand">Marca</label>
                    {!! Form::text('brand', (isset($car->modelo->brand)) ? $car->modelo->brand->name : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'brand', 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    {!! Form::text('modelo', (isset($car->modelo)) ? $car->modelo->name : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'modelo', 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="year">Año</label>
                    {!! Form::text('year', (isset($car)) ? $car->year : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'year', 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="color">Color</label>
                    {!! Form::text('color', (isset($car)) ? $car->color : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'color', 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="vin">VIN</label>
                    {!! Form::text('vin', (isset($car)) ? $car->vin : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'vin', 'readonly']) !!}
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="company_name">Propietario</label>
                    {!! Form::text('company_name', (isset($client)) ? $client->company_name : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'company_name', 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="doc">DOC</label>
                    {!! Form::text('doc', (isset($client)) ? $client->doc : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'doc', 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="phone">Tel. Fijo</label>
                    {!! Form::text('phone', (isset($client)) ? $client->phone : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'phone', 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="mobile">Celular</label>
                    {!! Form::text('mobile', (isset($client)) ? $client->mobile : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'mobile', 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label for="email">Email</label>
                    {!! Form::text('email', (isset($client)) ? $client->email : '',['class'=>'form-control-sm form-control-plaintext', 'id'=>'email', 'readonly']) !!}
                </div>
            </div>
        </div>

        <div class="form-row">
            {{--<div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">Agregar Usuario</label>
                    </div>
                </div>
            </div>--}}
            <div class="col-md-2 col-sm-4">
                {!! Field::text('inventory[contact_name]', (isset($model->inventory->contact_name
                ) ? $model->inventory->contact_name : ''), ['label' => 'Contacto Nombre', 'class'=>'form-control-sm text-uppercase']) !!}
            </div>
            <div class="col-md-2 col-sm-4">
                {!! Field::text('inventory[contact_mobile]', (isset($model->inventory->contact_mobile
                ) ? $model->inventory->contact_mobile : ''), ['label' => 'Contacto Celular', 'class'=>'form-control-sm text-uppercase']) !!}
            </div>
            <div class="col-md-2 col-sm-4">
                {!! Field::email('inventory[contact_email]', (isset($model->inventory->contact_email
                ) ? $model->inventory->contact_email : ''), ['label' => 'Contacto Email', 'class'=>'form-control-sm text-uppercase']) !!}
            </div>
            {{--<div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                        <label class="form-check-label" for="defaultCheck2">Agregar Contacto</label>
                    </div>
                </div>
            </div>--}}
            <div class="col-md-2 col-sm-4">
                {!! Field::text('inventory[driver_name]', (isset($model->inventory->driver_name
                ) ? $model->inventory->driver_name : ''), ['label' => 'Conductor Nombre', 'class'=>'form-control-sm text-uppercase']) !!}
            </div>
            <div class="col-md-2 col-sm-4">
                {!! Field::text('inventory[driver_mobile]', (isset($model->inventory->driver_mobile
                ) ? $model->inventory->driver_mobile : ''), ['label' => 'Conductor Celular', 'class'=>'form-control-sm text-uppercase']) !!}
            </div>
            <div class="col-md-2 col-sm-4">
                {!! Field::email('inventory[driver_email]', (isset($model->inventory->driver_email
                ) ? $model->inventory->driver_email : ''), ['label' => 'Conductor Email', 'class'=>'form-control-sm text-uppercase']) !!}
            </div>
        </div>

        <div class="form-row">
            {{--<div class="col-sm-2">
                <div id="field_inventory_combustible" class="form-group">
                    <label for="inventory_combustible">
                        Combustible <span class="badge badge-info">!</span>
                    </label>
                    <input class="" id="inventory_combustible" name="inventory[combustible]" type="range" step='25' value="{{(isset($model->inventory->combustible))? $model->inventory->combustible :''}}">
                </div>
            </div> --}}
            <div class="col-sm-2">
                {!! Field::select('inventory[combustible]', config('options.combustible'), (isset($model->inventory->combustible
                ) ? $model->inventory->combustible : ''), ['empty'=>'SELECCIONAR', 'label'=>'Combustible', 'class'=>'form-control-sm', 'required']) !!}
            </div>
            <div class="col-sm-2">
                {!! Field::number('kilometraje', null, ['label' => 'Kilom.', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
            </div>
            <div class="col-sm-2">
                {!! Field::select('inventory[tarjeta_propiedad]', config('options.tarjeta_propiedad'), (isset($model->inventory->tarjeta_propiedad
                ) ? $model->inventory->tarjeta_propiedad : ''), ['empty'=>'SELECCIONAR', 'label'=>'TJ Propiedad', 'class'=>'form-control-sm', 'required']) !!}
            </div>
            <div class="col-sm-2">
                {!! Field::date('inventory[soat]', (isset($model->inventory->soat) ? $model->inventory->soat : ''), ['label'=>'Fecha de soat', 'class'=>'form-control-sm']) !!}
            </div>
            <div class="col-sm-2">
                {!! Field::date('inventory[revision_tecnica]', (isset($model->inventory->revision_tecnica) ? $model->inventory->revision_tecnica : ''), ['label'=>'Revisión Técnica', 'class'=>'form-control-sm']) !!}
            </div>
            <div class="col-sm-2">
                {!! Field::number('inventory[llaves]', (isset($model->inventory->llaves) ? $model->inventory->llaves : '0'), ['label'=>'Llaves', 'class'=>'form-control-sm', 'required']) !!}
            </div>
            <div class="col-sm-2">
                {!! Field::select('inventory[control_remoto]', ['SI'=>'SI', 'NO'=>'NO'], (isset($model->inventory->control_remoto
                ) ? $model->inventory->control_remoto : ''), ['empty'=>'Seleccionar', 'label'=>'Control Remoto', 'class'=>'form-control-sm', 'required']) !!}
            </div>
            <div class="col-sm-2">
                {!! Field::select('inventory[comprobante]', ['FACTURA'=>'FACTURA', 'BOLETA'=>'BOLETA'], (isset($model->inventory->comprobante
                ) ? $model->inventory->comprobante : ''), ['empty'=>'SIN COMPROBANTE', 'label'=>'Comprobante', 'class'=>'form-control-sm']) !!}
            </div>
            <!-- <div class="col-sm-2">
                {!! Field::date('inventory[entrega]', (isset($model->inventory->entrega) ? $model->inventory->entrega : date('Y-m-d')), ['label'=>'Fecha de Entrega', 'class'=>'form-control-sm']) !!}
            </div> -->
        </div>

        <div class="form-row">
            <div class="col-sm-12">
                <div id="field_inventory_combustible" class="form-group">
                    <label for="inventory_solicitud">Solicitud del Cliente:</label>
                    <textarea class="form-control form-control-sm text-uppercase" id="inventory_solicitud" rows="2" name="inventory[solicitud]">{{(isset($model->inventory->solicitud))? trim($model->inventory->solicitud):''}}</textarea>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header padding-1" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          CheckList
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <div class="form-row">
            <div class="col-sm-12">

            @foreach($checklist_details as $index => $checklist)
                @php
                $checkeds = ['correcto' => '', 'recomendable' => '', 'urgente' => '', 'no_aplica' => '', '' => '']; 
                $checkeds[$checklist->status] = 'checked';
                @endphp
                <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][id]" value="">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][order_id]" value="{{ (isset($model)) ? $model->id : '' }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][checklist_id]" value="{{ $checklist->checklist_id }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][checklist_detail_id]" value="{{ (isset($checklist->checklist_detail_id)) ? $checklist->checklist_detail_id : $checklist->id }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][name]" value="{{ $checklist->name }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][type]" value="{{ $checklist->type }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][category]" value="{{ $checklist->category }}">
                    <span class="item-name">{{ $checklist->name }}</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[{{ $index }}][status]" id="correcto-{{ $index }}" value="correcto" {{ $checkeds['correcto'] }} required>
                            <label class="form-check-label" for="correcto-{{ $index }}">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[{{ $index }}][status]" id="recomendable-{{ $index }}" value="recomendable" {{ $checkeds['recomendable'] }} required>
                            <label class="form-check-label" for="recomendable-{{ $index }}">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[{{ $index }}][status]" id="urgente-{{ $index }}" value="urgente" {{ $checkeds['urgente'] }} required>
                            <label class="form-check-label" for="urgente-{{ $index }}">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[{{ $index }}][status]" id="no-aplica-{{ $index }}" value="no_aplica" {{ $checkeds['no_aplica'] }} required>
                            <label class="form-check-label" for="no-aplica-{{ $index }}">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[{{ $index }}][comment]" value="{{ $checklist->comment }}" placeholder="">
                </div>
            @endforeach
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-12">
                {!! Field::text('comment', ['label' => 'Comentarios:', 'class'=>'form-control-sm text-uppercase']) !!}
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header padding-1" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Daños
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <label for="imageSelector">Selecciona un tipo de vehículo:</label>
                <select id="imageSelector" class="form-control-sm custom-select w-auto d-inline-block" onchange="changeImage()">
                    <option value="/img/inv-sedan.jpg">Sedán</option>
                    <option value="/img/inv-suv.jpg">SUV</option>
                    <option value="/img/inv-pickup.jpg">Pickup</option>
                </select>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearCanvas()"><i class="fas fa-trash"></i> Borrar marcas</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="undoLastMark()"><i class="fas fa-undo"></i> Deshacer</button>
                <div class="d-inline-block ml-3">
                    <div class="form-check form-check-inline radio-green">
                        <input class="form-check-input" type="radio" name="damageType" id="rayon" value="green" checked>
                        <label class="form-check-label" for="rayon">Rayón</label>
                    </div>
                    <div class="form-check form-check-inline radio-red">
                        <input class="form-check-input" type="radio" name="damageType" id="abolladura" value="red">
                        <label class="form-check-label" for="abolladura">Abolladura</label>
                    </div>
                    <div class="form-check form-check-inline radio-blue">
                        <input class="form-check-input" type="radio" name="damageType" id="quine" value="blue">
                        <label class="form-check-label" for="quine">Quiñe</label>
                    </div>
                </div>
                
                <input type="hidden" id="image_base64" name="image_base64">
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-12 text-center canvas-container">
                <canvas id="damageCanvas"></canvas>
            </div>
        </div>

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header padding-1" id="headingFour">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Fotos
        </button>
      </h2>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body text-center">

        

        <input type="file" accept="image/*" id="photoInput" style="display:none;" capture="environment">
        <button type="button" class="btn btn-outline-primary mt-4" id="addPhoto"><i class="fas fa-camera"></i> Tomar Foto</button>
        <input type="file" accept="video/*" id="videoInput" style="display:none;" capture="environment">
        <button type="button" style="display:none;" class="btn btn-outline-primary" id="addVideo"><i class="fas fa-video"></i> Grabar Video</button>

        <div class="media-container">
            <div id="imageView" class="image-view" style="display:none;">
                <img id="selectedImage" src="" alt="Imagen seleccionada">
                <button type="button" class="btn btn-secondary full-screen-btn" id="fullScreenBtn"><i class="fas fa-expand"></i></button>
            </div>
            <div id="videoPlayer" class="video-player" style="display:none;">
                <video class="embed-responsive-item" controls></video>
            </div>
        </div>
        <div class="thumbnails d-flex flex-wrap mt-2" id="multimedia">
            @php $imageCount=0; @endphp
            @if(isset($model->inventory->photos) and !is_null($model->inventory->photos))
                @foreach($model->inventory->photos as $imageCount => $photo)
                    @php $imageId = "image-".$imageCount; @endphp
                <div class="thumbnail" id="thumbnail-{{ $imageId }}" onclick="showImage('/storage/{{ $photo }}')">
                    <img src="/storage/{{ $photo }}" alt="Foto {{ $imageCount + 1 }}">
                    <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeThumbnail('{{ $imageId }}')">X</button>
                </div>
                <input type="hidden" id="input-{{ $imageId }}" name="inventory[photos][{{ $imageCount }}]" value="{{ $photo }}">
                @endforeach
                @php $imageCount = $imageCount + 1; @endphp
            @endif
        </div>

      </div>
    </div>
  </div>
</div>


<script>
    // $('#selectedImage').on('click', function () {
    //     $(this).toggleClass('zoomed');
    // });

        let canvas = document.getElementById("damageCanvas");
        let ctx = canvas.getContext("2d");
        let img = new Image();
        let marks = [];
        
        function loadImage(src) {
            img.src = src;
            img.onload = function() {
                canvas.width = img.naturalWidth;
                canvas.height = img.naturalHeight;
                redrawCanvas();
                updateImageData();
            };
        }
        
        function changeImage() {
            let selectedImage = document.getElementById("imageSelector").value;
            marks = [];
            loadImage(selectedImage);
        }
        @if(isset($model))
        loadImage("/storage/ot_{{$model->id}}.jpg");
        @else
        loadImage("/img/inv-sedan.jpg");
        @endif
        
        canvas.addEventListener("click", function(event) {
            let rect = canvas.getBoundingClientRect();
            let scaleX = canvas.width / rect.width;
            let scaleY = canvas.height / rect.height;
            let x = (event.clientX - rect.left) * scaleX;
            let y = (event.clientY - rect.top) * scaleY;
            let color = document.querySelector('input[name="damageType"]:checked').value;
            // let color = document.getElementById("damageType").value;
            marks.push({ x, y, color });
            redrawCanvas();
            updateImageData();
        });
        
        function drawMark(x, y, color) {
            ctx.fillStyle = color;
            ctx.beginPath();
            ctx.arc(x, y, 5, 0, 2 * Math.PI);
            ctx.fill();
        }
        
        function undoLastMark() {
            if (marks.length > 0) {
                marks.pop();
                redrawCanvas();
                updateImageData();
            }
        }
        
        function clearCanvas() {
            marks = [];
            redrawCanvas();
            updateImageData();
        }
        
        function redrawCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            marks.forEach(mark => drawMark(mark.x, mark.y, mark.color));
        }
        
        function updateImageData() {
            $("#image_base64").val(document.querySelector("#damageCanvas").toDataURL('image/jpeg').replace(/^data:image\/jpeg;base64,/, ""))
            /*canvas.toBlob(function(blob) {
                let reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    document.getElementById("image_base64").value = reader.result;
                };
            }, "image/png");*/
        }

$(document).ready(function () {
    const imageElement = document.getElementById('selectedImage');
    const panzoom = Panzoom(imageElement, {
        maxScale: 5,
        contain: 'outside',
    });

    imageElement.parentElement.addEventListener('wheel', panzoom.zoomWithWheel);
    
    @if(isset($model->inventory->photos) and !is_null($model->inventory->photos))
        showImage("/storage/{{ current($model->inventory->photos) }}")
    @endif
    let imageCount = {{ $imageCount }};
    let videoCount = 0;

    $('#addPhoto').on('click', function () {
        $('#photoInput').click();
    });
    
    $('#photoInput').on('change', function (event) {
        const files = event.target.files;
        const thumbnails = $('.thumbnails');

        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            const reader = new FileReader();
            reader.onload = function (e) {
                const originalDataUrl = e.target.result;

                const originalImage = new Image();
                originalImage.onload = function () {
                    // 🔧 Establecer límite máximo de dimensiones
                    const MAX_WIDTH = 1200;
                    const MAX_HEIGHT = 1200;

                    let w = originalImage.width;
                    let h = originalImage.height;

                    if (w > MAX_WIDTH || h > MAX_HEIGHT) {
                        const factor = Math.min(MAX_WIDTH / w, MAX_HEIGHT / h);
                        w = Math.floor(w * factor);
                        h = Math.floor(h * factor);
                    }

                    // 🎯 Canvas temporal con fondo blanco
                    const canvas = document.createElement('canvas');
                    canvas.width = w;
                    canvas.height = h;
                    const ctx = canvas.getContext('2d');
                    ctx.fillStyle = "#ffffff";
                    ctx.fillRect(0, 0, w, h);
                    ctx.drawImage(originalImage, 0, 0, w, h);

                    // ⚡ Convertir directamente a Blob (evita usar mucha RAM)
                    canvas.toBlob(function (blob) {
                        const formData = new FormData();
                        formData.append('photo', blob, 'photo.jpg');

                        $.ajax({
                            url: "{{ route('upload_photo') }}",
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                const imageId = `image-${imageCount}`;
                                const publicUrl = '/storage/' + response.filename;

                                thumbnails.append(`
                                    <div class="thumbnail" id="thumbnail-${imageId}" onclick="showImage('${publicUrl}')">
                                        <img src="${publicUrl}" alt="Foto ${imageCount + 1}">
                                        <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeThumbnail('${imageId}')">X</button>
                                    </div>
                                `);

                                $('#multimedia').append(`<input type="hidden" id="input-${imageId}" name="inventory[photos][${imageCount}]" value="${response.filename}">`);

                                showImage(publicUrl);
                                imageCount++;
                            },
                            error: function () {
                                alert('Error al subir la foto');
                            }
                        });
                    }, 'image/jpeg', 0.6); // 👈 Calidad ajustada (60%)
                };

                originalImage.src = originalDataUrl;
            };

            reader.readAsDataURL(file);
        }
    });


    $('#addVideo').on('click', function () {
        $('#videoInput').click();
    });

    $('#videoInput').on('change', function (event) {
        const files = event.target.files;
        const thumbnails = $('.thumbnails');

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function (e) {
                const videoId = `video-${videoCount}`;
                thumbnails.append(`
                    <div class="thumbnail" id="thumbnail-${videoId}" onclick="playVideo('${e.target.result}')">
                        <video src="${e.target.result}" muted></video>
                        <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeThumbnail('${videoId}')">X</button>
                    </div>
                `);
                $('#multimedia').append(`<input type="hidden" id="input-${videoId}" name="inventory[videos][${videoCount}]" value="${e.target.result}">`);
                videoCount++;
                playVideo(e.target.result);
            };

            reader.readAsDataURL(file);
        }
    });

    // document.getElementById('fullScreenBtn').addEventListener('click', function (event) {
    //     event.preventDefault(); // Previene la navegación accidental

    //     const img = document.getElementById('selectedImage');
    //     if (img) {
    //         if (img.requestFullscreen) {
    //             img.requestFullscreen();
    //         } else if (img.mozRequestFullScreen) { // Firefox
    //             img.mozRequestFullScreen();
    //         } else if (img.webkitRequestFullscreen) { // Chrome, Safari y Opera
    //             img.webkitRequestFullscreen();
    //         } else if (img.msRequestFullscreen) { // IE/Edge
    //             img.msRequestFullscreen();
    //         }
    //     }
    // });

    $('#fullScreenBtn').on('click', function () {
        const img = document.getElementById('selectedImage');
        if (img) {
            if (img.requestFullscreen) {
                img.requestFullscreen();
            } else if (img.mozRequestFullScreen) {
                img.mozRequestFullScreen();
            } else if (img.webkitRequestFullscreen) {
                img.webkitRequestFullscreen();
            } else if (img.msRequestFullscreen) {
                img.msRequestFullscreen();
            }
        }
    });
});

function dataURLtoBlob(dataurl) {
    const arr = dataurl.split(',');
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    while(n--) u8arr[n] = bstr.charCodeAt(n);
    return new Blob([u8arr], { type: mime });
}
// Actualización de removeThumbnail para mostrar la primera miniatura disponible o ocultar el visualizador si no hay ninguna.
function removeThumbnail(id) {
    if (confirm("¿Estás seguro de que quieres eliminar esta foto o video?")) {
        $(`#thumbnail-${id}`).remove();
        $(`#input-${id}`).remove();

        setTimeout(function() {
            // Buscar la primera miniatura restante
            let firstThumbnail = $('.thumbnail').first();
            if (firstThumbnail.length > 0) {
                // Simula el clic para mostrar la miniatura en el visualizador
                firstThumbnail.click();
            } else {
                // Si no quedan miniaturas, ocultar ambos visualizadores
                $('#imageView').hide();
                $('#videoPlayer').hide();
            }
        }, 500)
    }
}

function showImage(src) {
    $('#videoPlayer').hide();
    $('#selectedImage').attr('src', src);
    $('#imageView').show();
}

function playVideo(src) {
    $('#imageView').hide();
    $('#videoPlayer video').attr('src', src).show();
    $('#videoPlayer').show();
}
</script>