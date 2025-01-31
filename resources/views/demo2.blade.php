<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Vehículo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .thumbnail {
    position: relative;
    cursor: pointer;
    margin: 5px;
    width: 100px; /* Ancho de la miniatura */
    height: 56.25px; /* Proporción 16:9 */
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden; /* Evitar que se salgan las imágenes */
    background-color: black; /* Fondo negro */
    border-radius: 4px; /* Opcional: esquinas redondeadas */
}

.thumbnail img, .thumbnail video {
    max-width: 100%; /* No exceder el ancho de la miniatura */
    max-height: 100%; /* No exceder la altura de la miniatura */
    object-fit: cover; /* Mantener la proporción */
}
.thumbnails {
    display: flex;
    flex-wrap: wrap; /* Permitir que se envuelvan las miniaturas */
    justify-content: center; /* Centrar miniaturas */
    margin-top: 10px; /* Espaciado superior */
}

        .remove-btn { position: absolute; top: 5px; right: 5px; }
        .full-screen-btn { position: absolute; bottom: 5px; right: 5px; }
        .media-container { background-color: gray; margin-top: 10px; }
        .video-player, .image-view {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            overflow: hidden;
        }
        #videoPlayer video, #selectedImage {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulario de Vehículo</h1>
        <form id="vehicleForm">
            <div class="form-group">
                <label for="placa">Placa</label>
                <input type="text" class="form-control" id="placa" required>
            </div>
            <div class="form-group">
                <label for="kilometraje">Kilometraje</label>
                <input type="number" class="form-control" id="kilometraje" required>
            </div>
            <div class="form-group">
                <label for="contacto">Contacto</label>
                <input type="text" class="form-control" id="contacto" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="tel" class="form-control" id="celular" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <input type="file" accept="image/*" id="photoInput" style="display:none;" capture="camera">
            <button type="button" class="btn btn-outline-primary" id="addPhoto"><i class="fas fa-camera"></i> Tomar Foto</button>
            <input type="file" accept="video/*" id="videoInput" style="display:none;" capture="camera">
            <button type="button" class="btn btn-outline-primary" id="addVideo"><i class="fas fa-video"></i> Grabar Video</button>
            
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
            <h3>Estado de Componentes</h3>
            <div class="form-group">
                <label>Aceite de Motor</label>
                <input type="text" class="form-control mb-2" placeholder="Comentario">
                <div>
                    <label><input type="radio" name="oil" value="ok"> <span style="color:green;">Ok</span></label>
                    <label><input type="radio" name="oil" value="suggested"> <span style="color:gold;">Sugerido</span></label>
                    <label><input type="radio" name="oil" value="urgent"> <span style="color:red;">Urgente</span></label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
</body>
</html>
