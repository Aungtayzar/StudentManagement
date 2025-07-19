<?php

use App\Http\Controllers\Api\AnnouncementsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\ContactsController;
use App\Http\Controllers\Api\CountriesController;
use App\Http\Controllers\Api\DaysController;
use App\Http\Controllers\Api\GendersController;
use App\Http\Controllers\Api\LeadsController;
use App\Http\Controllers\Api\LeavesController;
use App\Http\Controllers\Api\RegionsController;
use App\Http\Controllers\Api\TownshipsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/countries',CountriesController::class);
Route::apiResource('/announcements',AnnouncementsController::class);
Route::apiResource('/categories',CategoriesController::class); 

Route::apiResource('/cities',CitiesController::class); 
Route::get('/filter/cities/{filter}',[CitiesController::class,'filterbyregionid']); // dynamic select option by region_id

Route::apiResource('/contacts',ContactsController::class); 
Route::apiResource('/days',DaysController::class); 
Route::apiResource('/genders',GendersController::class); 
Route::apiResource('/leads',LeadsController::class); 
Route::apiResource('/leaves',LeavesController::class); 

Route::apiResource('/regions',RegionsController::class); 
Route::get('/filter/regions/{filter}',[RegionsController::class,'filterbycountryid']); // dynamic select option by country_id


Route::apiResource('/townships',TownshipsController::class); 
