<?php

use App\Models\Listing;
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

// Listing home
Route::get('/', [ListingController::class, 'index'])->name('listings');
// Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])
    ->middleware(['auth'])
    ->name('listing-manage');
// show listing
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listing-show');
// show create a list form
Route::get('/create', [ListingController::class, 'create'])
    ->middleware(['auth'])
    ->name('listing-create');
// create a listing
Route::post('/listings', [ListingController::class, 'store'])
    ->middleware(['auth'])
    ->name('listing-store');
// show edit listing page
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
    ->middleware(['auth'])
    ->name('listing-edit');
// edit listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])
    ->middleware(['auth'])
    ->name('listing-update');
// delete a listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('listing-destroy');


// user 
Route::get('/register', [UserController::class, 'create'])
    ->middleware(['guest'])
    ->name('register');

Route::post('/users', [UserController::class, 'store'])
    ->middleware(['guest'])
    ->name('users-store');

Route::post('/logout', [UserController::class, 'logout'])
    ->middleware(['auth'])
    ->name('logout');

Route::get('/login', [UserController::class, 'login'])
    ->middleware(['guest'])
    ->name('login');

Route::post('/authenticate', [UserController::class, 'authenticate'])
    ->middleware(['guest'])
    ->name('authenticate');