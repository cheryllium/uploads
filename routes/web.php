<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadsController;
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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/dashboard', [UploadsController::class, 'dashboard'])->name('dashboard'); 
    
    Route::get('/upload-image', function () { return view('image.upload'); })->name('image.upload');
    Route::post('/upload-image', [UploadsController::class, 'storeImage'])->name('image.upload.process');

    Route::get('/view-image/{uuid}', [UploadsController::class, 'viewImage'])->name('image.view');
    Route::post('/delete-image/{uuid}', [UploadsController::class, 'deleteImage'])->name('image.delete'); 
});
