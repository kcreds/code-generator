<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/codes');

//Główne ścieżki logowania/rejestracji
Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/codes', [CodeController::class, 'index'])->name('code.index');
    Route::get('/codes/create', [CodeController::class, 'createCode'])->name('code.create');
    Route::post('/codes/store', [CodeController::class, 'storeCode'])->name('code.store');
    Route::get('/codes/delete', [CodeController::class, 'deleteCode'])->name('codes.delete.view');
    Route::delete('/codes/delete', [CodeController::class, 'deleteCodes'])->name('codes.delete');

    Route::delete('/codes/user/delete', [UserController::class, 'deleteUser'])->name('user.delete');
});
