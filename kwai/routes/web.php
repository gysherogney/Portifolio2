<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KwaiController;
use App\Models\GraphicsUpload;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[KwaiController::class,'index']);
Route::post('/message_upload',[KwaiController::class,'create']);
Route::post('/graphics_upload',[KwaiController::class,'store']);
Route::get('edit/{id}',[KwaiController::class,'edit']);
Route::put('update/{id}',[KwaiController::class,'update']);
Route::get('delete/{id}',[KwaiController::class,'destroy']);


Route::get('/graphics_upload',[KwaiController::class,'show']);


Route::get('/dashboard', function () {
    $graphicsUpload =  GraphicsUpload::all();
    return view('dashboard',compact('graphicsUpload'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
