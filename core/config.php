<?
return [

	// База данных
	'DB' => [
		'HOST' => 'localhost',
		'NAME' => 'tetcms',
		'USER' => 'root',
		'PASSWORD' => '',
		'PREFIX' => '' // Например 'tet_'
	],

	// Файлы
	'FILE' => [
		'CHMOD' => [
			'DIR' => 0755,
			'FILE' => 0644
		],
		'UPLOAD' => '/core/dev/files/',
	],

	// Пользователь
	'USER' => 'PASSWORD_ARGON2I',

	// Режим разработки
	'DEV_MODE' => 1,

];
