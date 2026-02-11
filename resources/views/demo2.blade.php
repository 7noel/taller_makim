
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="icon" type="image/jpeg" href="https://speed.tallerpro.net.pe/storage//speed.png" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="Hz7jwdXXmXVGVWGCk4geBhDqQE76Hh5HPNV4qJ5s">

    <title>TALLER</title>
    <style>
        .custom-checkbox {
            margin-right: 2em;
        }
        .ui-autocomplete {
            max-height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 13px;
            text-align: left;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
        }

        .ui-autocomplete > li > div {
            display: block;
            padding: 2px 10px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333333;
            white-space: nowrap;
        }

        .ui-state-hover,
        .ui-state-active,
        .ui-state-focus {
            text-decoration: none;
            color: #262626;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .ui-helper-hidden-accessible {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
        .ui-menu-item div:hover {
            /*background-color: #007bff;*/
            background-color: #17a2b8;
            color: white;
        }
        ul.ui-autocomplete.ui-menu {
          z-index: 1050;
        }
/*        .form-group label{ font-weight:bold; }*/
        .paint-canvas {
          border: 1px black solid;
          display: block;
          margin: 1rem;
        }

        .color-picker {
          margin: 1rem 1rem 0 1rem;
        }
    </style>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Jquery ui js -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <!-- Botones -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Condensed&family=Roboto&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <style>
        .btn-label{
            padding-top: 0;
            padding-bottom: 0;
            margin-top: 0;
            margin-bottom: 0;
        }

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
        body{
            font-family: 'Encode Sans Condensed', sans-serif;
            /*font-family: 'Roboto', sans-serif;*/
            /*font-family: 'Roboto Condensed', sans-serif;*/
        }
        .ui-autocomplete {
            max-height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 13px;
            text-align: left;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
        }

        .ui-autocomplete > li > div {
            display: block;
            padding: 2px 10px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333333;
            white-space: nowrap;
        }

        .ui-state-hover,
        .ui-state-active,
        .ui-state-focus {
            text-decoration: none;
            color: #262626;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .ui-helper-hidden-accessible {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
        .ui-menu-item div:hover {
            /*background-color: #007bff;*/
            background-color: #17a2b8;
            color: white;
        }
        .dataTables_length {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dataTables_length label {
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dataTables_filter label {
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

        /*Para las placas*/
.is-warning {
    border-width: 2px !important;
    border-color: #ff9800 !important;
    background-color: #fffaf0 !important; /* tono ligeramente amarillento */
}

.is-warning:focus {
    border-color: #ff9800 !important;
    box-shadow: 0 0 0 0.25rem rgba(255, 152, 0, 0.5) !important;
}


    </style>
</head>
<body>
    <div id="app">
        
        <script> // variables globales
            let $wrap = $('#clientModal');
            let $btn = $('#btn-crear-cliente');
        </script>
        <main class="py-4">
            <style>
/* El body NO scrollea; solo el contenedor */
html, body { height: 100%; overflow: hidden; margin: 0; }

/* El contenedor que sí scrollea */
#safe-scroll{
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
  overscroll-behavior-y: contain; /* evita pull-to-refresh dentro */
}

/* Opcional: si quieres mantener un padding inferior dentro del scroll */
#safe-scroll { padding-bottom: 1.5rem; } /* similar a .py-4 en Bootstrap */

</style>

<div id="safe-scroll">
  <div id="clienteFields">

<div class="container">
        <a href="/demo3" class="btn btn-outline-info mb-3">Ver Nuevo Formato</a>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body padding-0">
                  <form method="POST" action="https://speed.tallerpro.net.pe/operations/inventory" accept-charset="UTF-8" class="form-loading" enctype="multipart/form-data"><input name="_token" type="hidden" value="Hz7jwdXXmXVGVWGCk4geBhDqQE76Hh5HPNV4qJ5s">
                                <input type="hidden" name="last_page" value="https://speed.tallerpro.net.pe/operations/panel">
                        <style>
/*    .medium-zoom-image {
        max-width: 90vw;
        max-height: 90vh;
        width: auto !important;
        height: auto !important;
        object-fit: contain;
        display: block;
        margin: auto;
    }
    @media (max-width: 768px) {
      .medium-zoom-image {
        max-width: 95vw;
        max-height: 90vh;
      }
    }
*/

    .padding-1 {padding-bottom: 1px; padding-top: 1px;}
    /*.padding-0 { padding-left:0; padding-right:0; }*/
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

<input id="my_company_id" name="my_company" type="hidden" value="1">
<input id="is_downloadable" name="is_downloadable" type="hidden" value="1">
<input id="with_tax" name="with_tax" type="hidden" value="1">
<input id="client_id" name="company_id" type="hidden">
<input id="car_id" name="car_id" type="hidden">
<input id="action" name="action" type="hidden" value="create">

<!-- Checklist -->
<h5><strong>CheckList</strong></h5>
        <div class="form-row">
            <div class="col-sm-12">

                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[0][id]" value="">
                    <input type="hidden" name="order_checklist_details[0][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[0][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[0][checklist_detail_id]" value="1">
                    <input type="hidden" name="order_checklist_details[0][name]" value="PLUMILLAS">
                    <input type="hidden" name="order_checklist_details[0][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[0][category]" value="EXTERIOR">
                    <span class="item-name">PLUMILLAS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[0][status]" id="correcto-0" value="correcto"  required>
                            <label class="form-check-label" for="correcto-0">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[0][status]" id="recomendable-0" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-0">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[0][status]" id="urgente-0" value="urgente"  required>
                            <label class="form-check-label" for="urgente-0">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[0][status]" id="no-aplica-0" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-0">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[0][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[1][id]" value="">
                    <input type="hidden" name="order_checklist_details[1][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[1][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[1][checklist_detail_id]" value="2">
                    <input type="hidden" name="order_checklist_details[1][name]" value="PARABRISA DELANTERO">
                    <input type="hidden" name="order_checklist_details[1][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[1][category]" value="EXTERIOR">
                    <span class="item-name">PARABRISA DELANTERO</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[1][status]" id="correcto-1" value="correcto"  required>
                            <label class="form-check-label" for="correcto-1">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[1][status]" id="recomendable-1" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-1">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[1][status]" id="urgente-1" value="urgente"  required>
                            <label class="form-check-label" for="urgente-1">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[1][status]" id="no-aplica-1" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-1">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[1][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[2][id]" value="">
                    <input type="hidden" name="order_checklist_details[2][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[2][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[2][checklist_detail_id]" value="3">
                    <input type="hidden" name="order_checklist_details[2][name]" value="FARO POSTERIOR">
                    <input type="hidden" name="order_checklist_details[2][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[2][category]" value="EXTERIOR">
                    <span class="item-name">FARO POSTERIOR</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[2][status]" id="correcto-2" value="correcto"  required>
                            <label class="form-check-label" for="correcto-2">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[2][status]" id="recomendable-2" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-2">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[2][status]" id="urgente-2" value="urgente"  required>
                            <label class="form-check-label" for="urgente-2">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[2][status]" id="no-aplica-2" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-2">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[2][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[3][id]" value="">
                    <input type="hidden" name="order_checklist_details[3][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[3][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[3][checklist_detail_id]" value="4">
                    <input type="hidden" name="order_checklist_details[3][name]" value="SEGURO DE AROS">
                    <input type="hidden" name="order_checklist_details[3][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[3][category]" value="EXTERIOR">
                    <span class="item-name">SEGURO DE AROS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[3][status]" id="correcto-3" value="correcto"  required>
                            <label class="form-check-label" for="correcto-3">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[3][status]" id="recomendable-3" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-3">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[3][status]" id="urgente-3" value="urgente"  required>
                            <label class="form-check-label" for="urgente-3">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[3][status]" id="no-aplica-3" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-3">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[3][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[4][id]" value="">
                    <input type="hidden" name="order_checklist_details[4][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[4][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[4][checklist_detail_id]" value="5">
                    <input type="hidden" name="order_checklist_details[4][name]" value="TAPA DE COMBUSTIBLE">
                    <input type="hidden" name="order_checklist_details[4][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[4][category]" value="EXTERIOR">
                    <span class="item-name">TAPA DE COMBUSTIBLE</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[4][status]" id="correcto-4" value="correcto"  required>
                            <label class="form-check-label" for="correcto-4">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[4][status]" id="recomendable-4" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-4">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[4][status]" id="urgente-4" value="urgente"  required>
                            <label class="form-check-label" for="urgente-4">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[4][status]" id="no-aplica-4" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-4">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[4][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[5][id]" value="">
                    <input type="hidden" name="order_checklist_details[5][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[5][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[5][checklist_detail_id]" value="6">
                    <input type="hidden" name="order_checklist_details[5][name]" value="BRAZO DE PLUMILLAS">
                    <input type="hidden" name="order_checklist_details[5][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[5][category]" value="EXTERIOR">
                    <span class="item-name">BRAZO DE PLUMILLAS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[5][status]" id="correcto-5" value="correcto"  required>
                            <label class="form-check-label" for="correcto-5">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[5][status]" id="recomendable-5" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-5">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[5][status]" id="urgente-5" value="urgente"  required>
                            <label class="form-check-label" for="urgente-5">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[5][status]" id="no-aplica-5" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-5">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[5][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[6][id]" value="">
                    <input type="hidden" name="order_checklist_details[6][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[6][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[6][checklist_detail_id]" value="7">
                    <input type="hidden" name="order_checklist_details[6][name]" value="PARABRISA POSTERIOR">
                    <input type="hidden" name="order_checklist_details[6][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[6][category]" value="EXTERIOR">
                    <span class="item-name">PARABRISA POSTERIOR</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[6][status]" id="correcto-6" value="correcto"  required>
                            <label class="form-check-label" for="correcto-6">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[6][status]" id="recomendable-6" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-6">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[6][status]" id="urgente-6" value="urgente"  required>
                            <label class="form-check-label" for="urgente-6">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[6][status]" id="no-aplica-6" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-6">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[6][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[7][id]" value="">
                    <input type="hidden" name="order_checklist_details[7][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[7][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[7][checklist_detail_id]" value="8">
                    <input type="hidden" name="order_checklist_details[7][name]" value="MANIJA EXTERIOR">
                    <input type="hidden" name="order_checklist_details[7][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[7][category]" value="EXTERIOR">
                    <span class="item-name">MANIJA EXTERIOR</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[7][status]" id="correcto-7" value="correcto"  required>
                            <label class="form-check-label" for="correcto-7">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[7][status]" id="recomendable-7" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-7">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[7][status]" id="urgente-7" value="urgente"  required>
                            <label class="form-check-label" for="urgente-7">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[7][status]" id="no-aplica-7" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-7">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[7][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[8][id]" value="">
                    <input type="hidden" name="order_checklist_details[8][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[8][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[8][checklist_detail_id]" value="9">
                    <input type="hidden" name="order_checklist_details[8][name]" value="MOL. PUERTA">
                    <input type="hidden" name="order_checklist_details[8][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[8][category]" value="EXTERIOR">
                    <span class="item-name">MOL. PUERTA</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[8][status]" id="correcto-8" value="correcto"  required>
                            <label class="form-check-label" for="correcto-8">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[8][status]" id="recomendable-8" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-8">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[8][status]" id="urgente-8" value="urgente"  required>
                            <label class="form-check-label" for="urgente-8">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[8][status]" id="no-aplica-8" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-8">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[8][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[9][id]" value="">
                    <input type="hidden" name="order_checklist_details[9][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[9][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[9][checklist_detail_id]" value="10">
                    <input type="hidden" name="order_checklist_details[9][name]" value="LLANTAS">
                    <input type="hidden" name="order_checklist_details[9][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[9][category]" value="EXTERIOR">
                    <span class="item-name">LLANTAS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[9][status]" id="correcto-9" value="correcto"  required>
                            <label class="form-check-label" for="correcto-9">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[9][status]" id="recomendable-9" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-9">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[9][status]" id="urgente-9" value="urgente"  required>
                            <label class="form-check-label" for="urgente-9">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[9][status]" id="no-aplica-9" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-9">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[9][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[10][id]" value="">
                    <input type="hidden" name="order_checklist_details[10][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[10][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[10][checklist_detail_id]" value="11">
                    <input type="hidden" name="order_checklist_details[10][name]" value="ESPEJOS EXTERIORES">
                    <input type="hidden" name="order_checklist_details[10][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[10][category]" value="EXTERIOR">
                    <span class="item-name">ESPEJOS EXTERIORES</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[10][status]" id="correcto-10" value="correcto"  required>
                            <label class="form-check-label" for="correcto-10">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[10][status]" id="recomendable-10" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-10">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[10][status]" id="urgente-10" value="urgente"  required>
                            <label class="form-check-label" for="urgente-10">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[10][status]" id="no-aplica-10" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-10">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[10][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[11][id]" value="">
                    <input type="hidden" name="order_checklist_details[11][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[11][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[11][checklist_detail_id]" value="12">
                    <input type="hidden" name="order_checklist_details[11][name]" value="FARO DELANTERO">
                    <input type="hidden" name="order_checklist_details[11][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[11][category]" value="EXTERIOR">
                    <span class="item-name">FARO DELANTERO</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[11][status]" id="correcto-11" value="correcto"  required>
                            <label class="form-check-label" for="correcto-11">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[11][status]" id="recomendable-11" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-11">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[11][status]" id="urgente-11" value="urgente"  required>
                            <label class="form-check-label" for="urgente-11">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[11][status]" id="no-aplica-11" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-11">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[11][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[12][id]" value="">
                    <input type="hidden" name="order_checklist_details[12][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[12][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[12][checklist_detail_id]" value="13">
                    <input type="hidden" name="order_checklist_details[12][name]" value="NEBLINEROS">
                    <input type="hidden" name="order_checklist_details[12][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[12][category]" value="EXTERIOR">
                    <span class="item-name">NEBLINEROS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[12][status]" id="correcto-12" value="correcto"  required>
                            <label class="form-check-label" for="correcto-12">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[12][status]" id="recomendable-12" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-12">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[12][status]" id="urgente-12" value="urgente"  required>
                            <label class="form-check-label" for="urgente-12">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[12][status]" id="no-aplica-12" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-12">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[12][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[13][id]" value="">
                    <input type="hidden" name="order_checklist_details[13][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[13][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[13][checklist_detail_id]" value="14">
                    <input type="hidden" name="order_checklist_details[13][name]" value="SEGURO DE VASOS">
                    <input type="hidden" name="order_checklist_details[13][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[13][category]" value="EXTERIOR">
                    <span class="item-name">SEGURO DE VASOS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[13][status]" id="correcto-13" value="correcto"  required>
                            <label class="form-check-label" for="correcto-13">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[13][status]" id="recomendable-13" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-13">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[13][status]" id="urgente-13" value="urgente"  required>
                            <label class="form-check-label" for="urgente-13">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[13][status]" id="no-aplica-13" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-13">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[13][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[14][id]" value="">
                    <input type="hidden" name="order_checklist_details[14][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[14][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[14][checklist_detail_id]" value="15">
                    <input type="hidden" name="order_checklist_details[14][name]" value="ANTENA">
                    <input type="hidden" name="order_checklist_details[14][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[14][category]" value="EXTERIOR">
                    <span class="item-name">ANTENA</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[14][status]" id="correcto-14" value="correcto"  required>
                            <label class="form-check-label" for="correcto-14">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[14][status]" id="recomendable-14" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-14">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[14][status]" id="urgente-14" value="urgente"  required>
                            <label class="form-check-label" for="urgente-14">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[14][status]" id="no-aplica-14" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-14">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[14][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[15][id]" value="">
                    <input type="hidden" name="order_checklist_details[15][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[15][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[15][checklist_detail_id]" value="16">
                    <input type="hidden" name="order_checklist_details[15][name]" value="VASO/COPA">
                    <input type="hidden" name="order_checklist_details[15][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[15][category]" value="EXTERIOR">
                    <span class="item-name">VASO/COPA</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[15][status]" id="correcto-15" value="correcto"  required>
                            <label class="form-check-label" for="correcto-15">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[15][status]" id="recomendable-15" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-15">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[15][status]" id="urgente-15" value="urgente"  required>
                            <label class="form-check-label" for="urgente-15">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[15][status]" id="no-aplica-15" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-15">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[15][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[16][id]" value="">
                    <input type="hidden" name="order_checklist_details[16][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[16][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[16][checklist_detail_id]" value="17">
                    <input type="hidden" name="order_checklist_details[16][name]" value="BATERIA">
                    <input type="hidden" name="order_checklist_details[16][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[16][category]" value="MOTOR">
                    <span class="item-name">BATERIA</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[16][status]" id="correcto-16" value="correcto"  required>
                            <label class="form-check-label" for="correcto-16">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[16][status]" id="recomendable-16" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-16">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[16][status]" id="urgente-16" value="urgente"  required>
                            <label class="form-check-label" for="urgente-16">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[16][status]" id="no-aplica-16" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-16">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[16][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[17][id]" value="">
                    <input type="hidden" name="order_checklist_details[17][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[17][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[17][checklist_detail_id]" value="18">
                    <input type="hidden" name="order_checklist_details[17][name]" value="PURIFICADOR">
                    <input type="hidden" name="order_checklist_details[17][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[17][category]" value="MOTOR">
                    <span class="item-name">PURIFICADOR</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[17][status]" id="correcto-17" value="correcto"  required>
                            <label class="form-check-label" for="correcto-17">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[17][status]" id="recomendable-17" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-17">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[17][status]" id="urgente-17" value="urgente"  required>
                            <label class="form-check-label" for="urgente-17">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[17][status]" id="no-aplica-17" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-17">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[17][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[18][id]" value="">
                    <input type="hidden" name="order_checklist_details[18][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[18][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[18][checklist_detail_id]" value="19">
                    <input type="hidden" name="order_checklist_details[18][name]" value="TAPA LIQUI. EMBRAGUE">
                    <input type="hidden" name="order_checklist_details[18][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[18][category]" value="MOTOR">
                    <span class="item-name">TAPA LIQUI. EMBRAGUE</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[18][status]" id="correcto-18" value="correcto"  required>
                            <label class="form-check-label" for="correcto-18">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[18][status]" id="recomendable-18" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-18">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[18][status]" id="urgente-18" value="urgente"  required>
                            <label class="form-check-label" for="urgente-18">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[18][status]" id="no-aplica-18" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-18">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[18][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[19][id]" value="">
                    <input type="hidden" name="order_checklist_details[19][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[19][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[19][checklist_detail_id]" value="20">
                    <input type="hidden" name="order_checklist_details[19][name]" value="TAPA DE RADIADOR">
                    <input type="hidden" name="order_checklist_details[19][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[19][category]" value="MOTOR">
                    <span class="item-name">TAPA DE RADIADOR</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[19][status]" id="correcto-19" value="correcto"  required>
                            <label class="form-check-label" for="correcto-19">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[19][status]" id="recomendable-19" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-19">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[19][status]" id="urgente-19" value="urgente"  required>
                            <label class="form-check-label" for="urgente-19">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[19][status]" id="no-aplica-19" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-19">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[19][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[20][id]" value="">
                    <input type="hidden" name="order_checklist_details[20][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[20][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[20][checklist_detail_id]" value="21">
                    <input type="hidden" name="order_checklist_details[20][name]" value="SOPORTE DE BATERIA">
                    <input type="hidden" name="order_checklist_details[20][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[20][category]" value="MOTOR">
                    <span class="item-name">SOPORTE DE BATERIA</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[20][status]" id="correcto-20" value="correcto"  required>
                            <label class="form-check-label" for="correcto-20">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[20][status]" id="recomendable-20" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-20">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[20][status]" id="urgente-20" value="urgente"  required>
                            <label class="form-check-label" for="urgente-20">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[20][status]" id="no-aplica-20" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-20">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[20][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[21][id]" value="">
                    <input type="hidden" name="order_checklist_details[21][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[21][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[21][checklist_detail_id]" value="22">
                    <input type="hidden" name="order_checklist_details[21][name]" value="TAPA LIQUI. FRENO">
                    <input type="hidden" name="order_checklist_details[21][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[21][category]" value="MOTOR">
                    <span class="item-name">TAPA LIQUI. FRENO</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[21][status]" id="correcto-21" value="correcto"  required>
                            <label class="form-check-label" for="correcto-21">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[21][status]" id="recomendable-21" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-21">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[21][status]" id="urgente-21" value="urgente"  required>
                            <label class="form-check-label" for="urgente-21">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[21][status]" id="no-aplica-21" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-21">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[21][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[22][id]" value="">
                    <input type="hidden" name="order_checklist_details[22][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[22][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[22][checklist_detail_id]" value="23">
                    <input type="hidden" name="order_checklist_details[22][name]" value="TAPA LIQUI. DIRECCION">
                    <input type="hidden" name="order_checklist_details[22][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[22][category]" value="MOTOR">
                    <span class="item-name">TAPA LIQUI. DIRECCION</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[22][status]" id="correcto-22" value="correcto"  required>
                            <label class="form-check-label" for="correcto-22">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[22][status]" id="recomendable-22" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-22">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[22][status]" id="urgente-22" value="urgente"  required>
                            <label class="form-check-label" for="urgente-22">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[22][status]" id="no-aplica-22" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-22">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[22][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[23][id]" value="">
                    <input type="hidden" name="order_checklist_details[23][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[23][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[23][checklist_detail_id]" value="24">
                    <input type="hidden" name="order_checklist_details[23][name]" value="TAPA DE ACEITE">
                    <input type="hidden" name="order_checklist_details[23][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[23][category]" value="MOTOR">
                    <span class="item-name">TAPA DE ACEITE</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[23][status]" id="correcto-23" value="correcto"  required>
                            <label class="form-check-label" for="correcto-23">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[23][status]" id="recomendable-23" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-23">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[23][status]" id="urgente-23" value="urgente"  required>
                            <label class="form-check-label" for="urgente-23">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[23][status]" id="no-aplica-23" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-23">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[23][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[24][id]" value="">
                    <input type="hidden" name="order_checklist_details[24][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[24][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[24][checklist_detail_id]" value="25">
                    <input type="hidden" name="order_checklist_details[24][name]" value="GNV-GLP">
                    <input type="hidden" name="order_checklist_details[24][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[24][category]" value="MOTOR">
                    <span class="item-name">GNV-GLP</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[24][status]" id="correcto-24" value="correcto"  required>
                            <label class="form-check-label" for="correcto-24">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[24][status]" id="recomendable-24" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-24">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[24][status]" id="urgente-24" value="urgente"  required>
                            <label class="form-check-label" for="urgente-24">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[24][status]" id="no-aplica-24" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-24">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[24][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[25][id]" value="">
                    <input type="hidden" name="order_checklist_details[25][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[25][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[25][checklist_detail_id]" value="26">
                    <input type="hidden" name="order_checklist_details[25][name]" value="VARILLA ATM">
                    <input type="hidden" name="order_checklist_details[25][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[25][category]" value="MOTOR">
                    <span class="item-name">VARILLA ATM</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[25][status]" id="correcto-25" value="correcto"  required>
                            <label class="form-check-label" for="correcto-25">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[25][status]" id="recomendable-25" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-25">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[25][status]" id="urgente-25" value="urgente"  required>
                            <label class="form-check-label" for="urgente-25">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[25][status]" id="no-aplica-25" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-25">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[25][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[26][id]" value="">
                    <input type="hidden" name="order_checklist_details[26][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[26][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[26][checklist_detail_id]" value="27">
                    <input type="hidden" name="order_checklist_details[26][name]" value="VARILLA DE ACEITE">
                    <input type="hidden" name="order_checklist_details[26][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[26][category]" value="MOTOR">
                    <span class="item-name">VARILLA DE ACEITE</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[26][status]" id="correcto-26" value="correcto"  required>
                            <label class="form-check-label" for="correcto-26">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[26][status]" id="recomendable-26" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-26">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[26][status]" id="urgente-26" value="urgente"  required>
                            <label class="form-check-label" for="urgente-26">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[26][status]" id="no-aplica-26" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-26">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[26][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[27][id]" value="">
                    <input type="hidden" name="order_checklist_details[27][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[27][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[27][checklist_detail_id]" value="28">
                    <input type="hidden" name="order_checklist_details[27][name]" value="TABLERO">
                    <input type="hidden" name="order_checklist_details[27][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[27][category]" value="INTERIOR">
                    <span class="item-name">TABLERO</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[27][status]" id="correcto-27" value="correcto"  required>
                            <label class="form-check-label" for="correcto-27">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[27][status]" id="recomendable-27" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-27">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[27][status]" id="urgente-27" value="urgente"  required>
                            <label class="form-check-label" for="urgente-27">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[27][status]" id="no-aplica-27" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-27">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[27][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[28][id]" value="">
                    <input type="hidden" name="order_checklist_details[28][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[28][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[28][checklist_detail_id]" value="29">
                    <input type="hidden" name="order_checklist_details[28][name]" value="CENICERO">
                    <input type="hidden" name="order_checklist_details[28][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[28][category]" value="INTERIOR">
                    <span class="item-name">CENICERO</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[28][status]" id="correcto-28" value="correcto"  required>
                            <label class="form-check-label" for="correcto-28">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[28][status]" id="recomendable-28" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-28">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[28][status]" id="urgente-28" value="urgente"  required>
                            <label class="form-check-label" for="urgente-28">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[28][status]" id="no-aplica-28" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-28">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[28][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[29][id]" value="">
                    <input type="hidden" name="order_checklist_details[29][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[29][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[29][checklist_detail_id]" value="30">
                    <input type="hidden" name="order_checklist_details[29][name]" value="CABEZAL DE ASIENTO">
                    <input type="hidden" name="order_checklist_details[29][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[29][category]" value="INTERIOR">
                    <span class="item-name">CABEZAL DE ASIENTO</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[29][status]" id="correcto-29" value="correcto"  required>
                            <label class="form-check-label" for="correcto-29">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[29][status]" id="recomendable-29" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-29">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[29][status]" id="urgente-29" value="urgente"  required>
                            <label class="form-check-label" for="urgente-29">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[29][status]" id="no-aplica-29" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-29">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[29][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[30][id]" value="">
                    <input type="hidden" name="order_checklist_details[30][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[30][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[30][checklist_detail_id]" value="31">
                    <input type="hidden" name="order_checklist_details[30][name]" value="ABRE PUERTAS">
                    <input type="hidden" name="order_checklist_details[30][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[30][category]" value="INTERIOR">
                    <span class="item-name">ABRE PUERTAS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[30][status]" id="correcto-30" value="correcto"  required>
                            <label class="form-check-label" for="correcto-30">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[30][status]" id="recomendable-30" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-30">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[30][status]" id="urgente-30" value="urgente"  required>
                            <label class="form-check-label" for="urgente-30">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[30][status]" id="no-aplica-30" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-30">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[30][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[31][id]" value="">
                    <input type="hidden" name="order_checklist_details[31][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[31][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[31][checklist_detail_id]" value="32">
                    <input type="hidden" name="order_checklist_details[31][name]" value="PISOS SOBRE ALFOMBRAS">
                    <input type="hidden" name="order_checklist_details[31][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[31][category]" value="INTERIOR">
                    <span class="item-name">PISOS SOBRE ALFOMBRAS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[31][status]" id="correcto-31" value="correcto"  required>
                            <label class="form-check-label" for="correcto-31">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[31][status]" id="recomendable-31" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-31">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[31][status]" id="urgente-31" value="urgente"  required>
                            <label class="form-check-label" for="urgente-31">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[31][status]" id="no-aplica-31" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-31">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[31][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[32][id]" value="">
                    <input type="hidden" name="order_checklist_details[32][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[32][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[32][checklist_detail_id]" value="33">
                    <input type="hidden" name="order_checklist_details[32][name]" value="TAPIZ DE ASIENTOS">
                    <input type="hidden" name="order_checklist_details[32][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[32][category]" value="INTERIOR">
                    <span class="item-name">TAPIZ DE ASIENTOS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[32][status]" id="correcto-32" value="correcto"  required>
                            <label class="form-check-label" for="correcto-32">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[32][status]" id="recomendable-32" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-32">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[32][status]" id="urgente-32" value="urgente"  required>
                            <label class="form-check-label" for="urgente-32">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[32][status]" id="no-aplica-32" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-32">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[32][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[33][id]" value="">
                    <input type="hidden" name="order_checklist_details[33][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[33][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[33][checklist_detail_id]" value="34">
                    <input type="hidden" name="order_checklist_details[33][name]" value="ENCENDEDOR">
                    <input type="hidden" name="order_checklist_details[33][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[33][category]" value="INTERIOR">
                    <span class="item-name">ENCENDEDOR</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[33][status]" id="correcto-33" value="correcto"  required>
                            <label class="form-check-label" for="correcto-33">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[33][status]" id="recomendable-33" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-33">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[33][status]" id="urgente-33" value="urgente"  required>
                            <label class="form-check-label" for="urgente-33">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[33][status]" id="no-aplica-33" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-33">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[33][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[34][id]" value="">
                    <input type="hidden" name="order_checklist_details[34][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[34][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[34][checklist_detail_id]" value="35">
                    <input type="hidden" name="order_checklist_details[34][name]" value="RADIO">
                    <input type="hidden" name="order_checklist_details[34][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[34][category]" value="INTERIOR">
                    <span class="item-name">RADIO</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[34][status]" id="correcto-34" value="correcto"  required>
                            <label class="form-check-label" for="correcto-34">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[34][status]" id="recomendable-34" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-34">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[34][status]" id="urgente-34" value="urgente"  required>
                            <label class="form-check-label" for="urgente-34">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[34][status]" id="no-aplica-34" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-34">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[34][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[35][id]" value="">
                    <input type="hidden" name="order_checklist_details[35][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[35][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[35][checklist_detail_id]" value="36">
                    <input type="hidden" name="order_checklist_details[35][name]" value="ALZA LUNAS">
                    <input type="hidden" name="order_checklist_details[35][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[35][category]" value="INTERIOR">
                    <span class="item-name">ALZA LUNAS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[35][status]" id="correcto-35" value="correcto"  required>
                            <label class="form-check-label" for="correcto-35">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[35][status]" id="recomendable-35" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-35">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[35][status]" id="urgente-35" value="urgente"  required>
                            <label class="form-check-label" for="urgente-35">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[35][status]" id="no-aplica-35" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-35">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[35][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[36][id]" value="">
                    <input type="hidden" name="order_checklist_details[36][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[36][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[36][checklist_detail_id]" value="37">
                    <input type="hidden" name="order_checklist_details[36][name]" value="TAPASOL">
                    <input type="hidden" name="order_checklist_details[36][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[36][category]" value="INTERIOR">
                    <span class="item-name">TAPASOL</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[36][status]" id="correcto-36" value="correcto"  required>
                            <label class="form-check-label" for="correcto-36">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[36][status]" id="recomendable-36" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-36">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[36][status]" id="urgente-36" value="urgente"  required>
                            <label class="form-check-label" for="urgente-36">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[36][status]" id="no-aplica-36" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-36">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[36][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[37][id]" value="">
                    <input type="hidden" name="order_checklist_details[37][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[37][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[37][checklist_detail_id]" value="38">
                    <input type="hidden" name="order_checklist_details[37][name]" value="TAPIZ DE PUERTA">
                    <input type="hidden" name="order_checklist_details[37][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[37][category]" value="INTERIOR">
                    <span class="item-name">TAPIZ DE PUERTA</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[37][status]" id="correcto-37" value="correcto"  required>
                            <label class="form-check-label" for="correcto-37">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[37][status]" id="recomendable-37" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-37">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[37][status]" id="urgente-37" value="urgente"  required>
                            <label class="form-check-label" for="urgente-37">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[37][status]" id="no-aplica-37" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-37">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[37][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[38][id]" value="">
                    <input type="hidden" name="order_checklist_details[38][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[38][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[38][checklist_detail_id]" value="39">
                    <input type="hidden" name="order_checklist_details[38][name]" value="ESPEJOS INTERIORES">
                    <input type="hidden" name="order_checklist_details[38][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[38][category]" value="INTERIOR">
                    <span class="item-name">ESPEJOS INTERIORES</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[38][status]" id="correcto-38" value="correcto"  required>
                            <label class="form-check-label" for="correcto-38">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[38][status]" id="recomendable-38" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-38">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[38][status]" id="urgente-38" value="urgente"  required>
                            <label class="form-check-label" for="urgente-38">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[38][status]" id="no-aplica-38" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-38">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[38][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[39][id]" value="">
                    <input type="hidden" name="order_checklist_details[39][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[39][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[39][checklist_detail_id]" value="40">
                    <input type="hidden" name="order_checklist_details[39][name]" value="RELOJ">
                    <input type="hidden" name="order_checklist_details[39][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[39][category]" value="INTERIOR">
                    <span class="item-name">RELOJ</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[39][status]" id="correcto-39" value="correcto"  required>
                            <label class="form-check-label" for="correcto-39">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[39][status]" id="recomendable-39" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-39">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[39][status]" id="urgente-39" value="urgente"  required>
                            <label class="form-check-label" for="urgente-39">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[39][status]" id="no-aplica-39" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-39">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[39][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[40][id]" value="">
                    <input type="hidden" name="order_checklist_details[40][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[40][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[40][checklist_detail_id]" value="41">
                    <input type="hidden" name="order_checklist_details[40][name]" value="CLAXON">
                    <input type="hidden" name="order_checklist_details[40][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[40][category]" value="INTERIOR">
                    <span class="item-name">CLAXON</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[40][status]" id="correcto-40" value="correcto"  required>
                            <label class="form-check-label" for="correcto-40">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[40][status]" id="recomendable-40" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-40">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[40][status]" id="urgente-40" value="urgente"  required>
                            <label class="form-check-label" for="urgente-40">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[40][status]" id="no-aplica-40" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-40">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[40][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[41][id]" value="">
                    <input type="hidden" name="order_checklist_details[41][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[41][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[41][checklist_detail_id]" value="42">
                    <input type="hidden" name="order_checklist_details[41][name]" value="CODERAS">
                    <input type="hidden" name="order_checklist_details[41][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[41][category]" value="INTERIOR">
                    <span class="item-name">CODERAS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[41][status]" id="correcto-41" value="correcto"  required>
                            <label class="form-check-label" for="correcto-41">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[41][status]" id="recomendable-41" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-41">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[41][status]" id="urgente-41" value="urgente"  required>
                            <label class="form-check-label" for="urgente-41">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[41][status]" id="no-aplica-41" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-41">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[41][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[42][id]" value="">
                    <input type="hidden" name="order_checklist_details[42][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[42][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[42][checklist_detail_id]" value="43">
                    <input type="hidden" name="order_checklist_details[42][name]" value="ALARMA">
                    <input type="hidden" name="order_checklist_details[42][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[42][category]" value="INTERIOR">
                    <span class="item-name">ALARMA</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[42][status]" id="correcto-42" value="correcto"  required>
                            <label class="form-check-label" for="correcto-42">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[42][status]" id="recomendable-42" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-42">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[42][status]" id="urgente-42" value="urgente"  required>
                            <label class="form-check-label" for="urgente-42">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[42][status]" id="no-aplica-42" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-42">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[42][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[43][id]" value="">
                    <input type="hidden" name="order_checklist_details[43][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[43][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[43][checklist_detail_id]" value="44">
                    <input type="hidden" name="order_checklist_details[43][name]" value="ALFOMBRA EN MALETERA">
                    <input type="hidden" name="order_checklist_details[43][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[43][category]" value="HERRAMIENTAS/EMERGENCIA">
                    <span class="item-name">ALFOMBRA EN MALETERA</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[43][status]" id="correcto-43" value="correcto"  required>
                            <label class="form-check-label" for="correcto-43">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[43][status]" id="recomendable-43" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-43">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[43][status]" id="urgente-43" value="urgente"  required>
                            <label class="form-check-label" for="urgente-43">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[43][status]" id="no-aplica-43" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-43">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[43][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[44][id]" value="">
                    <input type="hidden" name="order_checklist_details[44][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[44][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[44][checklist_detail_id]" value="45">
                    <input type="hidden" name="order_checklist_details[44][name]" value="GATA">
                    <input type="hidden" name="order_checklist_details[44][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[44][category]" value="MOTOR">
                    <span class="item-name">GATA</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[44][status]" id="correcto-44" value="correcto"  required>
                            <label class="form-check-label" for="correcto-44">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[44][status]" id="recomendable-44" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-44">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[44][status]" id="urgente-44" value="urgente"  required>
                            <label class="form-check-label" for="urgente-44">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[44][status]" id="no-aplica-44" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-44">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[44][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[45][id]" value="">
                    <input type="hidden" name="order_checklist_details[45][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[45][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[45][checklist_detail_id]" value="46">
                    <input type="hidden" name="order_checklist_details[45][name]" value="PALANCA DE GATA
">
                    <input type="hidden" name="order_checklist_details[45][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[45][category]" value="HERRAMIENTAS/EMERGENCIA">
                    <span class="item-name">PALANCA DE GATA
</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[45][status]" id="correcto-45" value="correcto"  required>
                            <label class="form-check-label" for="correcto-45">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[45][status]" id="recomendable-45" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-45">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[45][status]" id="urgente-45" value="urgente"  required>
                            <label class="form-check-label" for="urgente-45">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[45][status]" id="no-aplica-45" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-45">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[45][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[46][id]" value="">
                    <input type="hidden" name="order_checklist_details[46][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[46][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[46][checklist_detail_id]" value="47">
                    <input type="hidden" name="order_checklist_details[46][name]" value="HERRAMIENTAS">
                    <input type="hidden" name="order_checklist_details[46][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[46][category]" value="HERRAMIENTAS/EMERGENCIA">
                    <span class="item-name">HERRAMIENTAS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[46][status]" id="correcto-46" value="correcto"  required>
                            <label class="form-check-label" for="correcto-46">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[46][status]" id="recomendable-46" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-46">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[46][status]" id="urgente-46" value="urgente"  required>
                            <label class="form-check-label" for="urgente-46">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[46][status]" id="no-aplica-46" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-46">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[46][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[47][id]" value="">
                    <input type="hidden" name="order_checklist_details[47][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[47][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[47][checklist_detail_id]" value="48">
                    <input type="hidden" name="order_checklist_details[47][name]" value="LLAVE DE RUEDAS">
                    <input type="hidden" name="order_checklist_details[47][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[47][category]" value="HERRAMIENTAS/EMERGENCIA">
                    <span class="item-name">LLAVE DE RUEDAS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[47][status]" id="correcto-47" value="correcto"  required>
                            <label class="form-check-label" for="correcto-47">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[47][status]" id="recomendable-47" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-47">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[47][status]" id="urgente-47" value="urgente"  required>
                            <label class="form-check-label" for="urgente-47">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[47][status]" id="no-aplica-47" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-47">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[47][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[48][id]" value="">
                    <input type="hidden" name="order_checklist_details[48][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[48][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[48][checklist_detail_id]" value="49">
                    <input type="hidden" name="order_checklist_details[48][name]" value="EXTINGUIDOR">
                    <input type="hidden" name="order_checklist_details[48][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[48][category]" value="HERRAMIENTAS/EMERGENCIA">
                    <span class="item-name">EXTINGUIDOR</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[48][status]" id="correcto-48" value="correcto"  required>
                            <label class="form-check-label" for="correcto-48">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[48][status]" id="recomendable-48" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-48">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[48][status]" id="urgente-48" value="urgente"  required>
                            <label class="form-check-label" for="urgente-48">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[48][status]" id="no-aplica-48" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-48">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[48][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[49][id]" value="">
                    <input type="hidden" name="order_checklist_details[49][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[49][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[49][checklist_detail_id]" value="50">
                    <input type="hidden" name="order_checklist_details[49][name]" value="TRIANGULO">
                    <input type="hidden" name="order_checklist_details[49][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[49][category]" value="HERRAMIENTAS/EMERGENCIA">
                    <span class="item-name">TRIANGULO</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[49][status]" id="correcto-49" value="correcto"  required>
                            <label class="form-check-label" for="correcto-49">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[49][status]" id="recomendable-49" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-49">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[49][status]" id="urgente-49" value="urgente"  required>
                            <label class="form-check-label" for="urgente-49">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[49][status]" id="no-aplica-49" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-49">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[49][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[50][id]" value="">
                    <input type="hidden" name="order_checklist_details[50][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[50][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[50][checklist_detail_id]" value="51">
                    <input type="hidden" name="order_checklist_details[50][name]" value="COCODRILOS">
                    <input type="hidden" name="order_checklist_details[50][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[50][category]" value="HERRAMIENTAS/EMERGENCIA">
                    <span class="item-name">COCODRILOS</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[50][status]" id="correcto-50" value="correcto"  required>
                            <label class="form-check-label" for="correcto-50">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[50][status]" id="recomendable-50" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-50">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[50][status]" id="urgente-50" value="urgente"  required>
                            <label class="form-check-label" for="urgente-50">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[50][status]" id="no-aplica-50" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-50">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[50][comment]" value="" placeholder="">
                </div>
                                            <div class="checklist-item">
                    <input type="hidden" name="order_checklist_details[51][id]" value="">
                    <input type="hidden" name="order_checklist_details[51][order_id]" value="">
                    <input type="hidden" name="order_checklist_details[51][checklist_id]" value="1">
                    <input type="hidden" name="order_checklist_details[51][checklist_detail_id]" value="52">
                    <input type="hidden" name="order_checklist_details[51][name]" value="LLANTA DE REPUESTO">
                    <input type="hidden" name="order_checklist_details[51][type]" value="INVENTARIO">
                    <input type="hidden" name="order_checklist_details[51][category]" value="HERRAMIENTAS/EMERGENCIA">
                    <span class="item-name">LLANTA DE REPUESTO</span>
                    <div class="options">
                        <div class="form-check radio-green">
                            <input class="form-check-input" type="radio" name="order_checklist_details[51][status]" id="correcto-51" value="correcto"  required>
                            <label class="form-check-label" for="correcto-51">Bueno</label>
                        </div>
                        <div class="form-check radio-amber">
                            <input class="form-check-input" type="radio" name="order_checklist_details[51][status]" id="recomendable-51" value="recomendable"  required>
                            <label class="form-check-label" for="recomendable-51">Regular</label>
                        </div>
                        <div class="form-check radio-red">
                            <input class="form-check-input" type="radio" name="order_checklist_details[51][status]" id="urgente-51" value="urgente"  required>
                            <label class="form-check-label" for="urgente-51">Malo</label>
                        </div>
                        <div class="form-check radio-black">
                            <input class="form-check-input" type="radio" name="order_checklist_details[51][status]" id="no-aplica-51" value="no_aplica"  required>
                            <label class="form-check-label" for="no-aplica-51">No Aplica</label>
                        </div>
                    </div>
                    <input class="form-control form-control-sm comment" type="text" name="order_checklist_details[51][comment]" value="" placeholder="">
                </div>
                        </div>
        </div>
        <div class="form-row">
            <div class="col-sm-12">
                <div id="field_comment" class="form-group">
    <label for="comment">
        Comentarios:
    </label>
    <input class="form-control form-control-sm text-uppercase" id="comment" name="comment" type="text">
</div>

            </div>
        </div>

<br>


<!-- <script src="https://cdn.jsdelivr.net/npm/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script> -->


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
                loadImage("/img/inv-sedan.jpg");
                
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
    $('#btnConfirmCrearCar').on('click', function () {
        $('#confirmCrearCar').modal('hide');
        $('#link-crear-car').trigger('click'); // simula el click
        // $('#txtplaca').focus()
    });
    // Button trigger modal
    var boton_car = `<button type="button" class="btn btn-sm btn-link btn-label" data-toggle="modal" data-target="#carModal" id="link-crear-car">[[ Nuevo ]]</button>`;
    // Insertamos el botón justo después del <span> dentro del label
    $('label[for="placa"] span').after(boton_car)
    $('.crear_inventario').addClass('d-none')

  setTimeout(function() {
      removeRequiredCliente('#carModal');
  }, 200)

  // Cuando se abre el modal: restaurar required
  $('#carModal').on('show.bs.modal', function () {
    restoreRequiredCliente('#carModal');
  });

  // Cuando se cierra el modal: quitar required otra vez
  $('#carModal').on('hidden.bs.modal', function () {
    removeRequiredCliente('#carModal');
  });

    $("#link-crear-car").click(function(e){
        resetFields('#carModal', ['my_company', 'txtplaca']);
        setTimeout(function() {
            if ($('#txtplaca').val()=='') {
                $('#txtplaca').focus()
            } else {
                $('#txtCompany').focus()
            }
        }, 500)

    })
    $("#btn-crear-car").click(function(e){
        crearCar()
    })


    // mediumZoom('#selectedImage', {
    //   margin: 24,
    //   background: '#000'
    // });


        let imageCount = 0;
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
                            url: "https://speed.tallerpro.net.pe/upload-photo",
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
  function crearCar() {
    $wrap = $('#carModal');
    $btn = $('#btn-crear-car');

    if (!validateContainer()) return;

    const payload = collectData();

    console.log(payload)
    $.ajax({
      url: "https://speed.tallerpro.net.pe/crear-car", // <- tu endpoint
      method: 'GET',
      data: payload,
      dataType: 'json',
      beforeSend: function () {
        $btn.prop('disabled', true);
      },
      success: function (res) {
        alert(res.message || 'Guardado con éxito');
        console.log(res)
        data = res.data.model
        $('#carModal').modal('hide')
        // console.log(data.company.company_name)
        $('#placa').val(data.placa)
        $('#car_id').val(data.id)
        $('#client_id').val(data.company_id)
        // $('#my_company').val(data.my_company)
        $('#txtbrand').val(data.modelo.brand.name)
        $('#txtmodelo').val(data.modelo.name)
        $('#txtyear').val(data.year)
        $('#txtcolor').val(data.color)
        $('#txtvin').val(data.vin)
        $('#txtcompany_name').val(data.company.company_name)
        $('#txtdoc').val(data.company.doc)
        $('#txtphone').val(data.company.phone)
        $('#txtmobile').val(data.company.mobile)
        $('#txtemail').val(data.company.email)
        $('#inventory_contact_name').val(data.contact_name)
        $('#inventory_contact_mobile').val(data.contact_mobile)
        $('#inventory_contact_email').val(data.contact_email)
        $('#inventory_driver_name').val(data.driver_name)
        $('#inventory_driver_mobile').val(data.driver_mobile)
        $('#inventory_driver_email').val(data.driver_email)
        $('#inventory_operator_company').val(data.operator_company)
        $('#inventory_operator_name').val(data.operator_name)
        $('#inventory_operator_mobile').val(data.operator_mobile)
        $('#inventory_combustible').focus()
        // aquí puedes limpiar, cerrar modal, recargar tabla, etc.
        // Object.keys(payload).forEach(n => $wrap.find(`[name="${n}"]`).val(''));
      },
      error: function (xhr) {
        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
          // pintar errores de Laravel por campo
          const errors = xhr.responseJSON.errors;
          Object.keys(errors).forEach(function (name) {
            const $field = $wrap.find('[name="'+name+'"]');
            if ($field.length) setFieldValidity($field, errors[name][0]);
          });
          const $firstInvalid = $wrap.find('.is-invalid').first();
          $firstInvalid.length && $firstInvalid.focus();
        } else {
          alert('Error del servidor. Intenta nuevamente.');
        }
      },
      complete: function () {
        $btn.prop('disabled', false);
      }
    });
  }

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
                        <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-outline-success force-leave" id="submit"><i class="far fa-save"></i> Crear Inventario</button>
              </div>
            </div>
                      </form>
        </div>
      </div>
        </div>
  </div>
</div>

  <!-- Modal Car -->
<div class="modal fade" id="carModal" tabindex="-1" aria-labelledby="carModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carModalLabel">Crear Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Modelo -->
<!-- <div class="modal fade" id="modeloModal" tabindex="-1" aria-labelledby="modeloModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modeloModalLabel">Crear Modelo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="hidden" id="marca_id">
          <label for="marca" class="col-form-label-sm">Marca: </label>
        </div>
        <div class="form-group">
          <label for="modelo" class="col-form-label-sm">Modelo</label>
          <input type="text" class="form-control form-control-sm" id="modelo">
          <div id="modeloFeedback" class="invalid-feedback">Esta modelo ya existe</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-crear-modelo">Grabar Modelo</button>
      </div>
    </div>
  </div>
</div> -->

<input id="my_company" name="my_company" type="hidden" value="1">
<input id="company_id" name="company_id" type="hidden">
  <input name="slug" type="hidden" value="24">
<div class="form-row">
  <div class="col-sm-2">
    <div id="field_txtplaca" class="form-group">
    <label for="txtplaca">
        Placa
        <span class="badge badge-info">!</span>
    </label>
    <input id="txtplaca" class="form-control form-control-sm text-uppercase" required maxlength="7" name="placa" type="text">
</div>

  </div>
  <div class="col-sm-4">
        <div id="field_txtCompany" class="form-group">
    <label for="txtCompany">
        Cliente
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm text-uppercase" required id="txtCompany" name="txtCompany" type="text">
</div>

      </div>
  <div class="col-sm-2">
    <div id="field_brand_id" class="form-group">
    <label for="brand_id">
        Marca
        <span class="badge badge-info">!</span>
    </label>
    <select class="form-control form-control-sm" required id="brand_id" name="brand_id"><option value="" selected="selected">Seleccionar</option><option value="3">BMW</option><option value="25">CHEVROLET</option><option value="19">CITROEN</option><option value="2">CREVROLET</option><option value="16">DFSK</option><option value="28">FORD</option><option value="18">FOTON</option><option value="10">FUSO</option><option value="24">GREAT WALL</option><option value="22">HINO</option><option value="1">HONDA</option><option value="13">HYUNDAI</option><option value="14">INTERNATIONAL</option><option value="15">ISUZU</option><option value="8">JAC</option><option value="20">JEEP</option><option value="5">KIA</option><option value="9">MAZDA</option><option value="11">MERCEDES BENZ</option><option value="27">MITSUBISHI</option><option value="6">NISSAN</option><option value="26">PEUGEOT</option><option value="23">SCANIA</option><option value="12">SHACMAN</option><option value="4">SUBARU</option><option value="17">TOYOTA</option><option value="7">VOLKS WAGEN</option><option value="21">VOLVO</option><option value="29">YAMAHA</option></select>
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_modelo_id" class="form-group">
    <label for="modelo_id">
        Modelo
        <span class="badge badge-info">!</span>
    </label>
    <select empty="Seleccionar" class="form-control form-control-sm" required id="modelo_id" name="modelo_id"></select>
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_body" class="form-group">
    <label for="body">
        Tipo
        <span class="badge badge-info">!</span>
    </label>
    <select class="form-control form-control-sm" required id="body" name="body"><option value="" selected="selected">Seleccionar</option><option value="COMPACT / HATCHBACK">COMPACT / HATCHBACK</option><option value="COUPE">COUPE</option><option value="OFF-ROAD">OFF-ROAD</option><option value="OTRO">OTRO</option><option value="PICKUP">PICKUP</option><option value="SEDAN">SEDAN</option><option value="STATION WAGON">STATION WAGON</option><option value="SUV">SUV</option><option value="VAN">VAN</option></select>
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_color" class="form-group">
    <label for="color">
        Color
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm text-uppercase" required id="color" name="color" type="text">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_vin" class="form-group">
    <label for="vin">
        VIN
    </label>
    <input class="form-control form-control-sm text-uppercase" maxlength="17" id="vin" name="vin" type="text">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_motor" class="form-group">
    <label for="motor">
        Nro Motor
    </label>
    <input class="form-control form-control-sm text-uppercase" id="motor" name="motor" type="text">
</div>

  </div>
  <div class="col-sm-2 d-none">
    <div id="field_codigo" class="form-group">
    <label for="codigo">
        Codigo
    </label>
    <input class="form-control form-control-sm text-uppercase" id="codigo" name="codigo" type="text">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_year" class="form-group">
    <label for="year">
        Año
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm text-uppercase" required id="year" name="year" type="text">
</div>

  </div>
  <div class="col-sm-2 d-none">
    <div id="field_f_next-pr" class="form-group">
    <label for="f_next-pr">
        Prox_Preventivo
    </label>
    <input class="form-control form-control-sm text-uppercase" id="f_next-pr" name="f_next-pr" type="date">
</div>

  </div>
  <div class="col-sm-2 d-none">
    <div id="field_f_revision" class="form-group">
    <label for="f_revision">
        Prox_Rev_Tec
    </label>
    <input class="form-control form-control-sm text-uppercase" id="f_revision" name="f_revision" type="date">
</div>

  </div>
  
</div>
<div class="form-row contact">
  <div class="col-md-2 col-sm-4">
    <div id="field_contact_name" class="form-group">
    <label for="contact_name">
        Contacto Nombre
    </label>
    <input class="form-control form-control-sm text-uppercase" id="contact_name" name="contact_name" type="text">
</div>

  </div>
  <div class="col-md-2 col-sm-4">
    <div id="field_contact_mobile" class="form-group">
    <label for="contact_mobile">
        Contacto Celular
    </label>
    <input class="form-control form-control-sm text-uppercase" id="contact_mobile" name="contact_mobile" type="text">
</div>

  </div>
  <div class="col-md-2 col-sm-4">
    <div id="field_contact_email" class="form-group">
    <label for="contact_email">
        Contacto Email
    </label>
    <input class="form-control form-control-sm" id="contact_email" name="contact_email" type="email">
</div>

  </div>
  <div class="col-md-2 col-sm-4">
    <div id="field_driver_name" class="form-group">
    <label for="driver_name">
        Conductor Nombre
    </label>
    <input class="form-control form-control-sm text-uppercase" id="driver_name" name="driver_name" type="text">
</div>

  </div>
  <div class="col-md-2 col-sm-4">
    <div id="field_driver_mobile" class="form-group">
    <label for="driver_mobile">
        Conductor Celular
    </label>
    <input class="form-control form-control-sm text-uppercase" id="driver_mobile" name="driver_mobile" type="text">
</div>

  </div>
  <div class="col-md-2 col-sm-4">
    <div id="field_driver_email" class="form-group">
    <label for="driver_email">
        Conductor Email
    </label>
    <input class="form-control form-control-sm" id="driver_email" name="driver_email" type="email">
</div>

  </div>
  <div class="col-md-2 col-sm-4">
    <div id="field_operator_company" class="form-group">
    <label for="operator_company">
        Operador Empresa
    </label>
    <input class="form-control form-control-sm" id="operator_company" name="operator_company" type="email">
</div>

  </div>
  <div class="col-md-2 col-sm-4">
    <div id="field_operator_name" class="form-group">
    <label for="operator_name">
        Operador Contacto
    </label>
    <input class="form-control form-control-sm text-uppercase" id="operator_name" name="operator_name" type="text">
</div>

  </div>
  <div class="col-md-2 col-sm-4">
    <div id="field_operator_mobile" class="form-group">
    <label for="operator_mobile">
        Operador Celular
    </label>
    <input class="form-control form-control-sm text-uppercase" id="operator_mobile" name="operator_mobile" type="text">
</div>

  </div>
</div>

<div class="form-row mb-3 crear_inventario">
  <div class="col-sm-2">
    <div class="custom-control custom-switch">
      <input class="custom-control-input" id="crear_ingreso" checked="checked" name="crear_ingreso" type="checkbox" value="on">
      <label class="custom-control-label" for="crear_ingreso">Crear Recepción</label>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  // Al inicio (modal cerrado): sin required
  setTimeout(function() {
      removeRequiredCliente('#clientModal');
  }, 1000)

  // Cuando se abre el modal: restaurar required
  $('#clientModal').on('show.bs.modal', function () {
    restoreRequiredCliente('#clientModal');
  });

  // Cuando se cierra el modal: quitar required otra vez
  $('#clientModal').on('hidden.bs.modal', function () {
    removeRequiredCliente('#clientModal');
  });

    const $name = $('#txtCompany');     // tu input de texto
    const $id   = $('#company_id');     // hidden con el id

    // Guarda el valor válido inicial
    $name.data('lastLabel', $name.val() || '');
    $name.data('lastId', $id.val() || '');

    // Cuando selecciona desde el autocomplete: fija el nuevo valor válido
    $name.on('autocompleteselect', function (e, ui) {
        $name.val(ui.item.value);
        $id.val(ui.item.id);

        // Actualiza último válido
        $name.data('lastLabel', ui.item.value);
        $name.data('lastId', ui.item.id);
        $(this).removeClass('is-invalid')
        $(this).prev().removeClass('text-danger')
    });

    // Si sale del input y NO hubo selección válida, restaurar
    $name.on('autocompletechange', function (e, ui) {
        if (!ui.item) {
            // No seleccionó un ítem del autocomplete
            $name.val($name.data('lastLabel') || '');
            $id.val($name.data('lastId') || '');
            if ($name.data('lastId')=='') {
              $(this).addClass('is-invalid')
              $(this).prev().addClass('text-danger')
            }
        }
    });

    // Definimos el HTML del botón
  // Button trigger modal
  var boton_marca = `<button type="button" class="btn btn-sm btn-link btn-label" data-toggle="modal" data-target="#marcaModal" id="link-crear-marca">[[ Nuevo ]]</button>`;
    var boton_modelo = `
        <button type="button" class="btn btn-sm btn-link d-none btn-label" data-toggle="modal" data-target="#marcaModal" id="link-crear-modelo">[[ Nuevo ]]</button>
    `;
    var boton_cliente = `<button type="button" class="btn btn-sm btn-link btn-label" data-toggle="modal" data-target="#clientModal" id="link-crear-cliente">[[ Nuevo ]]</button>`;
    // Insertamos el botón justo después del <span> dentro del label
    $('label[for="brand_id"] span').after(boton_marca)
    $('label[for="modelo_id"] span').after(boton_modelo)
    $('label[for="txtCompany"] span').after(boton_cliente)
    $('.aseguradora').addClass('d-none')
    $('.crear_vehiculo').addClass('d-none')


    $('#doc, #id_type').change(function(){
      client_exist()
    })

    //carga modelos
    $('#brand_id').change(function(){
        if ($('#brand_id').val()=='') {
            $('#link-crear-marca').removeClass('d-none')
            $('#link-crear-modelo').addClass('d-none')
        } else {
            $('#link-crear-marca').addClass('d-none')
            $('#link-crear-modelo').removeClass('d-none')
        }
        cargaModelos()
    })

    $("#btn-crear-marca").click(function(e){
        crearMarcaYModelo()
    })

    $("#link-crear-cliente").click(function(e){
      resetFields('#clientModal');
    })
    $("#btn-crear-cliente").click(function(e){
        crearCliente()
    })
    
    $('#link-crear-marca').click(function (e) {
        clearModalMarcaYModelo();
        setTimeout(function() {
            $('#marca').focus();
        }, 500)
    })
    $('#link-crear-modelo').click(function (e) {
        clearModalMarcaYModelo()
        $('#marca_id').val($('#brand_id').val())
        $('#marca').val($('#brand_id option:selected').text())
        $('#marca').prop('readonly', true);
        $('#modelo_name').focus();
    })
})

function client_exist() {
  $id_type = $('#id_type').val()
  $doc = $('#doc').val()
  $entity_type = 'clients'
    page = '/clients/ajax-list'
    if ($id_type!='' && $doc!='') {
      $.get(page, {id_type: $id_type, doc: $doc, entity_type: $entity_type}, function(data){
        if (data!='') { // si existe cliente
        $('#doc').parent().find('label').addClass('text-danger')
        $('#doc').addClass('is-invalid')
        $('#doc').parent().append('<div class="invalid-feedback">Este cliente ya existe</div>')
        $('#btn-crear-cliente').prop('disabled', true)
        } else { // si no existe cliente
        $('#doc').parent().find('label').removeClass('text-danger')
        $('#doc').removeClass('is-invalid')
        $('#doc').parent().find('.invalid-feedback').remove()
        $('#btn-crear-cliente').prop('disabled', false)
        }
      })
    }
}

function clearModalMarcaYModelo() {
    $('#marca_id').val('')
    $('#marca').removeClass('is-invalid')
    $('#marca').val('')
    $('#marca').prop('readonly', false)
    $('#modelo_name').removeClass('is-invalid')
    $('#modelo_name').val('')
}

function crearMarcaYModelo() {
    var $marca_id = $('#marca_id').val().trim()
    var $marca = $('#marca').val().trim()
    var $modelo = $('#modelo_name').val().trim()
    if ($marca=='') {
        $('#marca').addClass('is-invalid')
        $('#marcaFeedback').text('La Marca es obligatoria')
        return false
    } else {
        $('#marca').removeClass('is-invalid')
    }
    if ($modelo=='') {
        $('#modelo_name').addClass('is-invalid')
        $('#modeloNameFeedback').text('El Modelo es obligatorio')
        return false
    } else {
        $('#modelo_name').removeClass('is-invalid')
    }
    page = '/crear-marca'
    $.get(page, {brand_id: $marca_id, marca: $marca, modelo: $modelo}, function(data){
        if (data.error!=undefined) {
            if(data.error.marca!=undefined) {
                $('#marca').addClass('is-invalid')
                $('#marcaFeedback').text(data.error.marca)
                $('#modelo_name').removeClass('is-invalid')
            }
            if(data.error.modelo!=undefined) {
                $('#modelo_name').removeClass('is-invalid')
                $('#marcaFeedback').text(data.error.modelo)
                $('#modelo_name').addClass('is-invalid')
            }
        } else {
            $('#marca').removeClass('is-invalid')
            $('#modelo_name').removeClass('is-invalid')
            cargaMarcas(data.marca.id, data.modelo.id)
            //$('#brand_id').val(data.marca.id)
            //cargaModelos(data.modelo.id)
            //$('#modelo_id').val(data.modelo.id)
            $('#marcaModal').modal('hide')
        }
    })
}

/*cargar marcas*/
function cargaMarcas(id='', modelo_id=''){
    var $marcas = $('#brand_id')
    var $modelos=$('#modelo_id')
    var page = "/listarMarcas"
    $.get(page, function(data){
        $marcas.empty()
        $modelos.empty()
        $marcas.append("<option value=''>Seleccionar</option>");
        $.each(data, function (index, ModeloObj) {
            $marcas.append("<option value='"+ModeloObj.id+"'>"+ModeloObj.name+"</option>")
        })
        $('#brand_id').val(id)
        cargaModelos(modelo_id)
    })
}

/*cargar modelos*/
function cargaModelos(id=''){
    var $marca = $('#brand_id')
    var $modelos=$('#modelo_id')
    var page = "/listarModelos/" + $marca.val()
    if ($marca.val() == '') {
        $modelos.empty("")
    } else {
        $.get(page, function(data){
            $modelos.empty()
            $modelos.append("<option value=''>Seleccionar</option>");
            $.each(data, function (index, ModeloObj) {
                $modelos.append("<option value='"+ModeloObj.id+"'>"+ModeloObj.name+"</option>")
            })
            $('#modelo_id').val(id)
        })

    }
}

// Quita 'required' de todos los campos dentro de #clientModal.
// Toma un snapshot previo para poder restaurar luego.
function removeRequiredCliente(scope = '#clientModal') {
  const $scope = $(scope);

  // Snapshot individual
  if (!$scope.data('reqSnapshotDone')) {
    $scope.find('input, select, textarea').each(function () {
      const $el = $(this);
      $el.data('reqSnapshot', $el.prop('required')); // true/false
    });

    // Snapshot por grupo (radios/checkbox por name)
    const group = {};
    $scope.find('input[type="radio"], input[type="checkbox"]').each(function () {
      const name = this.name || '';
      if (!name) return;
      group[name] = (group[name] || false) || $(this).prop('required');
    });
    Object.keys(group).forEach(function (name) {
      $scope.find(`input[name="${name}"]`).data('reqSnapshotGroup', group[name]);
    });

    $scope.data('reqSnapshotDone', true);
  }

  setTimeout(function() {
    // Quitar required
    $scope.find('input, select, textarea')
          .prop('required', false)
          .removeAttr('required')
          .removeAttr('aria-required');
  }, 200)
}

// Restaura 'required' exactamente como estaba antes de llamar a removeRequiredCliente()
function restoreRequiredCliente(scope = '#clientModal') {
  const $scope = $(scope);
  if (!$scope.data('reqSnapshotDone')) return;

  // Restaurar campos no agrupados
  $scope.find('input, select, textarea').each(function () {
    const $el = $(this);
    const type = ($el.attr('type') || '').toLowerCase();
    if (type === 'radio' || type === 'checkbox') return; // radios/checkbox abajo
    const was = !!$el.data('reqSnapshot');
    $el.prop('required', was);
    if (was) $el.attr('aria-required', 'true'); else $el.removeAttr('aria-required');
  });

  // Restaurar radios/checkbox por grupo (name)
  const handled = new Set();
  $scope.find('input[type="radio"], input[type="checkbox"]').each(function () {
    const name = this.name || '';
    if (!name || handled.has(name)) return;
    const groupWas = !!$(this).data('reqSnapshotGroup');
    const $group = $scope.find(`input[name="${name}"]`);
    $group.prop('required', groupWas);
    if (groupWas) $group.attr('aria-required', 'true'); else $group.removeAttr('aria-required');
    handled.add(name);
  });
}



  // Utilidad: marca/desmarca errores visuales (Bootstrap 4)
  function setFieldValidity($el, message) {
    $el.removeClass('is-invalid');
    $el.prev().removeClass('text-danger');
    $el.next('.invalid-feedback').remove();

    if (message) {
      $el.addClass('is-invalid');
      $el.prev().addClass('text-danger');
      // Si es input-group, poner feedback después del grupo
      if ($el.parent('.input-group').length) {
        $el.parent().after('<div class="invalid-feedback d-block">' + message + '</div>');
      } else {
        $el.after('<div class="invalid-feedback">' + message + '</div>');
      }
    }
  }

  // Valida radios/checkboxes por name (si alguno requerido)
  function validateChoiceGroup(name) {
    const $group = $wrap.find('[name="'+name+'"]');
    if (!$group.length) return true;

    const required = $group.filter('[required]').length > 0;
    if (!required) return true;

    const anyChecked = $group.is(':checked');
    // Marca solo al primero del grupo
    setFieldValidity($group.first(), anyChecked ? '' : 'Este campo es obligatorio.');
    return anyChecked;
  }

  // Valida todos los campos del contenedor
  function validateContainer() {
    let isValid = true;

    // limpiar estados previos
    $wrap.find('.is-invalid').removeClass('is-invalid');
    $wrap.find('.invalid-feedback').remove();

    // 1) Validación de inputs/selects/textarea con HTML5
    const elements = $wrap.find('input, select, textarea').toArray();

    // Primero, agrupar radios/checkbox por name para validarlos como conjunto
    const handledGroupNames = new Set();

    for (const el of elements) {
      const $el = $(el);

      // Radios/checkboxes requeridos -> validar por grupo
      if ((el.type === 'radio' || el.type === 'checkbox') && el.name) {
        if (!handledGroupNames.has(el.name)) {
          handledGroupNames.add(el.name);
          if (!validateChoiceGroup(el.name)) isValid = false;
        }
        continue;
      }

      // Otros campos: usar checkValidity()
      if (typeof el.checkValidity === 'function') {
        if (!el.checkValidity()) {
          isValid = false;
          // Mensaje amigable (usa validationMessage del navegador)
          setFieldValidity($el, el.validationMessage || 'Campo inválido.');

          // Opcional: mostrar tooltip nativo del navegador (solo al primero inválido)
          // el.reportValidity && el.reportValidity();
        } else {
          setFieldValidity($el, '');
        }
      }
    }

    // Enfoque al primer inválido
    if (!isValid) {
      const $firstInvalid = $wrap.find('.is-invalid').first();
      if ($firstInvalid.length) {
        $firstInvalid.focus();
        // scroll suave al campo
        $('html, body').animate({ scrollTop: $firstInvalid.offset().top - 120 }, 200);
      }
    }

    return isValid;
  }

  // Serializa los campos por name (similar a serializeArray)
  function collectData() {
    const data = {};
    // Tomar solo los que tienen name
    $wrap.find('input[name], select[name], textarea[name]').each(function () {
      const $el = $(this);
      const name = $el.attr('name');

      if ($el.is(':checkbox')) {
        // checkbox: enviar "on" o valor si está marcado; si no, no enviar (o enviar 0 si prefieres)
        if ($el.is(':checked')) data[name] = $el.val() || 'on';
      } else if ($el.is(':radio')) {
        if ($el.is(':checked')) data[name] = $el.val();
      } else {
        data[name] = $el.val();
      }
    });
    return data;
  }

  // Click en Guardar
  function crearCliente() {
    $wrap = $('#clientModal');
    $btn = $('#btn-crear-cliente');

    if (!validateContainer()) return;

    const payload = collectData();
    console.log(payload)

    $.ajax({
      url: "https://speed.tallerpro.net.pe/crear-cliente", // <- tu endpoint
      method: 'GET',
      data: payload,
      dataType: 'json',
      beforeSend: function () {
        $btn.prop('disabled', true);
      },
      success: function (res) {
        alert(res.message || 'Guardado con éxito');
        console.log(res)
        $('#txtCompany').removeClass('is-invalid')
        $('#txtCompany').prev().removeClass('text-danger')
        $('#clientModal').modal('hide')

        $('#txtCompany').val(res.data.company_name)
        $('#company_id').val(res.data.id)
    $('#contact_name').val(res.data.company_name)
    $('#contact_email').val(res.data.email)
    $('#contact_mobile').val(res.data.mobile)
    $('#brand_id').focus()
        // aquí puedes limpiar, cerrar modal, recargar tabla, etc.
        // Object.keys(payload).forEach(n => $wrap.find(`[name="${n}"]`).val(''));
      },
      error: function (xhr) {
        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
          // pintar errores de Laravel por campo
          const errors = xhr.responseJSON.errors;
          Object.keys(errors).forEach(function (name) {
            const $field = $wrap.find('[name="'+name+'"]');
            if ($field.length) setFieldValidity($field, errors[name][0]);
          });
          const $firstInvalid = $wrap.find('.is-invalid').first();
          $firstInvalid.length && $firstInvalid.focus();
        } else {
          alert('Error del servidor. Intenta nuevamente.');
        }
      },
      complete: function () {
        $btn.prop('disabled', false);
      }
    });
  }

// Limpia campos dentro de "scope" evitando ocultar selects por lógicas de cascada.
function resetFields(scope, exceptIds = ['departamento','provincia']) {
  const $scope  = scope ? $(scope) : $(document);
  const exclude = new Set(exceptIds);

  // 0) limpiar labels
  $scope.find('label').removeClass('text-danger');
  $scope.find('label .text-danger').removeClass('text-danger');

  // 1) inputs y textareas
  $scope.find('input, textarea').each(function () {
    const $el = $(this);
    const id  = this.id || '';
    if (exclude.has(id)) return;

    $el.removeClass('is-invalid is-valid');
    $el.next('.invalid-feedback, .valid-feedback').remove();

    const type = ($el.attr('type') || '').toLowerCase();
    if (type === 'checkbox' || type === 'radio') {
      $el.prop('checked', false);
    } else if (type === 'file') {
      $el.val(null);
    } else if ($el.attr('name') !== '_token') {
      $el.val('');
    }
  });

  // 2) selects (no disparar 'change' que activa tu cascada)
  $scope.find('select').each(function () {
    const $el = $(this);
    const id  = this.id || '';
    if (exclude.has(id)) return;

    $el.removeClass('is-invalid is-valid');

    const hasEmpty = $el.find('option[value=""]').length > 0;
    const newVal   = hasEmpty ? '' : ($el.find('option:first').val() || '');

    if ($el.hasClass('select2-hidden-accessible')) {
      // Actualiza solo la UI de Select2; evita listeners genéricos en 'change'
      $el.val(newVal).trigger('change.select2');
    } else {
      // Select normal: NO dispares 'change' para no ocultar dependientes
      if (hasEmpty) $el.val('');
      else this.selectedIndex = 0;
    }
  });

  // 3) feedback suelto
  $scope.find('.invalid-feedback, .valid-feedback').remove();
}

</script>            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-crear-car">Guardar Vehículo</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Client -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel">Crear Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
  <div class="col-sm-2">
    <div id="field_id_type" class="form-group">
    <label for="id_type">
        Tipo
        <span class="badge badge-info">!</span>
    </label>
    <select class="form-control form-control-sm" required id="id_type" name="id_type"><option value="" selected="selected">Seleccionar</option><option value="6">RUC</option><option value="1">DNI</option><option value="4">CEX</option><option value="7">PAS</option><option value="A">CÉDULA DIPLOMÁTICA</option></select>
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_doc" class="form-group">
    <label for="doc">
        Número doc
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm text-uppercase" required id="doc" name="doc" type="text">
</div>

  </div>
  <div class="col-sm-4">
    <div id="field_company_name" class="form-group">
    <label for="company_name">
        Razón Social
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm text-uppercase" required id="company_name" name="company_name" type="text">
</div>

  </div>
  <!-- <div class="col-sm-4">
    <div id="field_brand_name" class="form-group">
    <label for="brand_name">
        Marca
    </label>
    <input class="form-control form-control-sm text-uppercase" id="brand_name" name="brand_name" type="text">
</div>

  </div> -->
  <div class="col-sm-2">
    <div id="field_paternal_surname" class="form-group">
    <label for="paternal_surname">
        Ap Paterno
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm text-uppercase" required id="paternal_surname" name="paternal_surname" type="text">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_maternal_surname" class="form-group">
    <label for="maternal_surname">
        Ap Materno
    </label>
    <input class="form-control form-control-sm text-uppercase" id="maternal_surname" name="maternal_surname" type="text">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_name" class="form-group">
    <label for="name">
        Nombre
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm text-uppercase" required id="name" name="name" type="text">
</div>

  </div>
  <div class="col-sm-2 d-none">
    <div id="field_country" class="form-group">
    <label for="country">
        País
    </label>
    <select class="form-control form-control-sm" id="country" name="country"><option value="">Seleccionar</option><option value="AF">AFGANISTÁN</option><option value="AX">ÅLAND</option><option value="AL">ALBANIA</option><option value="DE">ALEMANIA</option><option value="AD">ANDORRA</option><option value="AO">ANGOLA</option><option value="AI">ANGUILA</option><option value="AQ">ANTÁRTIDA</option><option value="AG">ANTIGUA Y BARBUDA</option><option value="SA">ARABIA SAUDITA</option><option value="DZ">ARGELIA</option><option value="AR">ARGENTINA</option><option value="AM">ARMENIA</option><option value="AW">ARUBA</option><option value="AU">AUSTRALIA</option><option value="AT">AUSTRIA</option><option value="AZ">AZERBAIYÁN</option><option value="BS">BAHAMAS</option><option value="BD">BANGLADÉS</option><option value="BB">BARBADOS</option><option value="BH">BARÉIN</option><option value="BE">BÉLGICA</option><option value="BZ">BELICE</option><option value="BJ">BENÍN</option><option value="BM">BERMUDAS</option><option value="BY">BIELORRUSIA</option><option value="BO">BOLIVIA</option><option value="BQ">BONAIRE, SAN EUSTAQUIO Y SABA</option><option value="BA">BOSNIA Y HERZEGOVINA</option><option value="BW">BOTSUANA</option><option value="BR">BRASIL</option><option value="BN">BRUNÉI</option><option value="BG">BULGARIA</option><option value="BF">BURKINA FASO</option><option value="BI">BURUNDI</option><option value="BT">BUTÁN</option><option value="CV">CABO VERDE</option><option value="KH">CAMBOYA</option><option value="CM">CAMERÚN</option><option value="CA">CANADÁ</option><option value="QA">CATAR</option><option value="TD">CHAD</option><option value="CL">CHILE</option><option value="CN">CHINA</option><option value="CY">CHIPRE</option><option value="CO">COLOMBIA</option><option value="KM">COMORAS</option><option value="KP">COREA DEL NORTE</option><option value="KR">COREA DEL SUR</option><option value="CI">COSTA DE MARFIL</option><option value="CR">COSTA RICA</option><option value="HR">CROACIA</option><option value="CU">CUBA</option><option value="CW">CURAZAO</option><option value="DK">DINAMARCA</option><option value="DM">DOMINICA</option><option value="EC">ECUADOR</option><option value="EG">EGIPTO</option><option value="SV">EL SALVADOR</option><option value="AE">EMIRATOS ÁRABES UNIDOS</option><option value="ER">ERITREA</option><option value="SK">ESLOVAQUIA</option><option value="SI">ESLOVENIA</option><option value="ES">ESPAÑA</option><option value="US">ESTADOS UNIDOS</option><option value="EE">ESTONIA</option><option value="ET">ETIOPÍA</option><option value="PH">FILIPINAS</option><option value="FI">FINLANDIA</option><option value="FJ">FIYI</option><option value="FR">FRANCIA</option><option value="GA">GABÓN</option><option value="GM">GAMBIA</option><option value="GE">GEORGIA</option><option value="GH">GHANA</option><option value="GI">GIBRALTAR</option><option value="GD">GRANADA</option><option value="GR">GRECIA</option><option value="GL">GROENLANDIA</option><option value="GP">GUADALUPE</option><option value="GU">GUAM</option><option value="GT">GUATEMALA</option><option value="GF">GUAYANA FRANCESA</option><option value="GG">GUERNSEY</option><option value="GN">GUINEA</option><option value="GQ">GUINEA ECUATORIAL</option><option value="GW">GUINEA-BISÁU</option><option value="GY">GUYANA</option><option value="HT">HAITÍ</option><option value="HN">HONDURAS</option><option value="HK">HONG KONG</option><option value="HU">HUNGRÍA</option><option value="IN">INDIA</option><option value="ID">INDONESIA</option><option value="IQ">IRAK</option><option value="IR">IRÁN</option><option value="IE">IRLANDA</option><option value="BV">ISLA BOUVET</option><option value="IM">ISLA DE MAN</option><option value="CX">ISLA DE NAVIDAD</option><option value="IS">ISLANDIA</option><option value="KY">ISLAS CAIMÁN</option><option value="CC">ISLAS COCOS</option><option value="CK">ISLAS COOK</option><option value="FO">ISLAS FEROE</option><option value="GS">ISLAS GEORGIAS DEL SUR Y SANDWICH DEL SUR</option><option value="HM">ISLAS HEARD Y MCDONALD</option><option value="FK">ISLAS MALVINAS</option><option value="MP">ISLAS MARIANAS DEL NORTE</option><option value="MH">ISLAS MARSHALL</option><option value="PN">ISLAS PITCAIRN</option><option value="SB">ISLAS SALOMÓN</option><option value="TC">ISLAS TURCAS Y CAICOS</option><option value="UM">ISLAS ULTRAMARINAS DE ESTADOS UNIDOS</option><option value="VG">ISLAS VÍRGENES BRITÁNICAS</option><option value="VI">ISLAS VÍRGENES DE LOS ESTADOS UNIDOS</option><option value="IL">ISRAEL</option><option value="IT">ITALIA</option><option value="JM">JAMAICA</option><option value="JP">JAPÓN</option><option value="JE">JERSEY</option><option value="JO">JORDANIA</option><option value="KZ">KAZAJISTÁN</option><option value="KE">KENIA</option><option value="KG">KIRGUISTÁN</option><option value="KI">KIRIBATI</option><option value="KW">KUWAIT</option><option value="LA">LAOS</option><option value="LS">LESOTO</option><option value="LV">LETONIA</option><option value="LB">LÍBANO</option><option value="LR">LIBERIA</option><option value="LY">LIBIA</option><option value="LI">LIECHTENSTEIN</option><option value="LT">LITUANIA</option><option value="LU">LUXEMBURGO</option><option value="MO">MACAO</option><option value="MK">MACEDONIA</option><option value="MG">MADAGASCAR</option><option value="MY">MALASIA</option><option value="MW">MALAUI</option><option value="MV">MALDIVAS</option><option value="ML">MALÍ</option><option value="MT">MALTA</option><option value="MA">MARRUECOS</option><option value="MQ">MARTINICA</option><option value="MU">MAURICIO</option><option value="MR">MAURITANIA</option><option value="YT">MAYOTTE</option><option value="MX">MÉXICO</option><option value="FM">MICRONESIA</option><option value="MD">MOLDAVIA</option><option value="MC">MÓNACO</option><option value="MN">MONGOLIA</option><option value="ME">MONTENEGRO</option><option value="MS">MONTSERRAT</option><option value="MZ">MOZAMBIQUE</option><option value="MM">MYANMAR</option><option value="NA">NAMIBIA</option><option value="NR">NAURU</option><option value="NP">NEPAL</option><option value="NI">NICARAGUA</option><option value="NE">NÍGER</option><option value="NG">NIGERIA</option><option value="NU">NIUE</option><option value="NF">NORFOLK</option><option value="NO">NORUEGA</option><option value="NC">NUEVA CALEDONIA</option><option value="NZ">NUEVA ZELANDA</option><option value="OM">OMÁN</option><option value="NL">PAÍSES BAJOS</option><option value="PK">PAKISTÁN</option><option value="PW">PALAOS</option><option value="PS">PALESTINA</option><option value="PA">PANAMÁ</option><option value="PG">PAPÚA NUEVA GUINEA</option><option value="PY">PARAGUAY</option><option value="PE" selected="selected">PERÚ</option><option value="PF">POLINESIA FRANCESA</option><option value="PL">POLONIA</option><option value="PT">PORTUGAL</option><option value="PR">PUERTO RICO</option><option value="GB">REINO UNIDO</option><option value="EH">REPÚBLICA ÁRABE SAHARAUI DEMOCRÁTICA</option><option value="CF">REPÚBLICA CENTROAFRICANA</option><option value="CZ">REPÚBLICA CHECA</option><option value="CG">REPÚBLICA DEL CONGO</option><option value="CD">REPÚBLICA DEMOCRÁTICA DEL CONGO</option><option value="DO">REPÚBLICA DOMINICANA</option><option value="RE">REUNIÓN</option><option value="RW">RUANDA</option><option value="RO">RUMANIA</option><option value="RU">RUSIA</option><option value="WS">SAMOA</option><option value="AS">SAMOA AMERICANA</option><option value="BL">SAN BARTOLOMÉ</option><option value="KN">SAN CRISTÓBAL Y NIEVES</option><option value="SM">SAN MARINO</option><option value="MF">SAN MARTÍN</option><option value="PM">SAN PEDRO Y MIQUELÓN</option><option value="VC">SAN VICENTE Y LAS GRANADINAS</option><option value="SH">SANTA ELENA, ASCENSIÓN Y TRISTÁN DE ACUÑA</option><option value="LC">SANTA LUCÍA</option><option value="ST">SANTO TOMÉ Y PRÍNCIPE</option><option value="SN">SENEGAL</option><option value="RS">SERBIA</option><option value="SC">SEYCHELLES</option><option value="SL">SIERRA LEONA</option><option value="SG">SINGAPUR</option><option value="SX">SINT MAARTEN</option><option value="SY">SIRIA</option><option value="SO">SOMALIA</option><option value="LK">SRI LANKA</option><option value="SZ">SUAZILANDIA</option><option value="ZA">SUDÁFRICA</option><option value="SD">SUDÁN</option><option value="SS">SUDÁN DEL SUR</option><option value="SE">SUECIA</option><option value="CH">SUIZA</option><option value="SR">SURINAM</option><option value="SJ">SVALBARD Y JAN MAYEN</option><option value="TH">TAILANDIA</option><option value="TW">TAIWÁN (REPÚBLICA DE CHINA)</option><option value="TZ">TANZANIA</option><option value="TJ">TAYIKISTÁN</option><option value="IO">TERRITORIO BRITÁNICO DEL OCÉANO ÍNDICO</option><option value="TF">TIERRAS AUSTRALES Y ANTÁRTICAS FRANCESAS</option><option value="TL">TIMOR ORIENTAL</option><option value="TG">TOGO</option><option value="TK">TOKELAU</option><option value="TO">TONGA</option><option value="TT">TRINIDAD Y TOBAGO</option><option value="TN">TÚNEZ</option><option value="TM">TURKMENISTÁN</option><option value="TR">TURQUÍA</option><option value="TV">TUVALU</option><option value="UA">UCRANIA</option><option value="UG">UGANDA</option><option value="UY">URUGUAY</option><option value="UZ">UZBEKISTÁN</option><option value="VU">VANUATU</option><option value="VA">VATICANO, CIUDAD DEL</option><option value="VE">VENEZUELA</option><option value="VN">VIETNAM</option><option value="WF">WALLIS Y FUTUNA</option><option value="YE">YEMEN</option><option value="DJ">YIBUTI</option><option value="ZM">ZAMBIA</option><option value="ZW">ZIMBABUE</option></select>
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_departamento" class="form-group">
    <label for="departamento">
        Departamento
        <span class="badge badge-info">!</span>
    </label>
    <select class="form-control form-control-sm" required id="departamento" name="departamento"><option value="">Seleccionar</option><option value="AMAZONAS">AMAZONAS</option><option value="ÁNCASH">ÁNCASH</option><option value="APURÍMAC">APURÍMAC</option><option value="AREQUIPA">AREQUIPA</option><option value="AYACUCHO">AYACUCHO</option><option value="CAJAMARCA">CAJAMARCA</option><option value="CALLAO">CALLAO</option><option value="CUSCO">CUSCO</option><option value="HUANCAVELICA">HUANCAVELICA</option><option value="HUÁNUCO">HUÁNUCO</option><option value="ICA">ICA</option><option value="JUNÍN">JUNÍN</option><option value="LA LIBERTAD">LA LIBERTAD</option><option value="LAMBAYEQUE">LAMBAYEQUE</option><option value="LIMA" selected="selected">LIMA</option><option value="LORETO">LORETO</option><option value="MADRE DE DIOS">MADRE DE DIOS</option><option value="MOQUEGUA">MOQUEGUA</option><option value="PASCO">PASCO</option><option value="PIURA">PIURA</option><option value="PUNO">PUNO</option><option value="SAN MARTÍN">SAN MARTÍN</option><option value="TACNA">TACNA</option><option value="TUMBES">TUMBES</option><option value="UCAYALI">UCAYALI</option></select>
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_provincia" class="form-group">
    <label for="provincia">
        Provincia
        <span class="badge badge-info">!</span>
    </label>
    <select class="form-control form-control-sm" required id="provincia" name="provincia"><option value="">Seleccionar</option><option value="LIMA" selected="selected">LIMA</option><option value="BARRANCA">BARRANCA</option><option value="CAJATAMBO">CAJATAMBO</option><option value="CANTA">CANTA</option><option value="CAÑETE">CAÑETE</option><option value="HUARAL">HUARAL</option><option value="HUAROCHIRÍ">HUAROCHIRÍ</option><option value="HUAURA">HUAURA</option><option value="OYÓN">OYÓN</option><option value="YAUYOS">YAUYOS</option></select>
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_ubigeo_code" class="form-group">
    <label for="ubigeo_code">
        Distrito
        <span class="badge badge-info">!</span>
    </label>
    <select class="form-control form-control-sm" required id="ubigeo_code" name="ubigeo_code"><option value="" selected="selected">Seleccionar</option><option value="150101">LIMA</option><option value="150102">ANCÓN</option><option value="150103">ATE</option><option value="150104">BARRANCO</option><option value="150105">BREÑA</option><option value="150106">CARABAYLLO</option><option value="150107">CHACLACAYO</option><option value="150108">CHORRILLOS</option><option value="150109">CIENEGUILLA</option><option value="150110">COMAS</option><option value="150111">EL AGUSTINO</option><option value="150112">INDEPENDENCIA</option><option value="150113">JESÚS MARÍA</option><option value="150114">LA MOLINA</option><option value="150115">LA VICTORIA</option><option value="150116">LINCE</option><option value="150117">LOS OLIVOS</option><option value="150118">LURIGANCHO</option><option value="150119">LURIN</option><option value="150120">MAGDALENA DEL MAR</option><option value="150121">PUEBLO LIBRE</option><option value="150122">MIRAFLORES</option><option value="150123">PACHACAMAC</option><option value="150124">PUCUSANA</option><option value="150125">PUENTE PIEDRA</option><option value="150126">PUNTA HERMOSA</option><option value="150127">PUNTA NEGRA</option><option value="150128">RÍMAC</option><option value="150129">SAN BARTOLO</option><option value="150130">SAN BORJA</option><option value="150131">SAN ISIDRO</option><option value="150132">SAN JUAN DE LURIGANCHO</option><option value="150133">SAN JUAN DE MIRAFLORES</option><option value="150134">SAN LUIS</option><option value="150135">SAN MARTÍN DE PORRES</option><option value="150136">SAN MIGUEL</option><option value="150137">SANTA ANITA</option><option value="150138">SANTA MARÍA DEL MAR</option><option value="150139">SANTA ROSA</option><option value="150140">SANTIAGO DE SURCO</option><option value="150141">SURQUILLO</option><option value="150142">VILLA EL SALVADOR</option><option value="150143">VILLA MARÍA DEL TRIUNFO</option></select>
</div>

  </div>
  <div class="col-sm-4">
    <div id="field_address" class="form-group">
    <label for="address">
        Dirección
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm text-uppercase" required id="address" name="address" type="text">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_phone" class="form-group">
    <label for="phone">
        Tel Fijo
    </label>
    <input class="form-control form-control-sm" id="phone" name="phone" type="text">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_mobile" class="form-group">
    <label for="mobile">
        Celular
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm" required id="mobile" name="mobile" type="text">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_email" class="form-group">
    <label for="email">
        Email
        <span class="badge badge-info">!</span>
    </label>
    <input class="form-control form-control-sm" required id="email" name="email" type="email">
</div>
 
  </div>
</div>

<div class="form-row aseguradora">
  <div class="col-sm-2 mb-3">
      <div id="field_config_seguro" class="form-group">
    <label for="config_seguro">
        Es Aseguradora
    </label>
    <select class="form-control form-control-sm" id="config_seguro" name="config[seguro]"><option value="" selected="selected">No</option><option value="on">SI</option></select>
</div>

  </div>
  <div class="col-sm-4">
    <div id="field_brand_name" class="form-group">
    <label for="brand_name">
        Nombre Comercial
    </label>
    <input class="form-control form-control-sm text-uppercase" id="brand_name" name="brand_name" type="text">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_config_currency_id" class="form-group">
    <label for="config_currency_id">
        Moneda
    </label>
    <select class="form-control form-control-sm" id="config_currency_id" name="config[currency_id]"><option value="" selected="selected">Seleccionar</option><option value="1">SOLES</option><option value="2">DÓLARES</option></select>
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_config_p_hora" class="form-group">
    <label for="config_p_hora">
        Precio x Hora
    </label>
    <input class="form-control form-control-sm text-uppercase" step="0.01" min="0.00" id="config_p_hora" name="config[p_hora]" type="number">
</div>

  </div>
  <div class="col-sm-2">
    <div id="field_config_p_paño" class="form-group">
    <label for="config_p_paño">
        Precio x Paño
    </label>
    <input class="form-control form-control-sm text-uppercase" step="0.01" min="0.00" id="config_p_paño" name="config[p_paño]" type="number">
</div>

  </div>
</div>

<div class="form-row crear_vehiculo">
  <div class="col-sm-2 mb-3">
    <div class="custom-control custom-switch">
      <input class="custom-control-input" id="crear_vehiculo" checked="checked" name="crear_vehiculo" type="checkbox" value="on">
      <label class="custom-control-label" for="crear_vehiculo">Crear Vehículo</label>
    </div>
  </div>
</div>

<br><br>

<script>
$(document).ready(function(){
  actualizar_campos()
  $('#config_seguro').change(function() {
    actualizar_campos()
  })
})
function actualizar_campos() {
  seguro = $('#config_seguro').val()
  if (seguro == 'on') {
    $('#field_brand_name').show()
    $('#field_config_currency_id').show()
    $('#field_config_p_hora').show()
    $('#field_config_p_paño').show()
  } else {
    $('#field_brand_name').hide()
    $('#field_config_currency_id').hide()
    $('#field_config_p_hora').hide()
    $('#field_config_p_paño').hide()
  }
}
</script>            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-crear-cliente">Guardar Cliente</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Marca -->
<div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="marcaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="marcaModalLabel">Crear Marca y Modelo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="hidden" id="marca_id">
          <label for="marca" class="col-form-label-sm">Marca</label>
          <input type="text" class="form-control form-control-sm text-uppercase" id="marca">
          <div id="marcaFeedback" class="invalid-feedback">Esta Marca ya existe</div>
        </div>
        <div class="form-group">
          <label for="modelo_name" class="col-form-label-sm">Modelo</label>
          <input type="text" class="form-control form-control-sm text-uppercase" id="modelo_name">
          <div id="modeloNameFeedback" class="invalid-feedback">Este Modelo ya existe</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-crear-marca">Guardar Marca y Modelo</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Confirmar Crear Vehiculo -->
<div class="modal fade" id="confirmCrearCar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="marcaModalLabel">Placa <span id="spanPlaca"></span> no encontrada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        ¿Deseas crear la ficha vehicular para continuar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary btn-sm" id="btnConfirmCrearCar">Registrar vehículo</button>
      </div>
    </div>
  </div>
</div>

</div>
  
  </div>
</div>

<script>
(function () {
  function setSafeHeight() {
    const el = document.getElementById('safe-scroll');
    if (!el) return;

    // top relativo al viewport (incluye navbar + padding del <main>)
    const top = Math.round(el.getBoundingClientRect().top);

    // Si tienes un footer fijo con .fixed-bottom, descuéntalo:
    const footer = document.querySelector('.fixed-bottom');
    const footH = footer ? Math.round(footer.getBoundingClientRect().height) : 0;

    // Altura disponible
    const h = Math.max(0, window.innerHeight - top - footH);
    el.style.height = h + 'px';
  }

  // Inicial + cuando cambie el layout/viewport
  document.addEventListener('DOMContentLoaded', setSafeHeight);
  window.addEventListener('load', setSafeHeight);
  window.addEventListener('resize', setSafeHeight);
  window.addEventListener('orientationchange', setSafeHeight);

  // Si tu navbar colapsa (navbar-expand-md), vuelve a medir al abrir/cerrar
  document.addEventListener('shown.bs.collapse', setSafeHeight);
  document.addEventListener('hidden.bs.collapse', setSafeHeight);
})();



// Marca "no_aplica" en todos los grupos de radios dentro del scope dado
function selectAllNoAplica(scope = '#clienteFields', value = 'no_aplica') {
  const $scope = scope ? $(scope) : $(document);
  const target = String(value).toLowerCase();
  const seen = new Set(); // para no repetir grupos (name)

  $scope.find('input[type="radio"]')
    .filter(function () { return String(this.value).toLowerCase() === target; })
    .filter(':enabled') // opcional: .filter(':enabled:visible')
    .each(function () {
      const name = this.name || '';
      if (!name || seen.has(name)) return;
      this.checked = true;                 // más rápido que .prop('checked', true)
      $(this).trigger('change');           // notifica tu lógica (si la hay)
      seen.add(name);
    });
}

// Atajo: Alt + 0  (Option+0 en Mac)
document.addEventListener('keydown', function (e) {
  if (e.repeat) return;
  const keyIsZero = e.key === '0' || e.code === 'Digit0' || e.code === 'Numpad0';
  if (e.altKey && keyIsZero) {
    e.preventDefault();
    selectAllNoAplica('#clienteFields', 'no_aplica'); // ajusta el scope si quieres
  }
});

// Si tienes enlaces/botones que sí deben salir sin preguntar
$(document).on('click', '.force-leave', function(){
  markFormClean();
});


// Marca "sucio" cuando cambia algo dentro de #clienteFields
let formDirty = false;

$(document).on('input change', '#clienteFields :input', function () {
  formDirty = true;
});

// Handler de beforeunload (pide confirmación si hay cambios)
function confirmBeforeUnload(e) {
  if (!formDirty) return;
  e.preventDefault();
  e.returnValue = ''; // requerido por algunos navegadores
}

window.addEventListener('beforeunload', confirmBeforeUnload);

// Cuando guardes por AJAX o submit correcto, marca limpio para no bloquear la salida
function markFormClean() {
  formDirty = false;
}

// Ejemplos de “marcar limpio”:
// 1) En submit normal de un <form id="formPrincipal">
$(document).on('submit', '#formPrincipal', function () {
  markFormClean();
});

// 2) Tras guardar por AJAX:
function onSaveSuccess() {
  markFormClean();
  // ... tu lógica post-guardado (redirigir, cerrar modal, etc.)
}

</script>
        </main>
    </div>
    <script>
$(function () {
  // Bloquea reenvíos múltiples
  $(document).on('submit', 'form.form-loading', function (e) {
    var form  = this;
    var $form = $(form);

    // Si ya fue enviado, cancela
    if ($form.data('submitted') === true) {
      e.preventDefault();
      return false;
    }

    // Respeta validación nativa HTML5
    if (form.checkValidity && !form.checkValidity()) {
      return true; // el navegador mostrará los errores
    }

    // Marca como enviado
    $form.data('submitted', true);

    // Deshabilita botones submit y muestra "Enviando…"
    $form.find('button[type="submit"], input[type="submit"]').each(function () {
      var $btn = $(this);

      if ($btn.is('button')) {
        $btn.data('orig-html', $btn.html());
        $btn.html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Enviando…');
      } else {
        $btn.data('orig-val', $btn.val());
        $btn.val('Enviando…');
      }
      $btn.prop('disabled', true).addClass('disabled');
    });

    // Evita que se dispare otro submit por Enter mientras navega
    $form.on('keydown.preventResubmit', function (ev) {
      if (ev.key === 'Enter') ev.preventDefault();
    });

    return true; // deja continuar el submit normal (recarga de página)
  });

  // Si el usuario vuelve con Back/forward cache, restablece el estado
  window.addEventListener('pageshow', function (evt) {
    if (evt.persisted) {
      $('form.form-loading').each(function () {
        var $form = $(this).data('submitted', false).off('keydown.preventResubmit');
        $form.find('button[type="submit"], input[type="submit"]').each(function () {
          var $btn = $(this).prop('disabled', false).removeClass('disabled');
          if ($btn.is('button')) {
            var h = $btn.data('orig-html'); if (h != null) $btn.html(h);
          } else {
            var v = $btn.data('orig-val');  if (v != null) $btn.val(v);
          }
        });
      });
    }
  });
});


$(document).ready(function () {

    $('#miTabla').DataTable({
        pageLength: 50,
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
    });

    // $('#placa, #txtplaca').on('keyup', function (e) {
    //     let $input = $(this);
    //     let valor = $input.val().toUpperCase(); // Convertir a mayúsculas

    //     // Filtrar caracteres no permitidos y limitar a 6 caracteres
    //     let nuevoValor = valor.replace(/[^A-Z0-9]/g, '').slice(0, 6);

    //     // Actualizar el valor del input si hubo modificaciones
    //     $input.val(nuevoValor);

    //     // Validar estructura (1 letra + 4 o 5 alfanuméricos)
    //     let regex = /^[A-Z0-9]{5,6}$/;

    //     if (nuevoValor.length === 0) {
    //         $input[0].setCustomValidity(""); // No mostrar error si está vacío
    //     } else if (!regex.test(nuevoValor)) {
    //         $input[0].setCustomValidity("Debe tener 5 o 6 caracteres alfanuméricos.");
    //     } else {
    //         $input[0].setCustomValidity("");
    //     }
    // });

    $('#placa, #txtplaca').on('keyup', function (e) {
        let $input = $(this);
        let valor = $input.val().toUpperCase();

        // Permitir guion solo para lectura, pero eliminarlo internamente
        let limpio = valor.replace(/[^A-Z0-9-]/g, '');
        let nuevoValor = limpio.replace(/-/g, '').slice(0, 7); // sin guiones, máx 7 chars

        $input.val(nuevoValor);

        // === Expresiones Regulares AJUSTADAS ===

        // 6 caracteres — Placas REGULARES (autos y motos)
        // - Al menos 1 letra
        // - Al menos 1 número
        const reRegular = /^(?=.*[A-Z])(?=.*[0-9])[A-Z0-9]{6}$/;

        // 5 caracteres — Placas del ESTADO
        // - Al menos 2 letras
        // - Al menos 1 número
        const reEstado = /^(?=(?:.*[A-Z]){2,})(?=.*[0-9])[A-Z0-9]{5}$/;

        // 7 caracteres — Placas EXCEPCIONALES
        // - Deben empezar con 2 letras (advertencia)
        const reExcep = /^[A-Z]{2}[A-Z0-9]{5}$/;

        // === VALIDACIÓN ===
        if (nuevoValor.length === 0) {
            $input[0].setCustomValidity("");
            $input.removeClass('is-warning');
        }
        else if (reRegular.test(nuevoValor) || reEstado.test(nuevoValor)) {
            // Válidas al 100%
            $input[0].setCustomValidity("");
            $input.removeClass('is-warning');
        }
        else if (reExcep.test(nuevoValor)) {
            // Válida, pero inusual (color naranja)
            $input[0].setCustomValidity("");
            $input.addClass('is-warning');
        }
        else {
            // Totalmente inválida
            $input[0].setCustomValidity("Formato no reconocido (revise la placa).");
            $input.removeClass('is-warning');
        }
    });

    // let input = document.getElementById('placa');
    // input.addEventListener('input', function(event) {
    //     let valor = input.value.toUpperCase(); // Convertir a mayúsculas automáticamente
        
    //     // Filtrar caracteres no permitidos y limitar a 6 caracteres
    //     let nuevoValor = valor.replace(/[^A-Z0-9]/g, '').slice(0, 6);
        
    //     // Actualizar el valor del input si hubo modificaciones
    //     //if (valor !== nuevoValor) {
    //         input.value = nuevoValor;
    //     //}

    //     // console.log("Valor actual:", nuevoValor); // Para depuración en la consola

    //     // Validar estructura (1 letra + 4 o 5 alfanuméricos)
    //     let regex = /^[A-Z0-9]{5,6}$/;
    //     // let regex = /^[A-Z][A-Z0-9]{4,5}$/; //En caso de autos

    //     if (nuevoValor.length === 0) {
    //         input.setCustomValidity(""); // No mostrar error si está vacío
    //     } else if (!regex.test(nuevoValor)) {
    //         input.setCustomValidity("Debe comenzar con una letra y tener 5 o 6 caracteres alfanuméricos.");
    //     } else {
    //         input.setCustomValidity("");
    //     }
    // });

    $('#txtuser').autocomplete({
        source: "/guard/users/autocomplete",
        minLength: 1,
        select: function(event, ui){
            var cod=ui.item.id;
            $('#user_id').val(cod);
        }
    });

    $('#exampleModalx').on('hidden.bs.modal', function () {
        $('#btnAddService').focus(); // Cambia esto a otro botón fuera del modal
    });
    $(".form-loading").on("keydown", function(event) {
        // Solo bloquea el Enter si NO estás en un textarea
        if (event.key === "Enter" && !$(event.target).is("textarea")) {
            event.preventDefault();
            return false;
        }
    });


    n = $("#d1").val()
    n = Math.round(parseFloat(n)*1000000)/1000000
    if (isNaN(n)) {n = 0}
    $("#d1").val(n)
    window.descuento1 = n

    type_item = ''
    window.descuento2 = 0
    $('#btn-add-product').click(function(e){
        e.preventDefault()
        addRowProduct2()
    })
    $('#btn-create-item').click(function(e){
        e.preventDefault()
        createItem()
    })

    $('#txtProducto').on('keyup', function (e) {
        if ($('#txtProducto').val() == $('#txtProduct').val()) {
            $('#btn-create-item').addClass('d-none')
            $('#btn-add-product').removeClass('d-none')
        } else {
            $('#btn-create-item').removeClass('d-none')
            $('#btn-add-product').addClass('d-none')
        }
    })
    
    //Autocomplete de productos
    $('#txtProducto').autocomplete({
        //source: "/api/products/autocompleteAjax",
        source: function(request, response) {
            cat = $('#category').val()
            sub_cat = $('#sub_category').val()
            let url = "/api/products/autocompleteAjax?type=" + window.type; // URL dinámica
            $.ajax({
                url: url,
                dataType: "json",
                data: { term: request.term, category_id: cat, sub_category_id: sub_cat }, // Pasamos el término de búsqueda
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 4,
        select: function(event, ui){
            $p = ui.item.id
            // console.log($p)
            if (existCodeInList($p.intern_code)) {
                alert(`El código "${$p.intern_code}" ya fue registrado.`)
                setTimeout(function() {
                    clearModalProduct()
                }, 100)
            } else {
                $('#btn-create-item').addClass('d-none')
                $('#btn-add-product').removeClass('d-none')
                $('#txtCodigo').text($p.intern_code)
                $('#txtProId').text($p.id)
                $('#txtProduct').val($p.name)
                $('#unitId').val($p.unit_id)
                $('#unit').val($p.unit_id)
                // Si el valor $p.unit_id no está en la lista, buscar y seleccionar "und"
                if ($('#unitId').val() === null) {
                    let undOption = $('#unitId option').filter(function() {
                        return $(this).text().trim().toLowerCase() === "und";
                    });

                    if (undOption.length > 0) {
                        $('#unitId').val(undOption.val());
                        $('#unit').val(undOption.val())
                    }
                }
                $('#category').val($p.category_id)
                $('#sub_category').val($p.sub_category_id)
                if ($('#sub_category').val() > 0) {
                    $('#sub_category').parent().parent().removeClass('d-none')
                } else {
                    $('#sub_category').parent().parent().addClass('d-none')
                    $('#sub_category').val('0')
                }
                $('#txtValue').val(parseFloat($p.value)) // PRE_ACT es precio sin IGV

                if ($('#unitId option:selected').text()=='pño' && $('#diagnostico_p_paño').val()!='') {
                    $('#txtValue').val($('#diagnostico_p_paño').val())
                }
                if ($('#unitId option:selected').text()=='hr' && $('#diagnostico_p_hora').val()!='') {
                    $('#txtValue').val($('#diagnostico_p_hora').val())
                    console.log($('#diagnostico_p_hora').val())
                }
                $('#txtPrecio').val((($p.value*118)/100).toFixed(6))
                $('#txtDscto2').val(window.descuento2)
                $('#txtCantidad').val(1)
                // stk = 0
                // if ($p.stock.hasOwnProperty('STSKDIS') && $p.stock.STSKDIS != null) {
                //     stk = ($p.stock.STSKDIS*1).toFixed(0)
                // }
                // $('#alert-stock').text(`Stock: ${stk} ${$p.AUNIDAD}`)
                // if (stk > 0) {
                //     $('#alert-stock').addClass(`badge-info`)
                //     $('#alert-stock').removeClass(`badge-danger`)
                // } else {
                //     $('#alert-stock').removeClass(`badge-info`)
                //     $('#alert-stock').addClass(`badge-danger`)
                // }
                setTimeout(function() { // El retardo es necesario para los moviles
                    $('#txtCantidad').focus()
                    $('#txtCantidad').select()
                }, 100)
                // $('#label-cantidad').text($p.unit_id)
                $('#label-cantidad').text($("#unitId option:selected").text())
                calcTotalItem()
            }
        }
    })

    $(document).on('click', '.btn-edit-item', function (e) {
        e.preventDefault()
        // window.el = $(this).parent().parent()
        window.el = $(this).closest("tr")
        var isDownloadable = window.el.find(".is_downloadable").val()
        if (isDownloadable == '1') {
            window.type_item = 'pro'
        } else {
            window.type_item = 'ser'
        }
        console.log(isDownloadable+' '+window.type_item)
        clearModalCategoryUnit()
        editModalProduct()
        setTimeout(function() {
            $('#txtCantidad').focus()
            $('#txtCantidad').select()
        }, 500)
    })

    $('#btnAddProduct').click(function(e){
        window.type_item = 'pro'
        e.preventDefault()
        delete window.el
        clearModalCategoryUnit()
        clearModalProduct()
        setTimeout(function() {
            $('#txtProducto').focus()
        }, 500)
    })

    $('#btnAddService').click(function(e){
        window.type_item = 'ser'
        e.preventDefault()
        delete window.el
        clearModalCategoryUnit()
        clearModalProduct()
        setTimeout(function() {
            $('#category').focus()
        }, 500)
    })

    // $('#link-crear-marca').click(function (e) {
    //     clearModalMarcaYModelo();
    //     setTimeout(function() {
    //         $('#marca').focus();
    //     }, 500)
    // })
    // $('#link-crear-modelo').click(function (e) {
    //     clearModalMarcaYModelo()
    //     $('#marca_id').val($('#brand_id').val())
    //     $('#marca').val($('#brand_id option:selected').text())
    //     $('#marca').prop('readonly', true);
    //     setTimeout(function() {
    //         $('#modelo_name').focus();
    //     }, 500)
    // })
    // $("#btn-crear-marca").click(function(e){
    //     crearMarcaYModelo()
    // })
    $("#btn-crear-modelo").click(function(e){
        crearModelo()
    })


    // if ($('#is_downloadable').length) {
    //     $('.is_downloadable').val($('#is_downloadable').val())
    // }
    $("#btn-image-load").click(function (e) {
        $("#image_base64").val(document.querySelector("#canvas").toDataURL('image/jpeg').replace(/^data:image\/jpeg;base64,/, ""))
    })
    $(".pagar-venta").click(function(e){
        console.log($(this).data('id'))
        m_id = $(this).data('id')

        $.get(`/get_cpe/${m_id}`, function(data){
            console.log(data)
            $("#pagarModalLabel").html(data.sn)
            if (data.currency_id==2) {
                $("#currency_id").html('DOLARES')
            } else {
                $("#currency_id").html('SOLES')
            }
            $("#total").html(data.total)
            $("#deuda").html((data.total-data.amortization).toFixed(2))
            $('#metodo option').filter(function() {
                return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0
            }).remove()
        })
    })
    $('.btn-anular').click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var tipo = row.data('tipo');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':_ID', id);
        var data = form.serializeArray();
        // row.fadeOut();

        if (!confirm(`Seguro que desea anular ${tipo} ?`)) {
            e.preventDefault();
            return false;
        }
        
        $.post(url, data, function(result){
            console.log(result);
            alert(`${tipo}-${result.sn} fue anulado`)
            //alert(result.message);
            row.find('.status').html('<span class="badge badge-danger">ANUL</span>')
            row.find('.btn-anular').fadeOut()
        }).fail(function(){
            alert(`${tipo} no fue anulado`)
            // row.show();
        });
    });

    $('#p_value').change(function () {
        x = Math.round($('#p_value').val()*118)/100
        $('#p_price').val(x)
    })
    $('#p_price').change(function () {
        x = Math.round($('#p_price').val()*10000/118)/100
        $('#p_value').val(x)
    })
    $('#p_value_cost').change(function () {
        x = Math.round($('#p_value_cost').val()*118)/100
        $('#p_price_cost').val(x)
    })
    $('#p_price_cost').change(function () {
        x = Math.round($('#p_price_cost').val()*10000/118)/100
        $('#p_value_cost').val(x)
    })
    if ($('#with_tax').val() == 1) {
        $('.withTax').show()
        $('.withoutTax').hide()
    } else {
        $('.withTax').hide()
        $('.withoutTax').show()
    }

    $('#with_tax').change(function(){
        $('.withTax').toggle()
        $('.withoutTax').toggle()
    })

    $(document).on('click', '.btn-delete-item', function (e) {
        e.preventDefault()
        $(this).parent().parent().remove()
        calcTotal()
    })

    $(document).on('change','#txtCantidad, #txtPrecio, #txtValue, #txtDscto, #txtDscto2', function (e) {
        calcTotalItem(this)
        //calcTotal()
    });

    //autocomplete para elementos agregados por javascript
    $(document).on('focus','.txtProduct', function (e) {
        $this = this
        if ( !$($this).data("autocomplete") ) {
            e.preventDefault()
            $($this).autocomplete({
                source: "/api/products/autocompleteAjax",
                minLength: 4,
                select: function(event, ui){
                    $p = ui.item.id
                    $($this).parent().parent().find('.categoryId').val($p.category_id)
                    $($this).parent().parent().find('.subCategoryId').val($p.sub_category_id)
                    if ($('#is_downloadable')) {
                        $($this).parent().parent().find('.is_downloadable').val($p.is_downloadable)
                    }
                    $($this).parent().parent().find('.productId').val($p.id)
                    $($this).parent().parent().find('.txtProduct').val($p.name)
                    $($this).parent().parent().find('.unitId').val($p.unit_id)
                    $($this).parent().parent().find('.txtValue').val($p.value)
                    $($this).parent().parent().find('.txtPrecio').val($p.price)
                    $($this).parent().parent().find('.txtDscto').val(window.descuento1)
                    $($this).parent().parent().find('.txtDscto2').val(window.descuento2)
                    $($this).parent().parent().find('.intern_code').text($p.intern_code)
                    $($this).parent().parent().find('.txtCantidad').focus()
                }
            })
        }
    })

    // $('#btnAddProduct').bind("click", function(e){
    //     e.preventDefault()
    //     addRowProduct()
    // });

    my_company = $('#my_company').val()
    $('#txtCompany').autocomplete({
        source: "/api/companies/autocompleteAjax/clients/"+my_company+"/",
        minLength: 4,
        select: function(event, ui){
            $('#company_id').val(ui.item.id)
            if ($('#contact_name').val() !== undefined) {
                if ($('#contact_name').val().trim() == '') {$('#contact_name').val(ui.item.company_name)}
                if ($('#contact_email').val().trim() == '') {$('#contact_email').val(ui.item.email)}
                // if ($('#contact_phone').val().trim() == '') {$('#contact_phone').val(ui.item.phone)}
                if ($('#contact_mobile').val().trim() == '') {$('#contact_mobile').val(ui.item.mobile)}
            }
            $('#branch_id').empty()
            $('#branch_id').append(`<option value=''>Seleccionar</option>`)
            ui.item.branches.forEach(function (b) {
                $('#branch_id').append(`<option value='${b.id}'>${b.company_name}</option>`)
            })
            // $('#branch_id').focus()
            $('#brand_id').focus()
        }
    })
    $('#txtProvider').autocomplete({
        source: "/api/companies/autocompleteAjax/providers/"+my_company+"/",
        minLength: 4,
        select: function(event, ui){
            $('#company_id').val(ui.item.id)
        }
    })

    $('#txtShipper').autocomplete({
        source: "/api/companies/autocompleteAjax/shippers/"+my_company+"/",
        minLength: 4,
        select: function(event, ui){
            $('#shipper_id').val(ui.item.id)
            $('#branch_shipper_id').empty()
            $('#branch_shipper_id').append(`<option value=''>Seleccionar</option>`)
            ui.item.branches.forEach(function (b) {
                $('#branch_shipper_id').append(`<option value='${b.id}'>${b.company_name}</option>`)
            })
            $('#branch_shipper_id').focus()
        }
    })

    $('#btnNewAttribute').click(function() {
        var items = $('#items-attribute').val()
        console.log("items = " + items)
        if (items>0 && $("input[name='attributes["+(items-1)+"][id]']").val() == "") {
            $("input[name='attributes["+(items-1)+"][name]']").focus()
        } else {
            renderTemplateRowAttribute()
        }
    })

    changeIdType()
    $('#id_type').change(function(){
        changeIdType()
    });

    $('#doc').change(function(){
        var doc = $('#doc').val()
        $('#doc').val(doc)
        var type = $('#id_type').val()
        if (doc.length == 11 && type == '6') {
            getDataPadron(doc, type)
        }else if (doc.length == 8 && type == '1') {
            getDataPadron(doc, type)
        }
    });

    changeCountry()

    $('#country').change(function(){
        changeCountry()
    });
    //carga departamentos
    $('#departamento').change(function(){
        cargaProvincias()
    });
    //carga provincias
    $('#provincia').change(function(){
        cargaDistritos()
    })

    $(document).on('change', '.text-uppercase', function (e) {
        var cadena=$(this).val().trim()
        cadena = cadena.replace("  "," ")
        cadena = cadena.toUpperCase()
        $(this).val(cadena)
    })

    $('#btnAddBranch').click(function(e){
        addRowBranch()
    });

    $(document).on('focus','.txtUbigeo', function (e) {
        // console.log($(this));
        $var = {}
        $var.this = this;
        if ( !$($var.this).data("autocomplete") ) {
            e.preventDefault()
            $($var.this).autocomplete({
                source: "/api/ubigeos/autocompleteAjax",
                minLength: 2,
                select: function(event, ui){
                    console.log(ui)
                    var cod=ui.item.id
                    $($var.this).parent().parent().find('.ubigeoId').val(cod)
                }
            });
        }
    });
    $('#vin').change(function (e) {
        vin = $('#vin').val().trim().toUpperCase()
        $('#vin').val(vin) //3HGRM3830CG603778
        $('#codigo').val(vin.substring(3, 7))
        arr_years = {A:2010, B:2011, C:2012, D:2013, E:2014, F:2015, G:2016, H:2017, J:2018, K:2019, L:2020, M:2021, N:2022, P:2023, R:2024, S:2025, T:2026, V:2027, W:2028, X:2029, Y:2030, 1:2031, 2:2032, 3:2033, 4:2034, 5:2035, 6:2036, 7:2037, 8:2038, 9:2039}
        year = arr_years[vin.substring(9, 10)]
        $('#year').val(year)
    })
    // $('#add_contact').change(function (e) {
    //     if ($('#add_contact').is(':checked')) {
    //         $('.contact').removeClass("d-none")
    //         $('#contact_name').attr("required", "required")
    //     } else {
    //         $('.contact').addClass( "d-none")
    //         $('#contact_name').removeAttr("required", "required")
    //     }
    // })
    if ($('#add_contact').is(':checked')) {
        $('.contact').removeClass("d-none");
        $('#contact_name').attr("required", "required");
    }

    $('#placa').change(function (e) {
        getCar()
    })
    $('#txtplaca').change(function (e) {
        checkCar()
    })
    // Ejecutar directamente la lógica sin necesidad del evento
    const type_service = $('#type_service').val();
    if (type_service === 'PREVENTIVO') {
        $('#preventivo').parent().parent().removeClass("d-none");
        $('#seguro').parent().parent().addClass("d-none");
        $('#claim_number').parent().parent().addClass("d-none");
        $('#preventivo').attr("required", "required");
        $('#seguro').removeAttr("required");
    } else if (type_service === 'SINIESTRO') {
        $('#preventivo').parent().parent().addClass("d-none");
        $('#seguro').parent().parent().removeClass("d-none");
        $('#claim_number').parent().parent().removeClass("d-none");
        $('#preventivo').removeAttr("required");
        $('#seguro').attr("required", "required");
    } else {
        $('#preventivo').parent().parent().addClass("d-none");
        $('#seguro').parent().parent().addClass("d-none");
        $('#claim_number').parent().parent().addClass("d-none");
        // $('#preventivo').removeAttr("required");
        // $('#seguro').removeAttr("required");
    }

    // $('#type_service').change(); // 🔁 Ejecuta la lógica de visibilidad al cargar

    $('#type_service').change(function (e) {
        if ('PREVENTIVO' == $('#type_service').val()) {
            $('#preventivo').parent().parent().removeClass("d-none")
            $('#seguro').parent().parent().addClass( "d-none")
            $('#claim_number').parent().parent().addClass("d-none")
            $('#preventivo').attr("required", "required")
            $('#seguro').removeAttr("required", "required")
        } else if ('SINIESTRO' == $('#type_service').val()) {
            $('#preventivo').parent().parent().addClass( "d-none")
            $('#seguro').parent().parent().removeClass( "d-none")
            $('#claim_number').parent().parent().removeClass("d-none")
            $('#preventivo').removeAttr("required", "required")
            $('#seguro').attr("required", "required")
        } else {
            $('#preventivo').parent().parent().addClass( "d-none")
            $('#seguro').parent().parent().addClass( "d-none")
            $('#claim_number').parent().parent().addClass("d-none")
            $('#preventivo').removeAttr("required", "required")
            $('#seguro').removeAttr("required", "required")
        }
    })
   // $("#type_detail_p").prop("checked", true);
    $(".send_cpe").submit(function(e) {
        e.preventDefault()
        var form = $(this)
        //console.log(form.serializeArray()[0].value)
        console.log(form.serialize())
        var url = "/send_cpe?"+form.serialize();
        console.log(url)
        $('.dropdown-toggle').dropdown('hide')
        $.get(url, function(data){
            console.log(data)
        });


    })
})

function createItem(){
    //obteniendo los valores de los inputs
    desc = $('#txtProducto').val()
    codigo = $('#txtCodigo').text()
    product_id = $('#txtProId').text()
    is_downloadable = $('#is_downloadable').val()
    currency = $('#currency_id').val()
    // if (codigo == "") {
    //     $('#txtProducto').val("")
    //     $('#txtProduct').val("")
    //     $('#txtProducto').focus()
    //     return false;
    // }
    cat = $('#category').val()
    if (cat == '') {
        $('#category').focus()
        return false
    }

    u = $('#unitId').val()
    unidad = $("#unitId option:selected").text()

    if (u == '') {
        $('#unitId').focus()
        return false
    }
    // console.log(unidad)
    q = parseFloat($('#txtCantidad').val())
    if (isNaN(q) || q <= 0) {
        $('#txtCantidad').val("")
        $('#txtCantidad').focus()
        return false;
    }
    v = parseFloat($('#txtValue').val())
    if (window.type != 'pro') {
        if (isNaN(v) || v <= 0) {
            $('#txtValue').val("")
            $('#txtValue').focus()
            return false;
        }
    }
    page = '/crear-item'
    $.get(page, {intern_code: '-', category_id: cat, sub_category_id: '0', name: desc, unit_id: u, value: v, is_downloadable: is_downloadable, currency_id: currency}, function(data){
        // if (data.error!=undefined) {
        //     if(data.error.marca!=undefined) {
        //         $('#marca').addClass('is-invalid')
        //         $('#marcaFeedback').text(data.error.marca)
        //         $('#modelo_name').removeClass('is-invalid')
        //     }
        //     if(data.error.modelo!=undefined) {
        //         $('#modelo_name').removeClass('is-invalid')
        //         $('#marcaFeedback').text(data.error.modelo)
        //         $('#modelo_name').addClass('is-invalid')
        //     }
        // } else {
            $('#txtProId').text(data.intern_code)
            $('#txtCodigo').text(data.intern_code)
            $('#txtProducto').text(data.name)
            $('#txtProduct').text(data.name)
            // $('#unitId').text(data.unit_id)
            // $('#category').text(data.category_id)
        // }
        $('#btn-add-product').click()
    })

}

function existCodeInList(code) {
    existe_codigo = false
    $('#tableItems tr').each(function (index, vtr) {
        codigo = $(vtr).find('.productId').val()
        if (codigo == code) {
            existe_codigo = true
        }
    })
    return existe_codigo
}

function addRowProduct2() {
    //obteniendo los valores de los inputs
    description = $('#txtDescription').val()
    desc = $('#txtProducto').val()
    codigo = $('#txtCodigo').text()
    product_id = $('#txtProId').text()
    if (codigo == "") {
        $('#txtProducto').val("")
        $('#txtProduct').val("")
        $('#txtProducto').focus()
        return false;
    }
    is_downloadable = $('#is_downloadable').val()
    u = $('#unitId').val()
    unidad = $("#unitId option:selected").text()
    // console.log(unidad)
    cat = $('#category').val()
    category = $("#category option:selected").text()
    sub_cat = $('#sub_category').val()
    sub_category = $("#sub_category option:selected").text()
    text_cat = category
    if (sub_cat!==null && sub_cat!='' && sub_cat != '0') {
        text_cat = sub_category
    } else {
        sub_cat = '0'
    }

    q = parseFloat($('#txtCantidad').val())
    if (!isNaN(q) && q <= 0) {
        $('#txtCantidad').val("")
        $('#txtCantidad').focus()
        return false;
    }
    v = parseFloat($('#txtValue').val())
    if (window.type != 'pro') {
        if (!isNaN(v) && v <= 0) {
            $('#txtValue').val("")
            $('#txtValue').focus()
            return false;
        }
    }
    d1 = window.descuento1
    d2 = parseFloat($('#txtDscto2').val())
    t = parseFloat($('#txtTotal').val())
    // console.log(sub_cat)
    if (typeof window.el === 'undefined') { // Si no existe la variable window.el (producto a editar) se agrega una fila
        items = $('#items').val()
        //preparando fila <tr>
        tr = `<tr class="js-det-row" data-category="${cat}">
            <input class="categoryId" name="details[${items}][category_id]" type="hidden" value="${cat}">
            <input class="subCategoryId" name="details[${items}][sub_category_id]" type="hidden" value="${sub_cat}">
            <input class="is_downloadable" name="details[${items}][is_downloadable]" type="hidden" value="${is_downloadable}">
            <input class="productId" name="details[${items}][comment]" type="hidden" value="${text_cat}">
            <input class="unitId" name="details[${items}][unit_id]" type="hidden" value="${u}">
            <input class="description" name="details[${items}][description]" type="hidden" value="${description}">
            <td><span class='spanCodigo text-right'>${codigo}</span><input class="productId" name="details[${items}][product_id]" type="hidden" value="${product_id}"></td>
            <td><span class='spanCategory'>${text_cat}</span></td>
            <td><span class='spanProduct'>${desc}</span><input class="txtProduct" name="details[${items}][DFDESCRI]" type="hidden" value=""></td>
            <td class="text-center"><span class='spanCantidad text-right'>${q.toFixed(2)} ${unidad}</span><input class="txtCantidad" name="details[${items}][quantity]" type="hidden" value="${q}"></td>
            <td class="withTax text-right"><span class='spanPrecio'>${(v*1.18).toFixed(2)}</span><input class="txtPrecio" name="details[${items}][price]" type="hidden" value="${v*1.18}"></td>
            <td class="withoutTax text-right"><span class='spanValue'>${v.toFixed(2)}</span><input class="txtValue" name="details[${items}][value]" type="hidden" value="${v}"></td>
            <td class="text-center"><span class='spanDscto2'>${d2.toFixed(0)}</span><input class="txtDscto2" name="details[${items}][d2]" type="hidden" value="${d2}"></td>
            <td class="withTax text-right"> <span class='txtPriceItem'>${(t*1.18).toFixed(2)}</span> </td>
            <td class="withoutTax text-right"> <span class='txtTotal'>${t.toFixed(2)}</span> </td>
            <td class="text-center" style="white-space: nowrap;">
                <a href="#" class="btn btn-outline-primary btn-sm btn-edit-item" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                <a href="#" class="btn btn-outline-danger btn-sm btn-delete-item" title="Eliminar"><i class="far fa-trash-alt"></i></a>
            </td>
        </tr>`
        //console.log(tr)

        $("#tableItems").append(tr)
        $(`input[name="details[${items}][DFDESCRI]"]`).val(desc)
        items = parseInt(items) + 1
        $('#items').val(items)

        if ($('#with_tax').val() == 1){
            $('.withTax').show()
            $('.withoutTax').hide()
        } else {
            $('.withTax').hide()
            $('.withoutTax').show()
        }

    } else {

        // window.el.find('.txtProduct').val($('#txtProduct').val())
        // window.el.find('.spanProduct').text($('#txtProduct').val())
        // window.el.find('.txtCodigo').val($('#txtCodigo').val())
        // window.el.find('.spanCodigo').text($('#txtCodigo').val())
        // window.el.find('.unitId').val($('#unitId').val())
        window.el.find('.description').val(description)
        window.el.find('.txtCantidad').val(q.toFixed(2))
        window.el.find('.spanCantidad').text(q.toFixed(2) + ' ' + unidad)
        window.el.find('.txtValue').val(v.toFixed(2))
        window.el.find('.spanValue').text(v.toFixed(2))
        window.el.find('.txtDscto2').val(d2)
        window.el.find('.spanDscto2').text(d2)

        $('#exampleModalx').modal('hide')
    }
    calcTotal()
    // window.descuento2 = d2
    clearModalProduct()
    ordenarTabla()
    // Grabando en la base de datos
    /*form = $(".form-loading")
    var actionUrl = form.attr('action')
    var formData = form.serialize()
    console.log(actionUrl)
    $.ajax({
        url: actionUrl, // Cambia esto por la URL de tu API
        type: 'POST',
        data: formData,
        success: function(response) {
            // Manejar la respuesta exitosa
            console.log('Datos guardados con éxito: ' + response)
        },
        error: function(xhr, status, error) {
            // Manejar el error
            console.log('Error al guardar los datos: ' + error)
        }
    })*/

}

// function ordenarTabla() {
//     var filas = $("#tableItems tr").get();

//     filas.sort(function(a, b) {
//         var isDownloadableA = parseInt($(a).find(".is_downloadable").val()) || 0;
//         var isDownloadableB = parseInt($(b).find(".is_downloadable").val()) || 0;

//         var categoriaA = $(a).find(".spanCategory").text().trim().toLowerCase();
//         var categoriaB = $(b).find(".spanCategory").text().trim().toLowerCase();

//         // Ordenar primero por is_downloadable (0 antes que 1)
//         if (isDownloadableA !== isDownloadableB) {
//             return isDownloadableA - isDownloadableB;
//         }

//         // Si is_downloadable es igual, ordenar por categoría ascendente
//         return categoriaA.localeCompare(categoriaB);
//     });

//     // Reinsertar solo si hubo cambios en el orden
//     var ordenActual = $("#tableItems").children().map(function() {
//         return $(this).data("id");
//     }).get().join(",");

//     var nuevoOrden = filas.map(row => $(row).data("id")).join(",");

//     if (ordenActual !== nuevoOrden) {
//         $("#tableItems").append(filas); // Solo reinsertar si cambia el orden
//     }
// }

function ordenarTabla() {
    const $tabla = $("#tableItems");
    const filas = $tabla.find("tr").get();

    // Mapa para recordar el orden de aparición de cada categoría
    const ordenCategoria = new Map();
    let ordenActual = 0;

    // Detectar orden de aparición
    filas.forEach((fila) => {
        const comment = $(fila).find(".spanCategory").text().trim().toLowerCase();
        if (!ordenCategoria.has(comment)) {
            ordenCategoria.set(comment, ordenActual++);
        }
    });

    // Ordenar las filas respetando is_downloadable y luego el orden de aparición
    filas.sort(function (a, b) {
        const isDownloadableA = parseInt($(a).find(".is_downloadable").val()) || 0;
        const isDownloadableB = parseInt($(b).find(".is_downloadable").val()) || 0;

        if (isDownloadableA !== isDownloadableB) {
            return isDownloadableA - isDownloadableB; // primero los normales (0), luego descargables (1)
        }

        const categoriaA = $(a).find(".spanCategory").text().trim().toLowerCase();
        const categoriaB = $(b).find(".spanCategory").text().trim().toLowerCase();

        return ordenCategoria.get(categoriaA) - ordenCategoria.get(categoriaB);
    });

    // Comparar orden actual vs. nuevo
    const ordenAnterior = $tabla.children().map(function () {
        return $(this).data("id");
    }).get().join(",");

    const nuevoOrden = filas.map(row => $(row).data("id")).join(",");

    if (ordenAnterior !== nuevoOrden) {
        $tabla.append(filas); // Reinsertar solo si cambió el orden
    }
}

function clearModalCategoryUnit() {
    type = window.type_item
    // console.log(type)
    if (type=='pro') {
        document.getElementById("unitId").innerHTML = window.opts_uni_pro;
        document.getElementById("category").innerHTML = window.opts_cat_pro;
        $(".spanTypeItem").text('Repuesto')
        $("#is_downloadable").val('1')
    } else if (type=='ser') {
        // console.log('agregar servicio')
        document.getElementById("unitId").innerHTML = window.opts_uni_ser;
        document.getElementById("category").innerHTML = window.opts_cat_ser;
        $(".spanTypeItem").text('Servicio')
        $("#is_downloadable").val('0')
    }
    $("#sub_category").parent().parent().addClass('d-none')
    $("#sub_category").val('0')
}

function clearModalProduct() {
    $('#btn-create-item').addClass('d-none')
    $('#txtProducto').addClass("form-control")
    $('#txtProducto').removeClass("form-control-plaintext")
    $('#txtProducto').attr('readonly', false)

    $('#txtProducto').focus()
    $('#txtProducto').val("")
    $('#txtProduct').val("")
    $('#txtDescription').val("")
    $('#txtCodigo').text("")
    // $('#unitId').val("")
    $('#txtCantidad').val("0")
    $('#txtValue').val("0")
    $('#txtDscto2').val(window.descuento2)
    $('#txtTotal').val("0.00")
    $('#spanValueItem').text('0.00')
    $('#spanPriceItem').text('0.00')
    $('#label-cantidad').text('')

    $('#alert-stock').addClass("badge-info")
    $('#alert-stock').removeClass("badge-danger")
    $('#alert-stock').text("")
    items = $('#items').val()
    max = 500
    $('#alert-items').text(`Items registrados: ${items}`)
    if (items < max) {
        $('#alert-items').removeClass("badge-danger")
        $('#alert-items').addClass("badge-light")
        $('#btn-add-product').prop("disabled", false);
    } else {
        $('#alert-items').addClass("badge-danger")
        $('#alert-items').removeClass("badge-light")
        $('#btn-add-product').prop("disabled", true);
    }

    $('#btn-create-item').addClass('d-none')
    $('#btn-add-product').removeClass('d-none')
    $('#txtDescription').parent().addClass('d-none')
    
    if ($('#unitId option:selected').text()=='pño' && $('#diagnostico_p_paño').val()!='') {
        $('#txtValue').val($('#diagnostico_p_paño').val())
    }
    if ($('#unitId option:selected').text()=='hr' && $('#diagnostico_p_hora').val()!='') {
        $('#txtValue').val($('#diagnostico_p_hora').val())
    }

    my_cat_text = $("#category option:selected").text()
    if (my_cat_text == 'MECANICA') {
        $('#txtDescription').parent().removeClass('d-none')
    } else {
        $('#txtDescription').parent().addClass('d-none')
    }
}

function editModalProduct() {
    items = $('#items').val()
    max = 50
    $('#alert-items').text(`Items registrados: ${items}`)
    $('#btn-add-product').prop("disabled", false);
    if (items < max) {
        $('#alert-items').removeClass("badge-danger")
        $('#alert-items').addClass("badge-light")
    } else {
        $('#alert-items').addClass("badge-danger")
        $('#alert-items').removeClass("badge-light")
    }

    $('#txtProducto').removeClass("form-control")
    $('#txtProducto').addClass("form-control-plaintext")
    $('#txtProducto').attr('readonly', true)

    $('#category').val(window.el.find('.categoryId').val())
    $('#unitId').val(window.el.find('.unitId').val())
    $('#txtDescription').val(window.el.find('.description').val())
    $('#txtProducto').val(window.el.find('.spanProduct').text())
    $('#txtProduct').val(window.el.find('.spanProduct').text())
    $('#txtCodigo').text(window.el.find('.spanCodigo').text())
    $('#txtCantidad').val(window.el.find('.txtCantidad').val())
    $('#txtValue').val(window.el.find('.txtValue').val())
    $('#txtDscto2').val(window.el.find('.txtDscto2').val())
    $('#txtTotal').val(window.el.find('.txtTotal').text())
    $('#txtPriceItem').val(window.el.find('.txtPriceItem').text())
    $('#spanValueItem').text(window.el.find('.txtTotal').text())
    $('#spanPriceItem').text(window.el.find('.txtPriceItem').text())
    $('#label-cantidad').text(window.el.find('.unitId').val())

    $('#exampleModalx').modal('show')

    my_cat_text = $("#category option:selected").text()
    if (my_cat_text == 'MECANICA') {
        $('#txtDescription').parent().removeClass('d-none')
    } else {
        $('#txtDescription').parent().addClass('d-none')
    }
}

// function clearModalMarcaYModelo() {
//     $('#marca_id').val('')
//     $('#marca').removeClass('is-invalid')
//     $('#marca').val('')
//     $('#marca').prop('readonly', false)
//     $('#modelo_name').removeClass('is-invalid')
//     $('#modelo_name').val('')
// }
// function crearMarcaYModelo() {
//     var $marca_id = $('#marca_id').val().trim()
//     var $marca = $('#marca').val().trim()
//     var $modelo = $('#modelo_name').val().trim()
//     if ($marca=='') {
//         $('#marca').addClass('is-invalid')
//         $('#marcaFeedback').text('La Marca es obligatoria')
//         return false
//     } else {
//         $('#marca').removeClass('is-invalid')
//     }
//     if ($modelo=='') {
//         $('#modelo_name').addClass('is-invalid')
//         $('#modeloNameFeedback').text('El Modelo es obligatorio')
//         return false
//     } else {
//         $('#modelo_name').removeClass('is-invalid')
//     }
//     page = '/crear-marca'
//     $.get(page, {brand_id: $marca_id, marca: $marca, modelo: $modelo}, function(data){
//         if (data.error!=undefined) {
//             if(data.error.marca!=undefined) {
//                 $('#marca').addClass('is-invalid')
//                 $('#marcaFeedback').text(data.error.marca)
//                 $('#modelo_name').removeClass('is-invalid')
//             }
//             if(data.error.modelo!=undefined) {
//                 $('#modelo_name').removeClass('is-invalid')
//                 $('#marcaFeedback').text(data.error.modelo)
//                 $('#modelo_name').addClass('is-invalid')
//             }
//         } else {
//             $('#marca').removeClass('is-invalid')
//             $('#modelo_name').removeClass('is-invalid')
//             cargaMarcas(data.marca.id, data.modelo.id)
//             //$('#brand_id').val(data.marca.id)
//             //cargaModelos(data.modelo.id)
//             //$('#modelo_id').val(data.modelo.id)
//             $('#marcaModal').modal('hide')
//         }
//     })
// }

// function calcTotal () {
//     var with_tax = false
//     if ($('#with_tax').val() == 1) {
//         with_tax = true
//     }
//     var gross_value = 0 // Valor Bruto, suma de subtotales
//     var gross_precio = 0 // Precio Bruto, suma de subtotales
//     var d_items = 0
//     var subtotal = 0
//     var total = 0
//     var q,p,d1,d2,t,pu;
//     $('#tableItems tr').each(function (index, vtr) {
//         if (!($(vtr).find('.isdeleted').is(':checked'))) {
//             q = parseFloat($(vtr).find('.txtCantidad').val())
//             v = parseFloat($(vtr).find('.txtValue').val())
//             p = parseFloat($(vtr).find('.txtPrecio').val())
//             // v = p * 100 / (100 + 18);
//             // v = parseFloat($(vtr).find('.txtValue').val());
//             d1 = parseFloat($(vtr).find('.txtDscto').val())
//             d2 = parseFloat($(vtr).find('.txtDscto2').val())
//             vt = Math.round(q*v*(100-d1)*(100-d2)/100) / 100 // total por item
//             t = Math.round(q*p*(100-d1)*(100-d2)/100) / 100
//             console.log(vt)
//             console.log(t)
//             discount = Math.round(100*q*v)/100 - vt

//             gross_value += Math.round(100*q*v)/100
//             gross_precio += Math.round(100*q*p)/100
//             d_items += discount
//             subtotal += vt
//             total += t
//             // gross_value = (Math.round(q*v*100)/100) + gross_value;
//             // discount = (Math.round(q*v*d)/100) + discount;
//             // subtotal = gross_value - (Math.round(q*v*d)/100) + subtotal;
//         }
//     });
//     gross_value = Math.round(100 * gross_value) / 100
//     gross_precio = Math.round(100 * gross_precio) / 100
//     subtotal = Math.round(100 * subtotal) / 100
//     total = Math.round(100 * total) / 100
//     if (with_tax) {
//         subtotal = Math.round(10000 * total / 118) / 100
//         gross_value = Math.round(10000 * gross_precio / 118) / 100
//         d_items = gross_value - subtotal
//         // gross_value = Math.round(subtotal*1000000/((100-d1)*(100-d2))) / 100
//     } else {
//         total = Math.round(118 * subtotal) / 100
//     }
//     // if ($('#with_tax').val() == 1){
//     //  subtotal = Math.round(total * 10000 / (100 + 18)) / 100;
//     // } else {
//     //  total = Math.round(subtotal * (100 + 18))/100;
//     // }
//     // discount = (gross_value - subtotal);


//     $('#mGrossValue').text(gross_value.toFixed(2))
//     $('#mDiscount').text(d_items.toFixed(2))
//     $('#mSubTotal').text(subtotal.toFixed(2))
//     $('#mTotal').text(total.toFixed(2))
// }

function calcTotal () {
    var with_tax = false
    if ($('#with_tax').val() == 1) {
        with_tax = true
    }
    var gross_value = 0 // Valor Bruto, suma de subtotales
    var gross_precio = 0 // Precio Bruto, suma de subtotales
    var d_items = 0
    var subtotal = 0
    var total = 0
    var q,p,d1,d2,t,pu;
    $('#tableItems tr').each(function (index, vtr) {
        if (!($(vtr).find('.isdeleted').is(':checked'))) {
            q = parseFloat($(vtr).find('.txtCantidad').val())
            // v = parseFloat((($(vtr).find('.txtPrecio').val()*100)/118).toFixed(6))
            // p = parseFloat($(vtr).find('.txtPrecio').val())
            v = parseFloat($(vtr).find('.txtValue').val())
            p = parseFloat((($(vtr).find('.txtValue').val()*118)/100).toFixed(6))
            // v = p * 100 / (100 + 18);
            // v = parseFloat($(vtr).find('.txtValue').val());
            d1 = parseFloat(window.descuento1)
            _d1 = Math.round(q*v*d1*10000)/1000000
            d2 = parseFloat($(vtr).find('.txtDscto2').val())
            _d2 = Math.round((q*v-_d1)*d2*10000)/1000000
            discount = Math.round(1000000*(_d1 + _d2))/1000000
            vt = Math.round(1000000*(q*v-discount))/1000000 // total por item
            t = Math.round(1180000*(q*v-discount))/1000000
            $(vtr).find('.txtTotal').text( vt.toFixed(2) )
            $(vtr).find('.txtPriceItem').text( t.toFixed(2) )
            // console.log(`cantidad: ${q}, valor: ${v}, precio: ${p}, d1: ${_d1}, d2: ${_d2}, descuento: ${discount} ValorItem: ${vt}, PrecioTotal: ${t}`)


            gross_value += Math.round(100*q*v)/100
            gross_precio += Math.round(100*q*p)/100
            d_items += discount
            // subtotal += vt
            total += t
        }
    })
    d_items = Math.round(100*d_items)/100
    gross_value = Math.round(100 * gross_value) / 100
    gross_precio = Math.round(100 * gross_precio) / 100
    subtotal = Math.round(100*(gross_value - d_items))/100
    //console.log(`vbruto: ${gross_value}, descuentos: ${d_items}, subtotal: ${subtotal}, total: ${total}`)
    // subtotal = Math.round(100 * subtotal) / 100
    // total = Math.round(100 * total) / 100
    if (with_tax) {
        // subtotal = Math.round(10000 * total / 118) / 100
        // gross_value = Math.round(10000 * gross_precio / 118) / 100
        d_items = gross_value - subtotal
    } else {
        // total = Math.round(118 * subtotal) / 100
    }

    $('#mGrossValue').text(gross_value.toFixed(2))
    $('#mDiscount').text(d_items.toFixed(2))
    $('#mSubTotal').text(subtotal.toFixed(2))
    $('#mIgv').text((total-subtotal).toFixed(2))
    $('#mTotal').text(total.toFixed(2))
}

function validateItem (myElement, id) {
    n = $(myElement).parent().parent().find(id).val()
    n = Math.round(parseFloat(n)*100)/100
    if (isNaN(n)) {n=0.00}
    $(myElement).parent().parent().find(id).val(n.toFixed(2))
    if (id=='.txtDscto') {window.descuento1 = n.toFixed(2)}
    if (id=='.txtDscto2') {window.descuento2 = n.toFixed(2)}
    return n
}

// function calcTotalItem (myElement) {
//     var with_tax = false
//     if ($('#with_tax').val() == 1) {
//         with_tax = true
//     }
//     cantidad = validateItem(myElement,'.txtCantidad')
//     precio = validateItem(myElement,'.txtPrecio')
//     value = validateItem(myElement,'.txtValue')
//     dscto = validateItem(myElement,'.txtDscto')
//     dscto2 = validateItem(myElement,'.txtDscto2')
//     if ($(myElement).hasClass('txtPrecio')) {
//         $(myElement).parent().parent().find('.txtValue').val( (precio/1.18).toFixed(2) )
//         value = validateItem(myElement,'.txtValue')
//     } else if($(myElement).hasClass('txtValue')) {
//         $(myElement).parent().parent().find('.txtPrecio').val( (value*1.18).toFixed(2) )
//         precio = validateItem(myElement,'.txtPrecio')
//     }
//     if (with_tax) {
//         price_item = Math.round((cantidad*precio)*(100-dscto)*(100-dscto2)/100)/100;
//         total = Math.round(price_item*10000/118)/100
//     } else {
//         total = Math.round((cantidad*value)*(100-dscto)*(100-dscto2)/100)/100;
//         price_item = Math.round(total*118)/100
//     }
//     console.log("with_tax: "+with_tax)
//     console.log("Valor Item: "+total)
//     console.log("Precio Item: "+price_item)
//     // D = Math.round(cantidad * value * dscto) / 100;
//     D = Math.round(cantidad * value - total) / 100
//     // total = Math.round((cantidad*value-D)*100)/100;
//     $(myElement).parent().parent().find('.txtTotal').text( total.toFixed(2) )
//     $(myElement).parent().parent().find('.txtPriceItem').text( price_item.toFixed(2) )
// }
 
function calcTotalItem (myElement) {
    q = parseFloat($('#txtCantidad').val())
    v = parseFloat($('#txtValue').val())
    p = parseFloat((v*118/100).toFixed(6))
    d1 = parseFloat(window.descuento1)
    d2 = parseFloat($('#txtDscto2').val())
    if (isNaN(d1)) {
        window.descuento1 = 0
        d1 = window.descuento1
    }
    if (isNaN(q)) {
        q = 1
        $('#txtCantidad').val(q)
    }
    if (isNaN(v)) {
        v = 0
        $('#txtValue').val(v)
    }
    if (isNaN(d2)) {
        d2 = 0
        $('#txtDscto2').val(d2)
    }
    vt = 100*Math.round(q*v*(100-d1)*(100-d2))/1000000 // total por item
    t = 100*Math.round(q*p*(100-d1)*(100-d2))/1000000
    //console.log(`q: ${q}, v: ${v}, p: ${p}, d1: ${d1}, d2: ${d2}, vt: ${vt}, t: ${t}`)
    $('#txtTotal').val( vt.toFixed(2) )
    $('#txtPriceItem').val( t.toFixed(2) )
    $('#spanValueItem').text( vt.toFixed(2) )
    $('#spanPriceItem').text( t.toFixed(2) )
}

// function addRowProduct(data='') {
//     var items = $('#items').val()
//     if (items>0) {
//         if ($("input[name='details["+(items-1)+"][product_id]']").val() == "") {
//             $("input[name='details["+(items-1)+"][txtProduct]']").focus()
//         } else{
//             renderTemplateRowProduct(data)
//         };
//     } else{
//         renderTemplateRowProduct(data)
//     };
//     if ($('#with_tax').val() == 1){
//         $('.withTax').show()
//         $('.withoutTax').hide()
//     } else {
//         $('.withTax').hide()
//         $('.withoutTax').show()
//     }
// }

function renderTemplateRowProduct (data) {
    if (data != "") {
        ele = document.getElementById("tableItems").lastElementChild.querySelector("[data-product]");
        if (!isDesignEnabled(ele, data.id)) {return true}
    }
    var clone = activateTemplate("#template-row-item")
    var items = $('#items').val()
    clone.querySelector("[data-productid]").setAttribute("name", "details[" + items + "][product_id]")
    clone.querySelector("[data-unitid]").setAttribute("name", "details[" + items + "][unit_id]")
    clone.querySelector("[data-categoryid]").setAttribute("name", "details[" + items + "][category_id]")
    clone.querySelector("[data-subcategoryid]").setAttribute("name", "details[" + items + "][sub_category_id]")
    clone.querySelector("[data-is_downloadable]").setAttribute("name", "details[" + items + "][is_downloadable]")
    clone.querySelector("[data-product]").setAttribute("name", "details[" + items + "][txtProduct]")
    clone.querySelector("[data-cantidad]").setAttribute("name", "details[" + items + "][quantity]")
    clone.querySelector("[data-precio]").setAttribute("name", "details[" + items + "][price]")
    clone.querySelector("[data-value]").setAttribute("name", "details[" + items + "][value]")
    clone.querySelector("[data-dscto]").setAttribute("name", "details[" + items + "][d1]")
    clone.querySelector("[data-dscto2]").setAttribute("name", "details[" + items + "][d2]")
    // clone.querySelector("[data-isdeleted]").setAttribute("name", "details[" + items + "][is_deleted]")
    if (items>0) {$("input[name='details["+(items-1)+"][txtProduct]']").attr('disabled', true)}
    
    items = parseInt(items) + 1
    $('#items').val(items)
    $("#tableItems").append(clone)
    el = document.getElementById("tableItems").lastElementChild.querySelector("[data-product]")
    if (data != '') {
        setRowProduct(el, data)
    }

    $("input[name='details["+(items-1)+"][txtProduct]']").focus()
}
function renderTemplateRowAttribute () {
    var clone = activateTemplate("#template-row-attribute");
    var items = $('#items-attribute').val()
    clone.querySelector("[data-name]").setAttribute("name", "attributes[" + items + "][name]")
    clone.querySelector("[data-value]").setAttribute("name", "attributes[" + items + "][value_1]")
    clone.querySelector("[data-isdeleted]").setAttribute("name", "attributes[" + items + "][is_deleted]")
    //if (items>0) {$("input[name='accessories["+(items-1)+"][name]']").attr('disabled', true);};
    
    $("#tbodyAttributes").append(clone)
    items = parseInt(items) + 1
    $('#items-attribute').val(items)
}

function addRowBranch() {
    var items = $('#items').val()
    if (items>0) {
        if ($("input[name='branches["+(items-1)+"][name]']").val() == "") {
            console.log('en el segundo if')
            $("input[name='branches["+(items-1)+"][name]']").focus()
        } else if ($("input[name='branches["+(items-1)+"][address]']").val() == "") {
            $("input[name='branches["+(items-1)+"][address]']").focus()
        } else if ($("input[name='branches["+(items-1)+"][ubigeo_code]']").val() == "") {
            $("input[name='branches["+(items-1)+"][ubigeo]']").focus()
        } else{
            renderTemplateRowBranch()
        }
    } else{
        renderTemplateRowBranch()
    }
}

function renderTemplateRowBranch () {
    var clone = activateTemplate("#template-row-item");
    var items = $('#items').val()
    clone.querySelector("[data-branchId]").setAttribute("name", "branches[" + items + "][branch_id]")
    clone.querySelector("[data-ubigeoId]").setAttribute("name", "branches[" + items + "][ubigeo_code]")
    clone.querySelector("[data-name]").setAttribute("name", "branches[" + items + "][company_name]")
    clone.querySelector("[data-address]").setAttribute("name", "branches[" + items + "][address]")
    clone.querySelector("[data-ubigeo]").setAttribute("name", "branches[" + items + "][ubigeo]")
    clone.querySelector("[data-mobile]").setAttribute("name", "branches[" + items + "][mobile]")
    clone.querySelector("[data-contact]").setAttribute("name", "branches[" + items + "][contact]")
    clone.querySelector("[data-isdeleted]").setAttribute("name", "branches[" + items + "][is_deleted]")
    //if (items>0) {$("input[name='branches["+(items-1)+"][txtProduct]']").attr('disabled', true);};
    
    items = parseInt(items) + 1
    $('#items').val(items);
    $("#tableItems").append(clone)

    $("input[name='branches["+(items-1)+"][name]']").focus()
}

function getDataPadron (doc, type) {
    urls = {"1":`https://dniruc.apisperu.com/api/v1/dni/${doc}?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im5vZWwubG9nYW5AZ21haWwuY29tIn0.pSSHu1Rh3RUgPubnjemiDNyMAN0ZjgTCXaupa8VsEYY`, "6":`https://dniruc.apisperu.com/api/v1/ruc/${doc}?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im5vZWwubG9nYW5AZ21haWwuY29tIn0.pSSHu1Rh3RUgPubnjemiDNyMAN0ZjgTCXaupa8VsEYY`}
    $.get(urls[type], function(data){
        if (data) {
            if (type=='6') {
                $('#company_name').val(data.razonSocial)
                if (data.hasOwnProperty('ubigeo')) {
                    $('#address').val(data.direccion.replace(` ${data.departamento} ${data.provincia} ${data.distrito}`, ''))
                    $('#departamento').val(data.departamento)
                    $('#provincia').val(data.provincia)
                    $('#ubigeo_code').val(data.ubigeo)
                }
            } else {
                $('#paternal_surname').val(data.apellidoPaterno)
                $('#maternal_surname').val(data.apellidoMaterno)
                $('#name').val(data.nombres)
            }
            //console.log(data)
        }
    });
}

function changeIdType() {
    var id_type = $('#id_type').val()
    if (['1','4','7','A'].indexOf(id_type)!=-1) {
        $("#company_name").removeAttr("required", "required")
        $("#paternal_surname").attr("required", "required")
        // $("#maternal_surname").attr("required", "required")
        $("#name").attr("required", "required")

        $("#company_name").parent().parent().addClass("d-none")
        $("#brand_name").parent().parent().addClass("d-none")
        $("#paternal_surname").parent().parent().removeClass("d-none")
        $("#maternal_surname").parent().parent().removeClass("d-none")
        $("#name").parent().parent().removeClass("d-none")
    } else if (['6','-','0'].indexOf(id_type)!=-1){
        $("#company_name").attr("required", "required")
        $("#paternal_surname").removeAttr("required", "required")
        // $("#maternal_surname").removeAttr("required", "required")
        $("#name").removeAttr("required", "required")

        $("#company_name").parent().parent().removeClass("d-none")
        $("#brand_name").parent().parent().removeClass("d-none")
        $("#paternal_surname").parent().parent().addClass("d-none")
        $("#maternal_surname").parent().parent().addClass("d-none")
        $("#name").parent().parent().addClass("d-none")
    }
}


/*cargar provincias*/
function cargaProvincias(){
    var $dep = $('#departamento')
    var $pro = $('#provincia')
    var $dis = $('#ubigeo_code')
    var page ="/listarProvincias/" + $dep.val()
    if ($dep.val()=="") {
        $pro.empty("")
        $dis.empty("")
    } else {
        $.get(page, function(data){
            $pro.empty();
            $pro.append("<option value=''>Seleccionar</option>");
            $.each(data, function (index, ProvinciaObj) {
                $pro.append("<option value='"+ProvinciaObj.provincia+"'>"+ProvinciaObj.provincia+"</option>")
            });
        });
    }
}

/*cargar distritos*/
function cargaDistritos(){
    var $dep = $('#departamento')
    var $pro=$('#provincia')
    var $dis=$('#ubigeo_code')
    var page = "/listarDistritos/" + $dep.val() + "/" + $pro.val()
    if ($pro=='') {
        $dis.empty("")
    } else {
        $.get(page, function(data){
            $dis.empty()
            $dis.append("<option value=''>Seleccionar</option>");
            $.each(data, function (index, DistritoObj) {
                $dis.append("<option value='"+DistritoObj.code+"'>"+DistritoObj.distrito+"</option>")
            })
        })

    }
}

function changeCountry() {
    var country = $('#country').val()
    if (country == 'PE') {
        $('#departamento').attr( "required", "required" )
        $('#provincia').attr( "required", "required" )
        $('#ubigeo_code').attr( "required", "required" )

        $('#field_departamento').parent().show()
        $('#field_provincia').parent().show()
        $('#field_ubigeo_code').parent().show()
    } else {
        $('#departamento').removeAttr( "required" )
        $('#provincia').removeAttr( "required" )
        $('#ubigeo_code').removeAttr( "required" )

        $('#field_departamento').parent().hide()
        $('#field_provincia').parent().hide()
        $('#field_ubigeo_code').parent().hide()
    }
}
// function activateTemplate (id) {
//     var t = document.querySelector(id)
//     return document.importNode(t.content, true)
// }
function getCar() {
    placa = $('#placa').val().trim()
    url = `/getCar/${placa}`
    if (placa!='') {
        $.get(url, function(data){
            if (data.id) {
                // console.log(data.company.company_name)
                $('#car_id').val(data.id)
                $('#client_id').val(data.company_id)
                // $('#my_company').val(data.my_company)
                $('#txtbrand').val(data.modelo.brand.name)
                $('#txtmodelo').val(data.modelo.name)
                $('#txtyear').val(data.year)
                $('#txtcolor').val(data.color)
                $('#txtvin').val(data.vin)
                $('#txtcompany_name').val(data.company.company_name)
                $('#txtdoc').val(data.company.doc)
                $('#txtphone').val(data.company.phone)
                $('#txtmobile').val(data.company.mobile)
                $('#txtemail').val(data.company.email)
                $('#inventory_contact_name').val(data.contact_name)
                $('#inventory_contact_mobile').val(data.contact_mobile)
                $('#inventory_contact_email').val(data.contact_email)
                $('#inventory_driver_name').val(data.driver_name)
                $('#inventory_driver_mobile').val(data.driver_mobile)
                $('#inventory_driver_email').val(data.driver_email)
                $('#inventory_operator_company').val(data.operator_company)
                $('#inventory_operator_name').val(data.operator_name)
                $('#inventory_operator_mobile').val(data.operator_mobile)
            } else {
                // Si no existe el input company_name (diferente a una cita), se blanquea los campos para agregar una placa que si existe en la BD.
                if ($('#company_name').val().length == 0) {
                    // alert("Placa no registrada en el sistema")
                    $('#txtplaca').val($('#placa').val())
                    $('#txtplaca').val($('#placa').val()).trigger('keyup')
                    $('#spanPlaca').text($('#placa').val())
                    $('#placa').val('')
                    $('#placa').focus()
                    $('#confirmCrearCar').modal('show');
                }
            }
        });
    }
}
function checkCar() {
    placa = $('#txtplaca').val().trim()
    url = `/getCar/${placa}`
    if (placa!='') {
        $.get(url, function(data){
            if (data.id) {
                alert("La Placa ya está registrada en el sistema")
                $('#txtplaca').val('')
                $('#txtplaca').focus()
            }
        });
    }
}

    </script>
    </body>
</html>
