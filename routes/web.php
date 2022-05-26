<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;

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

Route::get('/', [AgendaController::class, "index"])->name('index');

Route::get('/create', [AgendaController::class, "create"])->name('create');

Route::post('/store', [AgendaController::class, "store"])->name('store');

Route::get('/edit/{id}', [AgendaController::class, "edit"])->name('edit');

Route::put('/update/{id}', [AgendaController::class, "update"])->name('update');

Route::delete('/delete/{id}', [AgendaController::class, "delete"])->name('delete');
