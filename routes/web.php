<?php

use App\Http\Controllers\TrainingController;
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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/trainings', [App\Http\Controllers\TrainingController::class, 'index'])->name('training:list')->middleware('auth');
Route::get('/training/{training}', [App\Http\Controllers\TrainingController::class, 'show'])->name('training:show');
Route::get('/training/{id}/edit', [App\Http\Controllers\TrainingController::class, 'edit'])->name('training:edit');
Route::get('/training/{training}/delete', [App\Http\Controllers\TrainingController::class, 'delete'])->name('training:delete');
Route::post('/training/{id}', [App\Http\Controllers\TrainingController::class, 'update'])->name('training:update');
Route::get('/trainings/create', [TrainingController::class, 'create'])->name('training:create');
Route::post('/trainings/create', [TrainingController::class, 'store']);
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth');
