<?php

use L5Swagger\Http\Controllers\SwaggerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return 'Laravel funciona ya basta';
});

Route::get('/api/documentation', [SwaggerController::class, 'api']);

