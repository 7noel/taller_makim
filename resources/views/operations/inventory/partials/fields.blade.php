{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('is_downloadable', 1, ['id'=>'is_downloadable']) !!}
{!! Form::hidden('with_tax', 1, ['id'=>'with_tax']) !!}
{!! Form::hidden('company_id', null, ['id'=>'company_id']) !!}
{!! Form::hidden('car_id', null, ['id'=>'car_id']) !!}
{!! Form::hidden('action', $action, ['id'=>'action']) !!}

<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item" role="presentation">
		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inventario</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Imagen</a>
	</li>
</ul>
<div class="tab-content mt-2" id="myTabContent">
	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		<div class="form-row">
			<div class="col-md-1 col-sm-2">
				{!! Form::label('sn', 'Inventario') !!}
				@if(isset($model) and $model->order_type == 'inventory')
				{!! Form::text('sn', null, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
				@else
				{!! Form::text('sn', '',['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
				@endif
			</div>
			<div class="col-md-1 col-sm-2">
				{!! Field::text('placa', null, ['label' => 'Placa', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
			</div>
			<div class="col-md-1 col-sm-2">
				{!! Field::number('kilometraje', null, ['label' => 'Kilom.', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
			</div>
			<div class="col-sm-2">
				{!! Field::select('type_service', config('options.types_service'), ['empty'=>'Seleccionar', 'label'=>'Servicio', 'class'=>'form-control-sm', 'required']) !!}
			</div>
			<div class="col-sm-1 d-none">
				{!! Field::select('preventivo', config('options.preventivos'), ['empty'=>'Seleccionar', 'label'=>'Preventivo', 'class'=>'form-control-sm']) !!}
			</div>
			<div class="col-md-2 col-sm-4">
				@if(isset(\Auth::user()->employee->job_id) and (\Auth::user()->employee->job_id == 8 or \Auth::user()->id==3))
				{!! Field::select('seller_id', [\Auth::user()->employee->id => \Auth::user()->employee->full_name], ['empty'=>'Seleccionar', 'label'=>'Asesor', 'class'=>'form-control-sm', 'required']) !!}
				@else
				{!! Field::select('seller_id', $sellers, ['empty'=>'Seleccionar', 'label'=>'Asesor', 'class'=>'form-control-sm', 'required']) !!}
				@endif
			</div>
			<div class="col-md-2 col-sm-4">
				{!! Field::text('attention', ['label' => 'Atención', 'class'=>'form-control-sm text-uppercase']) !!}
			</div>
		</div>

		<div class="form-row">
			<div class="col-sm-2">
				<div id="field_inventory_combustible" class="form-group">
					<label for="inventory_combustible">
						Combustible
					</label>
					<input class="" id="inventory_combustible" name="inventory[combustible]" type="range" step='25' value="{{(isset($model->inventory->combustible))? $model->inventory->combustible :''}}">
				</div>
			</div>
			<div class="col-sm-2">
				{!! Field::select('inventory[comprobante]', ['FACTURA'=>'FACTURA', 'BOLETA'=>'BOLETA'], (isset($model->inventory->comprobante
				) ? $model->inventory->comprobante : ''), ['empty'=>'SIN COMPROBANTE', 'label'=>'Comprobante', 'class'=>'form-control-sm']) !!}
			</div>
			<div class="col-sm-2">
				{!! Field::date('inventory[entrega]', (isset($model->inventory->entrega) ? $model->inventory->entrega : date('Y-m-d')), ['label'=>'Fecha de Entrega', 'class'=>'form-control-sm']) !!}
			</div>
		</div>
        <div class="form-row">
            <div class="col-sm-12">
                <div id="field_inventory_combustible" class="form-group">
                    <label for="inventory_solicitud">Solicitud Cliente</label>
                    <textarea class="form-control form-control-sm text-uppercase" id="inventory_solicitud" rows="2" name="inventory[solicitud]">{{(isset($model->inventory->solicitud))? trim($model->inventory->solicitud):''}}</textarea>
                </div>
            </div>
            <div class="col-sm-12">
                {!! Field::text('comment', ['label' => 'Comentarios', 'class'=>'form-control-sm text-uppercase']) !!}
            </div>
        </div>
		
		<div class="form-row">

  <style>
    .radio-green input[type="radio"] + label { color: green; }
    .radio-amber input[type="radio"] + label { color: orange; }
    .radio-red input[type="radio"] + label { color: red; }
    .radio-black input[type="radio"] + label { color: black; }

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
			@foreach($checklist_details as $index => $checklist)
                @php
                $checkeds = ['correcto' => '', 'recomendable' => '', 'urgente' => '', 'no_aplica' => '', '' => '']; 
                $checkeds[$checklist->status] = 'checked';
                @endphp
                <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][id]" value="">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][order_id]" value="{{ (isset($model)) ? $model->id : '' }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][checklist_id]" value="{{ $checklist->checklist_id }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][checklist_detail_id]" value="{{ $checklist->id }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][name]" value="{{ $checklist->name }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][type]" value="{{ $checklist->type }}">
                    <input type="hidden" name="order_checklist_details[{{ $index }}][category]" value="{{ $checklist->category }}">
                    <span class="item-name">{{ $checklist->name }}</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[{{ $index }}][status]" id="correcto-{{ $index }}" value="correcto" {{ $checkeds['correcto'] }}>
                            <label class="form-check-label" for="correcto-{{ $index }}">Correcto</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[{{ $index }}][status]" id="recomendable-{{ $index }}" value="recomendable" {{ $checkeds['recomendable'] }}>
                            <label class="form-check-label" for="recomendable-{{ $index }}">Recomendable</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[{{ $index }}][status]" id="urgente-{{ $index }}" value="urgente" {{ $checkeds['urgente'] }}>
                            <label class="form-check-label" for="urgente-{{ $index }}">Urgente</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[{{ $index }}][status]" id="no-aplica-{{ $index }}" value="no_aplica" {{ $checkeds['no_aplica'] }}>
                            <label class="form-check-label" for="no-aplica-{{ $index }}">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[{{ $index }}][comment]" value="{{ $checklist->comment }}" placeholder="Escribe un comentario">
                </div>
			@endforeach
		</div>

	</div>
	<div class="tab-pane fade mb-5 text-center" id="contact" role="tabpanel" aria-labelledby="contact-tab">
		{{--
		<input type="hidden" id="mi_ot" value="{{ (isset($model) and \Storage::disk('public')->exists('ot_'.$model->id.'.jpg'))? $model->id : '' }}">
		<input type="color"  class="js-color-picker color-picker" value="#fa0000">
		<input type="range" class="js-line-range" min="4" max="30" value="4">
		<label class="js-range-value">4</label>Px
		<input type="hidden" name="image_base64" id="image_base64">
		<button type="button" class="btn btn-sm btn-info" id="btn-image-load">Cargar imagen</button>
		<button type="button" class="btn btn-sm btn-light" id="btn-reset">Limpiar imagen</button>

		<div id="my-image-editor" width="600" height="300">
			<canvas class="js-paint paint-canvas" id="canvas" style="max-widt=100%"></canvas>
		</div>
		--}}

        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <label for="imageSelector">Selecciona un tipo de vehículo:</label>
                <select id="imageSelector" class="custom-select w-auto d-inline-block" onchange="changeImage()">
                    <option value="/img/inv-sedan.jpg">Sedán</option>
                    <option value="/img/inv-suv.jpg">SUV</option>
                    <option value="/img/inv-pickup.jpg">Pickup</option>
                </select>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-12 text-center canvas-container">
                <canvas id="damageCanvas"></canvas>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-12 text-center">
                <button class="btn btn-outline-danger" onclick="clearCanvas()"><i class="fas fa-trash"></i> Borrar marcas</button>
                <button class="btn btn-outline-secondary" onclick="undoLastMark()"><i class="fas fa-undo"></i> Deshacer</button>
                <select id="damageType" class="custom-select w-auto d-inline-block">
                    <option value="green">Rayón</option>
                    <option value="red">Abolladura</option>
                    <option value="blue">Quiñe</option>
                </select>
                
                <input type="hidden" id="image_base64" name="image_base64">
            </div>
        </div>


        <input type="file" accept="image/*" id="photoInput" style="display:none;" capture="camera">
        <button type="button" class="btn btn-outline-primary mt-4" id="addPhoto"><i class="fas fa-camera"></i> Tomar Foto</button>
        <input type="file" accept="video/*" id="videoInput" style="display:none;" capture="camera">
        <button type="button" style="display:none;" class="btn btn-outline-primary" id="addVideo"><i class="fas fa-video"></i> Grabar Video</button>
        
        <div class="media-container">
            <div id="imageView" class="image-view" style="display:none;">
                <img id="selectedImage" src="" alt="Imagen seleccionada">
                <button class="btn btn-secondary full-screen-btn" id="fullScreenBtn"><i class="fas fa-expand"></i></button>
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
                <button class="btn btn-danger btn-sm remove-btn" onclick="removeThumbnail('{{ $imageId }}')">X</button>
            </div>
            <input type="hidden" id="input-{{ $imageId }}" name="inventory[photos][{{ $imageCount}}]" value="{{ $photo }}">
            @endforeach
            @php $imageCount = $imageCount + 1; @endphp
        @endif
        </div>

	</div>
</div>
<script>
    @if(isset($model->inventory->photos) and !is_null($model->inventory->photos))
        showImage("/storage/{{ current($model->inventory->photos) }}")
    @endif
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
            let color = document.getElementById("damageType").value;
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
    let imageCount = {{ $imageCount }};
    let videoCount = 0;

    $('#addPhoto').on('click', function () {
        $('#photoInput').click();
    });

    $('#photoInput').on('change', function (event) {
        console.log(imageCount)
        const files = event.target.files;
        const thumbnails = $('.thumbnails');

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function (e) {
                const imageId = `image-${imageCount}`;
                thumbnails.append(`
                    <div class="thumbnail" id="thumbnail-${imageId}" onclick="showImage('${e.target.result}')">
                        <img src="${e.target.result}" alt="Foto ${imageCount + 1}">
                        <button class="btn btn-danger btn-sm remove-btn" onclick="removeThumbnail('${imageId}')">X</button>
                    </div>
                `);
                $('#multimedia').append(`<input type="hidden" id="input-${imageId}" name="inventory[photos][${imageCount}]" value="${e.target.result.replace(/^data:image\/jpeg;base64,/, "")}">`);
                imageCount++;
                showImage(e.target.result);
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
                        <button class="btn btn-danger btn-sm remove-btn" onclick="removeThumbnail('${videoId}')">X</button>
                    </div>
                `);
                $('#multimedia').append(`<input type="hidden" id="input-${videoId}" name="inventory[videos][${videoCount}]" value="${e.target.result}">`);
                videoCount++;
                playVideo(e.target.result);
            };

            reader.readAsDataURL(file);
        }
    });

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

function removeThumbnail(id) {
    if (confirm("¿Estás seguro de que quieres eliminar esta foto o video?")) {
        $(`#thumbnail-${id}`).remove();
        $(`#input-${id}`).remove();
    }
}
</script>

<script>/*
const loadImage = (canvas, image_url) => {
	context = canvas.getContext("2d")
	var img = new Image()
	img.src = image_url
	img.onload = function(){
		imgWidth = this.width
		imgHeight = this.height
		canvas.width = imgWidth
		canvas.height = imgHeight
		//canvas.style.width = '90%'
		context.drawImage(this, 0, 0, imgWidth, imgHeight)
		context.lineCap = 'round'
		context.strokeStyle = '#fa0000'
		context.lineWidth = '4'
	}
}
var ot = document.getElementById('mi_ot').value
if (ot!='') {
	image_url = `/storage/ot_${ot}.jpg`
} else {
	image_url = "/img/inventory.jpeg"
}
var canvas = document.getElementById("canvas"),
	context = canvas.getContext("2d"),
	painting = false,
	lastX = 0,
	lastY = 0,
	lineThickness = 1;
if (canvas.getContext) {
	loadImage(canvas, image_url)
}
// const canvas = document.querySelector( '.js-paint' );
// const context = canvas.getContext( '2d' );


const colorPicker = document.querySelector('.js-color-picker')

colorPicker.addEventListener('change', event => {
    context.strokeStyle = event.target.value
})

const lineWidthRange = document.querySelector( '.js-line-range' )
const lineWidthLabel = document.querySelector( '.js-range-value' )

lineWidthRange.addEventListener( 'input', event => {
    const width = event.target.value
    lineWidthLabel.innerHTML = width
    context.lineWidth = width
})

let x = 0, y = 0;
let isMouseDown = false;

const stopDrawing = () => { isMouseDown = false; }
const startDrawing = event => {
    isMouseDown = true;   
   [x, y] = [event.offsetX, event.offsetY];  
}

var newX = 0
var newY = 0

const drawLine = event => {
    if ( isMouseDown ) {
    	let posicion = canvas.getBoundingClientRect()
		let correccionX = posicion.x;
		let correccionY = posicion.y;
		if (event.changedTouches == undefined) {
            // Versión ratón
            newX = event.offsetX;
            newY = event.offsetY;
        } else {
            // Versión touch, pantalla tactil
            newX = event.changedTouches[0].pageX - correccionX;
            newY = event.changedTouches[0].pageY - correccionY;
        }
        context.beginPath();
        context.moveTo( x, y );
        context.lineTo( newX, newY );
        context.stroke();
        //[x, y] = [newX, newY];
        x = newX;
        y = newY;
    }
}

canvas.addEventListener( 'mousedown', startDrawing );
canvas.addEventListener( 'mousemove', drawLine );
canvas.addEventListener( 'mouseup', stopDrawing );
canvas.addEventListener( 'mouseout', stopDrawing );
// Eventos pantallas táctiles
canvas.addEventListener('touchstart', startDrawing)
canvas.addEventListener('touchmove', drawLine)

document.getElementById("btn-reset").onclick = function() {  
	loadImage(canvas, '/img/inventory.jpeg')
}
*/
</script>