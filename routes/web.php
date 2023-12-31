<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return [
        'ver' => app()->version(),
        'web' => true
    ];
});

Route::get('/test', function () {
    return [
        'test' => 'some info',
    ];
});

