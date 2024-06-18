<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Dash\UserController;
use App\Http\Controllers\Dash\CategoryController;
use App\Http\Controllers\SocialLoginController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/', [HomePageController::class, 'index'])->name('main');
        Route::controller(SocialLoginController::class)->prefix('auth')->as('auth.social.')->group(function () {
            Route::get('{provider}/redirect', 'redirect')->name('redirect');
            Route::get('{provider}/callback', 'callback')->name('callback');
        });
        route::resources([
            'carts' => CartController::class,
        ]);

        Route::middleware(['auth', 'verified', 'dashboardAccess'])->as('dashboard.')->prefix('dashboard')->group(
            function () {
                Route::get('/', function () {
                    return view('dash.index');
                })->name('main');

                Route::resources([
                    'users' => UserController::class,
                    'categories' => CategoryController::class,
                    'products' => ProductController::class,
                ]);
            }
        );


        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    }
);




require __DIR__ . '/auth.php';
