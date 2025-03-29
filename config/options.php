<?php 
return array(
	'cia_seguros' => [
		'POSITIVA' => 'POSITIVA',
		'PACIFICO' => 'PACIFICO',
		'RIMAC' => 'RIMAC',
		'MAPFRE' => 'MAPFRE',
	],
	'combustible' => [
		'0' => 'RESERVA',
		'25' => '1/4',
		'50' => 'MEDIO',
		'75' => '3/4',
		'100' => 'FULL'
	],
	'tarjeta_propiedad' => [
		'FISICA' => 'FISICA',
		'VIRTUAL' => 'VIRTUAL',
		'NO' => 'NO'
	],
	'document_types' => [
		'01' => 'FACTURA ELECTRÓNICA',
		'03' => 'BOLETA ELECTRÓNICA',
		'07' => 'NOTA DE CRÉDITO',
		'08' => 'NOTA DE DÉBITO',
		'09' => 'GUÍA DE REMISIÓN REMITENTE',
		'80' => 'NOTA DE VENTA',
		'PD' => 'PEDIDO',
		'OT' => 'ORDEN DE TRABAJO',
		'CT' => 'COTIZAIÓN',
		'OC' => 'ORDEN DE COMPRA',
		'RQ' => 'REQUERIMIENTO',
		'TK' => 'TICKET',
		'20' => 'COMPROBANTE DE RETENCIÓN ELECTRÓNICA',
		'40' => 'COMPROBANTE DE PERCEPCIÓN ELECTRÓNICA',
		'04' => 'LIQUIDACIÓN DE COMPRA',
		'U2' => 'Guía de Ingreso Almacén',
		'U3' => 'Guía de Salida Almacén',
		'U4' => 'Guía de Transferencia Almacén'
	],
	'seller_id' => 35,
	'repairman_id' => 34,
	// 'styles' => [
	// 	'navbar'=>'navbar navbar-expand-md navbar-dark bg-dark shadow-sm',
	// 	'card_header' => 'card-header justify-content-between bg-dark text-white',
	// 	'table' => 'table table-hover table-sm',
	// 	'thead' => 'thead-dark',
	// ],
	'styles' => [
		'navbar'=>'navbar navbar-expand-md navbar-light bg-light shadow-sm',
		'card_header' => 'card-header justify-content-between bg-light',
		'table' => 'table table-hover table-sm',
		'thead' => '',
	],
	'config' => [
		'size' => ['A4'=>'TAMAÑO A4', 'A5'=>'TAMAÑO A5', 'TICKET'=>'TAMAÑO TICKET'],
		'size_2' => ['A4'=>'TAMAÑO A4', 'TICKET'=>'TAMAÑO TICKET'],
	],
	'config2' => ['my_web', 'logo', 'size_factura', 'size_boleta', 'size_retenciones', 'size_percepciones', 'nubefact_ruta', 'nubefact_token'],
	'tipo_calculo' => ['cantidad', 'v_unitario'],
	'months' => [1=>'Enero', 2=>'Febrero', 3=>'Marzo', 4=>'Abril', 5=>'Mayo', 6=>'Junio', 7=>'Julio', 8=>'Agosto', 9=>'Setiempre', 10=>'Octubre', 11=>'Noviembre', 12=>'Diciembre'],
	'cambiar_precios' => 1,
	'precio_en_items' => true,
	'client_doc' =>[
		'6' => 'RUC',
		'1' => 'DNI',
		// '-' => 'VARIOS',
		'4' => 'CEX',
		'7' => 'PAS',
		'A' => 'CÉDULA DIPLOMÁTICA',
		// '0' => 'NO DOMICILIADO',
	],
	'employee_doc' =>[
		'1' => 'DNI',
		'4' => 'CEX',
		'7' => 'PAS',
	],
	'bodies' => ['COMPACT / HATCHBACK' => 'COMPACT / HATCHBACK', 'COUPE' => 'COUPE', 'OFF-ROAD' => 'OFF-ROAD', 'OTRO' => 'OTRO', 'PICKUP' => 'PICKUP', 'SEDAN' => 'SEDAN', 'STATION WAGON' => 'STATION WAGON', 'SUV' => 'SUV', 'VAN' => 'VAN', ],
	'payment_conditions' => ['1'=>'CONTADO', '2'=>'CRÉDITO', '3'=>'LETRA'],
	'unit_types' => ['UNIDAD', 'LONGITUD', 'VOLUMEN', 'MASA', 'SERVICIO'],
	'entity_types' => ['my_company', 'client', 'provider', 'shipper', 'bank', 'employee'],
	'last_number' => [
		'1' => [// importaciones
			'1' => 0, //quote
			'2' => 0, //order
			'3' => 0, //letter
		],
		'2' => [// herramax
			'1' => 0, //quote
			'2' => 0, //order
			'3' => 0, //letter
		],
		'3' => [// miraldi
			'1' => 0, //quote
			'2' => 0, //order
			'3' => 0, //letter
		],
	],
	'product_status' => [''=>'Status', '1'=>'Activo', '3'=>'A pedido', '2'=>'Inactivo'],
	'proof_types' => ['Ninguno', 'issuance_vouchers', 'reception_vouchers', 'issuance_letters', 'reception_letters'],
	'mov' => ['Salida', 'Entrada'],
	'proof_status' => ['PEND' => 'PEND', 'ERROR' => 'ERROR', 'SUNAT' => 'SUNAT', 'PANUL' => 'PANUL', 'ANUL' => 'ANUL'],
	'quote_status' => ['PEND' => 'PEND', 'APROB' => 'APROB', 'ANUL' => 'ANUL', 'CERR' => 'CERR'],
	'order_status' => ['ENPRG' => 'ENPRG', 'COMP' => 'COMP', 'ANUL' => 'ANUL', 'CERR' => 'CERR'],

	'inventory_status' => ['PEND' => 'RECEPCION', 'DIAG' => 'DIAGNÓSTICO', 'REPU' => 'REPUESTOS', 'APROB' => 'APROBACION', 'REPAR' => 'REPARACIÓN', 'CONTR' => 'CONTROL DE CALIDAD', 'ENTR' => 'ENTREGA', 'ANUL' => 'ANULADO', 'CERR' => 'CERR'],
	'inventory_status_PEND' => ['DIAG' => 'DIAGNÓSTICO'],
	// 'inventory_status_DIAG' => ['REPU' => 'REPUESTOS'],
	'inventory_status_DIAG' => ['PREAP' => 'APROBACIÓN DEL SEGURO'],
	'inventory_status_PREAP' => ['APROB' => 'APROBACIÓN DEL CLIENTE'],
	'inventory_status_REPU' => ['APROB' => 'APROBACION'],
	// 'inventory_status_APROB' => ['DIAG' => 'DIAGNÓSTICO', 'REPU' => 'REPUESTOS', 'REPAR' => 'REPARACIÓN'],
	'inventory_status_APROB' => ['DIAG' => 'DIAGNÓSTICO', 'REPAR' => 'REPARACIÓN'],
	'inventory_status_REPAR' => ['CONTR' => 'CONTROL DE CALIDAD'],
	'inventory_status_CONTR' => ['REPAR' => 'REPARACIÓN', 'ENTR' => 'ENTREGA'],

	'appointment_status' => ['PEND' => 'PEND', 'EFECT' => 'EFECT', 'ANUL' => 'ANUL'],
	'tax' => ['igv' => 18],
	'table_sunat' => [
		'sunat_transaction' => [
			'1' => 'VENTA INTERNA',
			'2' => 'EXPORTACIÓN',
			// '3' => 'NO DOMICILIADO',
			'4' => 'VENTA INTERNA – ANTICIPOS',
			// '5' => 'VENTA ITINERANTE',
			// '6' => 'FACTURA GUÍA',
			// '7' => 'VENTA ARROZ PILADO',
			// '8' => 'FACTURA - COMPROBANTE DE PERCEPCIÓN',
			// '10' => 'FACTURA - GUÍA REMITENTE',
			// '11' => 'FACTURA - GUÍA TRANSPORTISTA',
			// '12' => 'BOLETA DE VENTA – COMPROBANTE DE PERCEPCIÓN',
			// '13' => 'GASTO DEDUCIBLE PERSONA NATURAL'
			'29' => 'VENTAS NO DOMICILIADOS QUE NO CALIFICAN COMO EXPORTACIÓN',
			'30' => 'OPERACIÓN SUJETA A DETRACCIÓN',
			'33' => 'DETRACCIÓN - SERVICIOS DE TRANSPORTE CARGA',
			'34' => 'OPERACIÓN SUJETA A PERCEPCIÓN',
		],
		'cliente_tipo_de_documento' =>[
			'6' => 'RUC - REGISTRO ÚNICO DE CONTRIBUYENTE',
			'1' => 'DNI - DOC. NACIONAL DE IDENTIDAD',
			'-' => 'VARIOS - VENTAS MENORES A S/.700.00 Y OTROS',
			'4' => 'CARNET DE EXTRANJERÍA',
			'7' => 'PASAPORTE',
			'A' => 'CÉDULA DIPLOMÁTICA DE IDENTIDAD',
			'0' => 'NO DOMICILIADO, SIN RUC (EXPORTACIÓN)',
		],
		'moneda' => [
			'1' => 'SOLES',
			'2' => 'DÓLARES',
		],
		'moneda_symbol' => [
			'1' => 'S/',
			'2' => 'US$',
		],
		'moneda_sunat' => [
			'1' => 'PEN',
			'2' => 'USD',
		],
		'percepcion_tipo'=>[
			'1' => 'PERCEPCIÓN VENTA INTERNA - TASA 2%',
			'2' => 'PERCEPCIÓN ADQUISICIÓN DE COMBUSTIBLE-TASA 1%',
			'3' => 'PERCEPCIÓN REALIZADA AL AGENTE DE PERCEPCIÓN CON TASA ESPECIAL - TASA 0.5%',
		],
		'tipo_de_nota_de_credito'=>[
			'1' => 'ANULACIÓN DE LA OPERACIÓN',
			'2' => 'ANULACIÓN POR ERROR EN EL RUC',
			'3' => 'CORRECCIÓN POR ERROR EN LA DESCRIPCIÓN',
			'4' => 'DESCUENTO GLOBAL',
			'5' => 'DESCUENTO POR ÍTEM',
			'6' => 'DEVOLUCIÓN TOTAL',
			'7' => 'DEVOLUCIÓN POR ÍTEM',
			'8' => 'BONIFICACIÓN',
			'9' => 'DISMINUCIÓN EN EL VALOR',
			'10' => 'OTROS CONCEPTOS',
			'11' => 'AJUSTES AFECTOS AL IVAP',
		],
		'tipo_de_nota_de_debito' => [
			'1' => 'INTERESES POR MORA',
			'2' => 'AUMENTO DE VALOR',
			'3' => 'PENALIDADES',
			'4' => 'AJUSTES AFECTOS AL IVAP',
		],
		'unidad_de_medida' => [
			'NIU' => 'Unidades',
			'DZN' => 'Docena',
			'CEN' => 'Ciento de Unidades',
			'MIL' => 'Millares',
			'PR' => 'Par',
			'SET' => 'Juego',
			'BX' => 'Caja',
			'LTR' => 'Litros',
			'GLL' => 'Galones',
			'GRM' => 'Gramos',
			'KGM' => 'Kilos',
			'MTR' => 'Metros',
			'RO' => 'Rollo',
			'ZZ' => 'Servicio',
			'HUR' => 'Hora',
		],
		'tipo_de_igv' => [
			'1' => 'Gravado - Operación Onerosa',
			'2' => 'Gravado – Retiro por premio',
			'3' => 'Gravado – Retiro por donación',
			'4' => 'Gravado – Retiro',
			'5' => 'Gravado – Retiro por publicidad',
			'6' => 'Gravado – Bonificaciones',
			'7' => 'Gravado – Retiro por entrega a trabajadores',
			'8' => 'Exonerado - Operación Onerosa',
			'9' => 'Inafecto - Operación Onerosa',
			'10' => 'Inafecto – Retiro por Bonificación',
			'11' => 'Inafecto – Retiro',
			'12' => 'Inafecto – Retiro por Muestras Médicas',
			'13' => 'Inafecto - Retiro por Convenio Colectivo',
			'14' => 'Inafecto – Retiro por premio',
			'15' => 'Inafecto - Retiro por publicidad',
			'16' => 'Exportación',
		],
		'tipo_de_ivap' => [
			'17' => 'IVAP Gravado',
			'101' => 'IVAP Gratuito',
		],
		'guia_tipo' => [
			'1' => 'GUÍA DE REMISIÓN REMITENTE',
			'2' => 'GUÍA DE REMISIÓN TRANSPORTISTA'
		]

	],
	'tipo_banco' => [
		1=>'Banco',
		2=>'Cuenta Corriente',
		3=>'Cuenta de Ahorros',
		4=>'Cuenta detracciones',
		5=>'Efectivo',
		6=>'Tarjeta de Crédito'
	],
	'metodos_pago' => [
		1=>'Efectivo',
		2=>'Transferencia',
		3=>'Cheque',
		4=>'Tarjeta de crédito',
		5=>'Tarjeta de Débito',
		6=>'Depósitos'
	],
	'types_service' => ['ACCESORIOS' => 'ACCESORIOS', 'BONIFICACIONES' => 'BONIFICACIONES', 'CAMPAÑA' => 'CAMPAÑA', 'CORRECTIVO' => 'CORRECTIVO', 'PREVENTIVO' => 'PREVENTIVO', 'SINIESTRO'=>'SINIESTRO', 'PLANCHADO Y PINTURA'=>'PLANCHADO Y PINTURA', 'GARANTIA POSTVENTA'=>'GARANTIA POSTVENTA', 'INTERNA POSTVENTA'=>'INTERNA POSTVENTA'],
	'preventivos' => ['5K' => '5,000', '10K' => '10,000', '15K' => '15,000', '20K' => '20,000', '25K' => '25,000', '30K' => '30,000', '35K' => '35,000', '40K' => '40,000', '45K' => '45,000', '50K' => '50,000', '55K' => '55,000', '60K' => '60,000', '65K' => '65,000', '70K' => '70,000', '75K' => '75,000', '80K' => '80,000', '85K' => '85,000', '90K' => '90,000', '95K' => '95,000', '100K' => '100,000', '105k' => '105,000', '110k' => '110,000', '115k' => '115,000', '120k' => '120,000', '125k' => '125,000', '130k' => '130,000', '135k' => '135,000', '140k' => '140,000', '145k' => '145,000', '150k' => '150,000', '155k' => '155,000', '160k' => '160,000', '165k' => '165,000', '170k' => '170,000', '175k' => '175,000', '180k' => '180,000', '185k' => '185,000', '190k' => '190,000', '195k' => '195,000', '200k' => '200,000', '205k' => '205,000', '210k' => '210,000', '215k' => '215,000', '220k' => '220,000', '225k' => '225,000', '230k' => '230,000', '235k' => '235,000', '240k' => '240,000', '245k' => '245,000', '250k' => '250,000', '255k' => '255,000', '260k' => '260,000', '265k' => '265,000', '270k' => '270,000', '275k' => '275,000', '280k' => '280,000', '285k' => '285,000', '290k' => '290,000', '295k' => '295,000', '300k' => '300,000'],
	'docs_mov' => [1 => 'Apertura', 2 => 'Ajuste de Inventario - Disminución', 3 => 'Entrada por Compra', 4 => 'Entrada por Producción', 5 => 'Salida por Consumo', 6 => 'Ajuste por inventario - Incremento'],
	'poll' => [
		'p1' => '¿Qué tan satisfecho está con el desempeño de su asesor de servicio?',
		'p2' => '¿Qué tan satisfecho está con la puntualidad en la entrega de su unidad?',
		'p3' => '¿Qué tan satisfecho quedo con la explicación por el valor del servicio realizado?',
		'p4' => 'Clasifique su satisfacción con el desempeño general',
		'p5' => '¿Continuaría trayendo su vehículo aquí para que le realicen el servicio?',
	],
	'docs_compras' => [ '1'=>'FACTURA', '2'=>'BOLETA', '3'=>'GUIA', '4'=>'NOTA DE ENTRADA', '5'=>'RECIBO POR HONORARIOS', '6'=>'SERVICIOS PÚBLICOS'],
	'inventory' => [
		'col_1' => [
			'Llave de contacto',
			'Llavero',
			'Tarjeta de Propiedad',
			'SOAT',
			'Libro de Servicio',
			'Manual de usuario',
			'Revisión técnica',
			'Máscara de Radio',
			'Radio',
			'Tapa sol',
			'Plumillas',
		],
		'col_2' => [
			'Seguro de Ruedas',
			'Seguro de Vasos',
			'Encendedor',
			'Cenicero',
			'Vasos de Rueda',
			'Gata',
			'Herramientas',
			'Pisos',
			'Tapices',
			'Escarpines',
			'Emblemas',

		],
		'col_3' => [
			'Llanta de repuesto',
			'Control de garaje',
			'Cable remolque',
			'Triángulo de seguridad',
			'Cable de batería',
			'Compresora de aire',
			'Antena',
		],
	]
);
