<?php

return [
	'title'    => 'Solicitud de información de Producto',
	'subtitle' => 'Información del producto',
	'table'    =>
	[
		'dispatch' => 'Dispatch',
		'model'    => 'Modelo',
		'serie'    => 'Serie',
		'brand'    => 'Marca',
		'problem'  => 'Descripción del Problema',

		'fail'     => 'Modo de Falla',
		'line'     => 'Línea del Producto',
		'type'     => 'Tipo de Información',
		'name'     => 'Nombre del Técnico',
		'phone'    => 'Teléfono del Técnico',

		'comment'  => 'Comentarios',
		'file'     => 'Adjuntar Archivo',

		'quotes'   => 'Casos resueltos',
		'info'     => 'Información del Servicio',

		// Buttons
		'doubt'    => 'Duda Resuelta',
        'save'     => 'Enviar Solicitud',

        'ingeniero' =>'Comentarios Ingeniero'

	],
	// Scripts Messages
	'scripts'  =>
	[
		'succcess'  =>
		[
			'without_data' => 'No se encontraron datos...',
			'no_info'      => 'Sin información de ayuda.',
		],
		'errors'  =>
		[
			'db'  => 'Error al cargar datos...',
		],
		'questions' =>
		[
			'form'     => 'Combinación Correcta',
			'without'  => 'Sin preguntas asignadas',
			'succcess' => 'Por favor contesta las preguntas correspondientes.',
			'error'    => 'Por favor selecciona otra combinación',
		],
		'form'    =>
		[
			'success'  => 'Solicitud creada',
			'error'    => 'Error al guardar solicitud...',
			'invalid'  => 'Por favor llena todos los campos solicitados...',
		],
		'notifications' =>
		[
			'title' =>
			[
				'form'    => 'Solicitud', // success with send form
				'success' => '',
				'error'   => 'Error',
			]
		],
	],
	'index_view' =>
	[
		'title'    => 'Solicitud de información de ingeniería',
		'subtitle' => 'Ingrese su número de DISPATCH',
		'button'   => 'Enviar',
    ],
    'fileError'=>'Hubo un error en la carga, intente de nuevo.'
];


