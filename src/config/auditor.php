<?php

return [
	
	/*
    |--------------------------------------------------------------------------
    | Auditor Configuration
    |--------------------------------------------------------------------------
    */

    // Set this to global enable/disable of auditor
	'enable' => env('AUDITOR', false),
	
	// Avalaible mode: 
	//  'default' -> Directly execute after modify data 
	//  'job'     -> Send to queue to execute later
	'mode'   => env('AUDITOR_MODE', 'default'),

	// Max job attempt (for auditor job mode)
	'tries' => 1,

	//connection
	'connection' => env('DB_CONNECTION'),

	//middleware
	'middleware' => null
];