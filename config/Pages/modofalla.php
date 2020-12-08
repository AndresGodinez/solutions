<?php

return [
	'view' =>
	[
		'index'  =>
		[
			'title'    => 'Filtros de Modo de Falla',
			'subtitle' => 'Preguntas existentes',
			'form'     =>
			[
				'fail'     => 'Modo de Falla',
				'line'     => 'Línea del Producto',
				'type'     => 'Tipo de Información',
				'button'   => 'Buscar',
			],
			'popup' =>
			[
				'title_edit'     => 'Edición de pregunta.',
				'label_question' => 'Pregunta',
                'label_comment'  => 'Comentario',
                'label_file'     => 'Archivo Adjunto',
                'label_tipo'     => 'Tipo de control',
                'cancel'         => 'Cancelar',
				'button'         => 'Actualizar',
			],
		],
		'create'   =>
		[
			'title'    => 'Modo de Falla',
			'subtitle' => 'Edicion de Modo de Falla',
			'form_new'     =>
			[
				'title'    => 'Nuevo modo de falla',
				'subtitle' => 'Crear un nuevo modo de falla',
			],
		],
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
		],
		'controls' =>
		[
			'empty_select' => 'Seleccione',
		],
	],
];
