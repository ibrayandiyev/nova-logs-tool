<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use KABBOUCHI\LogsTool\Http\Controllers\LogsController;

/*
|--------------------------------------------------------------------------
| Tool Routes
|--------------------------------------------------------------------------
|
| Here is where you may register Inertia routes for your tool. These are
| loaded by the ServiceProvider of the tool. The routes are protected
| by your tool's "Authorize" middleware by default. Now - go build!
|
*/

Route::get('/', LogsController::class);