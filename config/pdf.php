<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => 'PawSquad',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'PawSquad',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'font_path' => base_path('public/assets/clients/fonts/'),
    'font_data' => [
        'roboto' => [
            'R'  => 'Roboto-Regular.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
    ]
];
