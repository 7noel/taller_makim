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
			<div class="col-sm-1">
				{!! Field::select('currency_id', config('options.table_sunat.moneda'), (isset($model) ? null : 1), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm', 'required']) !!}
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
			<div class="col-md-4 col-sm-6">
				{!! Field::text('comment', ['label' => 'Comentarios', 'class'=>'form-control-sm text-uppercase']) !!}
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
			<div class="col-sm-3">
			@foreach (config('options.inventory.col_1') as $label)
				<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" id="{{$label}}" name="inventory[{{$label}}]" {{((isset($model->inventory->$label) and $model->inventory->$label==true))?'checked':''}}>
					<label class="custom-control-label" for="{{$label}}">{{ $label }}</label>
				</div>
			@endforeach
			</div>
			<div class="col-sm-3">
			@foreach (config('options.inventory.col_2') as $label)
				<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" id="{{$label}}" name="inventory[{{$label}}]" {{((isset($model->inventory->$label) and $model->inventory->$label==true))?'checked':''}}>
					<label class="custom-control-label" for="{{$label}}">{{ $label }}</label>
				</div>
			@endforeach
			</div>
			<div class="col-sm-3">
			@foreach (config('options.inventory.col_3') as $label)
				<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" id="{{$label}}" name="inventory[{{$label}}]" {{((isset($model->inventory->$label) and $model->inventory->$label==true))?'checked':''}}>
					<label class="custom-control-label" for="{{$label}}">{{ $label }}</label>
				</div>
			@endforeach
			</div>
		</div>
		<div class="form-row mt-2">
			<div class="col-sm-12">
				<div id="field_inventory_combustible" class="form-group">
					<label for="inventory_solicitud">Solicitud Cliente</label>
					<textarea class="form-control form-control-sm text-uppercase" id="inventory_solicitud" rows="5" name="inventory[solicitud]">{{(isset($model->inventory->solicitud))? trim($model->inventory->solicitud):''}}</textarea>
				</div>
			</div>
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

        <input type="file" accept="image/*" id="photoInput" style="display:none;" capture="camera">
        <button type="button" class="btn btn-outline-primary" id="addPhoto"><i class="fas fa-camera"></i> Tomar Foto</button>
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
        <div class="thumbnails d-flex flex-wrap mt-2"></div>

	</div>
</div>
<script>
    $(document).ready(function() {
        $('#addPhoto').on('click', function() {
            $('#photoInput').click();
        });

        $('#photoInput').on('change', function(event) {
            const files = event.target.files;
            const thumbnails = $('.thumbnails');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    thumbnails.append(`
                        <div class="thumbnail" onclick="showImage('${e.target.result}')">
                            <img src="${e.target.result}" alt="Foto ${i + 1}">
                            <button class="btn btn-danger btn-sm remove-btn" onclick="removeThumbnail(this)">X</button>
                        </div>
                    `);
                    showImage(e.target.result);
                };

                reader.readAsDataURL(file);
            }
        });

        $('#addVideo').on('click', function() {
            $('#videoInput').click();
        });

        $('#videoInput').on('change', function(event) {
            const files = event.target.files;
            const thumbnails = $('.thumbnails');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    thumbnails.append(`
                        <div class="thumbnail" onclick="playVideo('${e.target.result}')">
                            <video src="${e.target.result}" muted></video>
                            <button class="btn btn-danger btn-sm remove-btn" onclick="removeThumbnail(this)">X</button>
                        </div>
                    `);
                    playVideo(e.target.result);
                };

                reader.readAsDataURL(file);
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

    $('#fullScreenBtn').on('click', function() {
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

    function removeThumbnail(button) {
        if (confirm("¿Estás seguro de que quieres eliminar esta foto?")) {
            $(button).closest('.thumbnail').remove();
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