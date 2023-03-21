<?php

use App\Models\Listing;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
Route::middleware(['guest'])->group(function () {
    // Listing home
    Route::get('/', [ListingController::class, 'index'])
        ->name('listings');
    // show listing
    Route::get('/listings/{listing}', [ListingController::class, 'show'])
        ->name('listing-show');

    // user 
    Route::get('/register', [UserController::class, 'create'])
        ->name('register');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users-store');

    Route::get('/login', [UserController::class, 'login'])
        ->name('login');

    Route::post('/authenticate', [UserController::class, 'authenticate'])
        ->name('authenticate');
});

ROute::middleware(['auth'])->group(function () {
    // Manage listings
    Route::get('/listings/manage', [ListingController::class, 'manage'])
        ->name('listing-manage');
    // show create a list form
    Route::get('/create', [ListingController::class, 'create'])
        ->name('listing-create');
    // create a listing
    Route::post('/listings', [ListingController::class, 'store'])
        ->name('listing-store');
    // show edit listing page
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
        ->name('listing-edit');
    // edit listing
    Route::put('/listings/{listing}', [ListingController::class, 'update'])
        ->name('listing-update');
    // delete a listing
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
        ->name('listing-destroy');

    // logout user
    Route::post('/logout', [UserController::class, 'logout'])
        ->middleware(['auth'])
        ->name('logout');
});
