<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcador de Daños</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .canvas-container {
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
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="mb-3">Marca los daños en la imagen</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <label for="imageSelector">Selecciona un tipo de vehículo:</label>
                <select id="imageSelector" class="custom-select w-auto d-inline-block" onchange="changeImage()">
                    <option value="/img/inv-sedan.png">Sedán</option>
                    <option value="/img/inv-suv.png">SUV</option>
                    <option value="/img/inv-pickup.png">Pickup</option>
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
                    <option value="red">Rayón</option>
                    <option value="blue">Abolladura</option>
                    <option value="green">Quiñe</option>
                </select>
                
                <input type="hidden" id="image_base64" name="image_base64">
            </div>
        </div>
    </div>
    
    <script>
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
        
        loadImage("/img/inv-sedan.png");
        
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
            canvas.toBlob(function(blob) {
                let reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    document.getElementById("image_base64").value = reader.result;
                };
            }, "image/png");
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
