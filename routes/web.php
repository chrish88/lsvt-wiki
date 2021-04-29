<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkillshopController;
use App\Mail\SkillShopEmail;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index']);

Route::prefix('/skillshop')->group(function(){
        Route::get('/', [SkillShopController::class, 'index'])->name('skillshop');
        Route::get('/form', [SkillShopController::class, 'show'])->name('skillshop.form');
        Route::get('/submit', function () {
            return new SkillShopEmail();
        });
});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/articles', function () {
    return Inertia::render('Article/Index');
})->name('articles');