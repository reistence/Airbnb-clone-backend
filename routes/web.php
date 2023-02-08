<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\EstateController;
use App\Http\Controllers\User\PageController;
use App\Models\Estate;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->name('user.')->prefix('/user')->group(function(){
    Route::get('/',[PageController::class, 'index']);
    Route::resource('estates',EstateController::class)->parameters(['estates' => 'estate:slug']);
});


require __DIR__.'/auth.php';