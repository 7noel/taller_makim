<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcador de Daños</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .container {
            position: relative;
            max-width: 100%;
            display: inline-block;
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
        <h2 class="mb-3">Marca los daños en la imagen</h2>
        <div class="d-flex justify-content-center">
            <canvas id="damageCanvas"></canvas>
        </div>
        <div class="mt-3">
            <button class="btn btn-danger" onclick="clearCanvas()">Borrar marcas</button>
            <select id="damageType" class="custom-select w-auto d-inline-block">
                <option value="red">Rayón</option>
                <option value="blue">Abolladura</option>
                <option value="green">Quiñe</option>
            </select>
            <button class="btn btn-primary" onclick="saveImage()">Guardar Imagen</button>
        </div>
    </div>
    
    <script>
        let canvas = document.getElementById("damageCanvas");
        let ctx = canvas.getContext("2d");
        let img = new Image();
        img.src = "/img/inv-sedan.png"; // Reemplazar con la URL de la imagen
        
        img.onload = function() {
    canvas.width = img.naturalWidth; // Mantener la calidad original
    canvas.height = img.naturalHeight;
    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
};
        
        canvas.addEventListener("click", function(event) {
    let rect = canvas.getBoundingClientRect();
    let scaleX = canvas.width / rect.width;
    let scaleY = canvas.height / rect.height;
    let x = (event.clientX - rect.left) * scaleX;
    let y = (event.clientY - rect.top) * scaleY;
    let color = document.getElementById("damageType").value;
    drawMark(x, y, color);
});
        
        function drawMark(x, y, color) {
            ctx.fillStyle = color;
            ctx.beginPath();
            ctx.arc(x, y, 5, 0, 2 * Math.PI);
            ctx.fill();
        }
        
        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        }
        
        function saveImage() {
    canvas.toBlob(function(blob) {
        let formData = new FormData();
        formData.append("image", blob, "imagen_con_daños.png");
        
        fetch("/upload", {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => alert("Imagen guardada correctamente: " + data.url))
        .catch(error => console.error("Error al enviar la imagen:", error));
    }, "image/png");
}
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
