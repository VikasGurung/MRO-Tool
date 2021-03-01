<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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
    return view('auth.login');
});

Route::get('/dashboard', [ProjectController::class, 'index'])->name('projects')->middleware('auth');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects')->middleware('auth');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->middleware('auth');


require __DIR__.'/auth.php';
