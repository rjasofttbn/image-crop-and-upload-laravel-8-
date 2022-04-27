<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CropImageController;
use App\Http\Controllers\CropImagenController;
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


//...
// https://onlinewebtutorblog.com/crop-image-before-upload-using-croppie-js-in-laravel-8/
Route::get('image-crop', [ImageController::class, "imageCrop"]);
Route::post('image-crop', [ImageController::class, "imageCropPost"])->name("imageCrop");
Route::get('/', function () {
    return view('welcome');
});


//https://www.nicesnippets.com/blog/laravel-8-cropper-js-crop-image-before-upload


Route::get('crop-image-upload', [CropImageController::class, 'index']);
Route::post('crop-image-upload', [CropImageController::class, 'uploadCropImage']);



Route::get('crop-image-uploadn', [CropImagenController::class, 'index']);
Route::post('crop-image-uploadn', [CropImagenController::class, 'uploadCropImage']);
