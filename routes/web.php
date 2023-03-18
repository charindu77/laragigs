<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\AuthenticationController;

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
    // Route::as('listings.')->group(function(){
    //     Route::resource('listings',ListingController::class)->only(['index','show']);
    // });
    Route::get('/', [ListingController::class, 'index'])
        ->name('listings');
    // user 
    Route::view('/register', 'users.create-user')->name('register');
    Route::view('/login', 'users.login-user')->name('login');

    // show listing
    Route::get('/listings/{listing}', [ListingController::class, 'show'])
        ->name('listing-show');

    Route::post('/authenticate', AuthenticationController::class)
        ->name('users.authenticate');

    Route::post('/users', RegistrationController::class)
        ->name('users.store');
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
    Route::post('/logout', LogoutController::class)
        ->name('users.logout');
});