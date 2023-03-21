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

Route:: as ('users.')->group(function () {
    Route::get('/register', [RegistrationController::class, 'create'])
        ->name('register');
    Route::post('/users', [RegistrationController::class, 'store'])
        ->name('store');
    Route::get('/login', [AuthenticationController::class, 'create'])
        ->name('login');
    Route::post('/authenticate', [AuthenticationController::class, 'store'])
        ->name('authenticate');
    Route::post('/logout', LogoutController::class)
        ->name('logout')->middleware(['auth']);
});

Route:: as ('listings.')->group(function () {
    Route::get('/', [ListingController::class, 'index'])
        ->name('index');
    Route::get('/listings/{listing}', [ListingController::class, 'show'])
        ->name('show');

    Route::middleware(['auth'])->group(
        function () {
            Route::get('/listings/manage', [ListingController::class, 'manage'])
                ->name('manage');
            Route::get('/create', [ListingController::class, 'create'])
                ->name('create');
            Route::post('/listings', [ListingController::class, 'store'])
                ->name('store');
            Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
                ->name('edit');
            Route::put('/listings/{listing}', [ListingController::class, 'update'])
                ->name('update');
            Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
                ->name('destroy');
        }
    );
});
