<?php

return [
	'google' => [
		'client_id' => env('GOOGLE_CLIENT_ID'),
		'client_secret' => env('GOOGLE_CLIENT_SECRET'),
		'redirect' => env('GOOGLE_CLIENT_CALLBACK'),
		'hd' => env('GOOGLE_HD', '*'),
	]
];
