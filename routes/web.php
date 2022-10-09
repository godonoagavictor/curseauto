<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CountryController;
use App\Http\Controllers\Frontend\ItineraryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/robots.txt', [RobotsController::class]);

if (Illuminate\Support\Facades\Schema::hasTable('language_lines')) {
    Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'as' => 'frontend.',
    ], function () {
        Route::get('/', [IndexController::class, 'index'])->name('homepage');
        // Route::get(LaravelLocalization::transRoute('routes.about'), [Controller::class, 'about'])->name('about');
        // Route::get(LaravelLocalization::transRoute('routes.contacts'), [Controller::class, 'contacts'])->name('contactUs');
        Route::get(LaravelLocalization::transRoute('routes.countries'), [CountryController::class, 'countries'])->name('countries');

        Route::get(LaravelLocalization::transRoute('routes.itinerary'), [ItineraryController::class, 'itinerary'])->name('itinerary');
        Route::post(LaravelLocalization::transRoute('routes.itinerary_store'), [ItineraryController::class, 'store'])->name('itinerary.store');
    });

    Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'as' => 'frontend.',
    ], function () {
        // leave this route last
        Route::get(LaravelLocalization::transRoute('routes.page'), [Controller::class, 'showPage'])
            ->name('static-page')
            ->where('page', '^(?!admin|nova-(api|vendor)|vendor).*$');
    });
}
