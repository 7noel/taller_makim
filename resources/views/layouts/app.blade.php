<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $favicon = data_get(session('my_company'), 'config.favicon');
        $logo = data_get(session('my_company'), 'config.logo');
    @endphp

    @if($favicon && \Storage::disk('public')->exists($favicon))
        <link rel="icon" type="image/jpeg" href="{{ \Storage::url($favicon) }}" />
    @else
        <link rel="icon" type="image/jpeg" href="/img/favicon.png" />
    @endif  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Condensed&family=Roboto&family=Roboto+Condensed&display=swap" rel="stylesheet">
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
    </style>
</head>
<body>
    <div id="app">
        <nav class="{{ config('options.styles.navbar') }}">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if($logo && \Storage::disk('public')->exists($logo))
                        <img src="{{ \Storage::url($logo) }}" alt="" height="50px">
                    @else
                        {{ config('app.name', 'Laravel') }}
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    @inject('menu','App\Http\Controllers\MenuController')
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                @if( !Auth::guest() )

                    @foreach($menu->links() as $modulo => $links)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $modulo }}</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($links as $link)
                                @if(isset($link['div']))
                                <div class="dropdown-divider"></div>
                                @endif
                                @if(isset($link['route']))
                                <a class="dropdown-item" href="{{ route($link['route']) }}">{{ $link['name'] }}</a>
                                @else
                                <a class="dropdown-item" href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                                @endif
                            @endforeach
                            </div>
                        </li>
                    @endforeach

                @endif

                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('companies.register') and 1==0)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('companies.register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('change_password') }}">Cambiar Contraseña</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
$(document).ready(function () {

    $('#placa').on('keyup', function (e) {
        let valor = $('#placa').val().toUpperCase()// Convertir a mayúsculas automáticamente
        
        // Filtrar caracteres no permitidos y limitar a 6 caracteres
        let nuevoValor = valor.replace(/[^A-Z0-9]/g, '').slice(0, 6);
        
        // Actualizar el valor del input si hubo modificaciones
        //if (valor !== nuevoValor) {
            $('#placa').val(nuevoValor)
        //}

        // console.log("Valor actual:", nuevoValor); // Para depuración en la consola

        // Validar estructura (1 letra + 4 o 5 alfanuméricos)
        let regex = /^[A-Z0-9]{5,6}$/;
        // let regex = /^[A-Z][A-Z0-9]{4,5}$/; //En caso de autos

        if (nuevoValor.length === 0) {
            $('#placa')[0].setCustomValidity(""); // No mostrar error si está vacío
        } else if (!regex.test(nuevoValor)) {
            $('#placa')[0].setCustomValidity("Debe comenzar con una letra y tener 5 o 6 caracteres alfanuméricos.");
        } else {
            $('#placa')[0].setCustomValidity("");
        }
    })
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
        if (event.key === "Enter") {
            event.preventDefault(); // Evita que el formulario se envíe
            return false;
        }
    })

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
            $('#txtProducto').focus()
        }, 500)
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
        setTimeout(function() {
            $('#modelo_name').focus();
        }, 500)
    })
    $("#btn-crear-marca").click(function(e){
        crearMarcaYModelo()
    })
    $("#btn-crear-modelo").click(function(e){
        crearModelo()
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
                if ($('#contact_phone').val().trim() == '') {$('#contact_phone').val(ui.item.phone)}
                if ($('#contact_mobile').val().trim() == '') {$('#contact_mobile').val(ui.item.mobile)}
            }
            $('#branch_id').empty()
            $('#branch_id').append(`<option value=''>Seleccionar</option>`)
            ui.item.branches.forEach(function (b) {
                $('#branch_id').append(`<option value='${b.id}'>${b.company_name}</option>`)
            })
            $('#branch_id').focus()
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
    $('#add_contact').change(function (e) {
        if ($('#add_contact').is(':checked')) {
            $('.contact').removeClass("d-none")
            $('#contact_name').attr("required", "required")
        } else {
            $('.contact').addClass( "d-none")
            $('#contact_name').removeAttr("required", "required")
        }
    })
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
    
    $('#type_service').on('change', updateTipoServicio);

    // 🔁 Ejecutar inmediatamente al cargar
    updateTipoServicio();

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
function updateTipoServicio() {
    const tipo = $('#type_service').val();

    const $preventivo = $('#preventivo').closest('.form-group');
    const $seguro = $('#seguro').closest('.form-group');

    if (tipo === 'PREVENTIVO') {
        $preventivo.removeClass('d-none');
        $seguro.addClass('d-none');
        $('#preventivo').attr('required', true);
        $('#seguro').removeAttr('required');
    } else if (tipo === 'SINIESTRO') {
        $preventivo.addClass('d-none');
        $seguro.removeClass('d-none');
        $('#preventivo').removeAttr('required');
        $('#seguro').attr('required', true);
    } else {
        $preventivo.addClass('d-none');
        $seguro.addClass('d-none');
        $('#preventivo, #seguro').removeAttr('required');
    }
}

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
        tr = `<tr>
            <input class="categoryId" name="details[${items}][category_id]" type="hidden" value="${cat}">
            <input class="subCategoryId" name="details[${items}][sub_category_id]" type="hidden" value="${sub_cat}">
            <input class="is_downloadable" name="details[${items}][is_downloadable]" type="hidden" value="${is_downloadable}">
            <input class="productId" name="details[${items}][comment]" type="hidden" value="${text_cat}">
            <input class="unitId" name="details[${items}][unit_id]" type="hidden" value="${u}">
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
                <a href="#" class="btn btn-outline-primary btn-sm btn-edit-item" title="Editar">{!! $icons['edit'] !!}</a>
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
        window.el.find('.txtCantidad').val(q)
        window.el.find('.spanCantidad').text(q+' '+u)
        window.el.find('.txtValue').val(v)
        window.el.find('.spanValue').text(v)
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

function ordenarTabla() {
    var filas = $("#tableItems tr").get();

    filas.sort(function(a, b) {
        var isDownloadableA = parseInt($(a).find(".is_downloadable").val()) || 0;
        var isDownloadableB = parseInt($(b).find(".is_downloadable").val()) || 0;

        var categoriaA = $(a).find(".spanCategory").text().trim().toLowerCase();
        var categoriaB = $(b).find(".spanCategory").text().trim().toLowerCase();

        // Ordenar primero por is_downloadable (0 antes que 1)
        if (isDownloadableA !== isDownloadableB) {
            return isDownloadableA - isDownloadableB;
        }

        // Si is_downloadable es igual, ordenar por categoría ascendente
        return categoriaA.localeCompare(categoriaB);
    });

    // Reinsertar solo si hubo cambios en el orden
    var ordenActual = $("#tableItems").children().map(function() {
        return $(this).data("id");
    }).get().join(",");

    var nuevoOrden = filas.map(row => $(row).data("id")).join(",");

    if (ordenActual !== nuevoOrden) {
        $("#tableItems").append(filas); // Solo reinsertar si cambia el orden
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
    $('#txtCodigo').text("")
    // $('#unitId').val("")
    $('#txtCantidad').val("0")
    $('#txtValue').val("0")
    $('#txtDscto2').val(window.descuento2)
    $('#txtTotal').val("0.00")
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
    $('#txtProducto').val(window.el.find('.spanProduct').text())
    $('#txtProduct').val(window.el.find('.spanProduct').text())
    $('#txtCodigo').text(window.el.find('.spanCodigo').text())
    $('#unitId').val(window.el.find('.unitId').val())
    $('#txtCantidad').val(window.el.find('.txtCantidad').val())
    $('#txtValue').val(window.el.find('.txtValue').val())
    $('#txtDscto2').val(window.el.find('.txtDscto2').val())
    $('#txtTotal').val(window.el.find('.txtTotal').text())
    $('#txtPriceItem').val(window.el.find('.txtPriceItem').text())
    $('#spanPriceItem').text(window.el.find('.txtPriceItem').text())
    $('#label-cantidad').text(window.el.find('.unitId').val())

    $('#exampleModalx').modal('show')
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
                console.log(data.company.company_name)
                $('#car_id').val(data.id)
                $('#company_id').val(data.company_id)
                // $('#my_company').val(data.my_company)
                $('#brand').val(data.modelo.brand.name)
                $('#modelo').val(data.modelo.name)
                $('#year').val(data.year)
                $('#color').val(data.color)
                $('#vin').val(data.vin)
                $('#company_name').val(data.company.company_name)
                $('#doc').val(data.company.doc)
                $('#phone').val(data.company.phone)
                $('#mobile').val(data.company.mobile)
                $('#email').val(data.company.email)
            } else {
                // Si no existe el input company_name (diferente a una cita), se blanquea los campos para agregar una placa que si existe en la BD.
                if ($('#company_name').val().length == 0) {
                    alert("Placa no registrada en el sistema")
                    $('#placa').val('')
                    $('#placa').focus()
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
    @yield('scripts')
</body>
</html>
