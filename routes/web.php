<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PaymenttypeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReligionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\WarehousesController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('/posts',PostsController::class);
    Route::resource('/leaves',LeavesController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/categories',CategoryController::class);
    Route::resource('/days',DayController::class);
    Route::resource('/genders',GenderController::class);
    Route::resource('/paymenttypes',PaymenttypeController::class);
    Route::resource('/roles',RolesController::class);
    Route::resource('/religions',ReligionController::class);
    Route::resource('/statuses',StatusController::class);
    Route::resource('/stages',StageController::class);
    Route::resource('/types',TypesController::class);
    Route::resource('/tags',TagsController::class);
    Route::resource('/warehouses',WarehousesController::class);
    
});




require __DIR__.'/auth.php';
