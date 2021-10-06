<?php 
return array(
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
	'cambiar_precios' => 1,
	'precio_en_items' => [],
	'client_doc' =>[
		'6' => 'RUC',
		'1' => 'DNI',
		'-' => 'VARIOS',
		'4' => 'CEX',
		'7' => 'PAS',
		'A' => 'CÉDULA DIPLOMÁTICA',
		'0' => 'NO DOMICILIADO',
	],
	'employee_doc' =>[
		'1' => 'DNI',
		'4' => 'CEX',
		'7' => 'PAS',
	],
	'bodies' => ['COMPACT / HATCHBACK' => 'COMPACT / HATCHBACK', 'CONVERTIBLE' => 'CONVERTIBLE', 'COUPE' => 'COUPE', 'OFF-ROAD' => 'OFF-ROAD', 'OTRO' => 'OTRO', 'PICK UP' => 'PICK UP', 'SEDAN' => 'SEDAN', 'STATION WAGON' => 'STATION WAGON', 'SUV' => 'SUV', 'TRANSPORTER' => 'TRANSPORTER', 'VAN' => 'VAN', ],
	'payment_conditions' => ['1'=>'CONTADO', '2'=>'CRÉDITO', '3'=>'LETRA'],
	'unit_types' => ['UNIDAD', 'LONGITUD', 'VOLUMEN', 'MASA'],
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
	'quote_status_next' => [
		'PEND' => ['PEND', 'APROB', 'ANUL'],
		'APROB' => ['APROB', 'PEND'],
		'ANUL' => ['ANUL'],
		'CERR' => ['CERR'],
	],
	'order_status_next' => [
		'ENPRG' => ['ENPRG', 'COMP', 'CANC'],
		'COMP' => ['COMP', 'ENPRG'],
		'CANC' => ['CANC'],
		'CERR' => ['CERR']
	],
	'tax' => ['igv' => 18],
	'table_sunat' => [
		'tipo_comprobante' => [
			'1' => 'FACTURA',
			'3' => 'BOLETA',
			'7' => 'NOTA DE CRÉDITO',
			'8' => 'NOTA DE DÉBITO',
		],
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
			'NIU' => 'PRODUCTO',
			'ZZ' => 'SERVICIO',
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
	'bank_accounts' => [
		['label' => 'Cuenta Corriente Dólares Interbank',
			'number' => '631-3001268591',
			'cci' => '003-631-003001268591-90'
		],
		['label' => 'Cuenta Corriente Soles Interbank',
			'number' => '631-3001268584',
			'cci' => '003-631-003001268584-95'
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
	'types_service' => ['ACCESORIOS' => 'ACCESORIOS', 'BONIFICACIONES' => 'BONIFICACIONES', 'CAMPAÑA' => 'CAMPAÑA', 'CORRECTIVO' => 'CORRECTIVO', 'PREVENTIVO' => 'PREVENTIVO', 'SINIESTRO'=>'SINIESTRO'],
	'preventivos' => ['5K' => '5,000', '10K' => '10,000', '15K' => '15,000', '20K' => '20,000', '25K' => '25,000', '30K' => '30,000', '35K' => '35,000', '40K' => '40,000', '45K' => '45,000', '50K' => '50,000', '55K' => '55,000', '60K' => '60,000', '65K' => '65,000', '70K' => '70,000', '75K' => '75,000', '80K' => '80,000', '85K' => '85,000', '90K' => '90,000', '95K' => '95,000', '100K' => '100,000'],
);
