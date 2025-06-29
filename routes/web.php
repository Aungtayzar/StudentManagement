<?php

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PaymenttypeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\RelativesController;
use App\Http\Controllers\ReligionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TownshipsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\WarehousesController;
use App\Models\Township;

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

// Route::get('/register/step1',[RegisteredUserController::class,'createstep1'])->name('register.step1');
// Route::post('/register/step1',[RegisteredUserController::class,'storestep1'])->name('register.storestep1');

// Route::get('/register/step2',[RegisteredUserController::class,'createstep2'])->name('register.step2');
// Route::post('/register/step2',[RegisteredUserController::class,'storestep2'])->name('register.storestep2');

// Route::get('/register/step3',[RegisteredUserController::class,'createstep3'])->name('register.step3');
// Route::post('/register/step3',[RegisteredUserController::class,'storestep3'])->name('register.storestep3');

Route::middleware('auth')->group(function () {

    Route::resource('/posts',PostsController::class);
    Route::resource('/relatives',RelativesController::class);

    
    Route::delete('/announcementsbulkdeletes',[AnnouncementsController::class,'bulkdeletes'])->name("announcements.bulkdeletes");
    Route::resource('/announcements',AnnouncementsController::class);

    Route::delete('/countriesbulkdeletes',[CountriesController::class,'bulkdeletes'])->name("countries.bulkdeletes");
    Route::resource('/countries',CountriesController::class);

    Route::delete('/regionsbulkdeletes',[RegionsController::class,'bulkdeletes'])->name("regions.bulkdeletes");
    Route::resource('/regions',RegionsController::class);

    Route::delete('/citiesbulkdeletes',[CitiesController::class,'bulkdeletes'])->name("cities.bulkdeletes");
    Route::resource('/cities',CitiesController::class);

    Route::delete('/townshipsbulkdeletes',[TownshipsController::class,'bulkdeletes'])->name("townships.bulkdeletes");
    Route::resource('/townships',TownshipsController::class);
    
    Route::delete('/contactsbulkdeletes',[ContactsController::class,'bulkdeletes'])->name("contacts.bulkdeletes");
    Route::resource('/contacts',ContactsController::class);

    Route::resource('/leads',LeadsController::class);
    Route::post('/leads/pipeline/{id}',[LeadsController::class, 'converttostudent'])->name('leads.converttostudent');

    Route::resource('/leaves',LeavesController::class);
    Route::put('/leave/{id}/updatestage',[LeavesController::class, 'updatestage'])->name('leaves.updatestage');

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
