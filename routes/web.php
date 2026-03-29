<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleAdminController;
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

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
Route::get('/gallery/{slug}', [MainController::class, 'gallery'])->name('gallery');
Route::get('/signin', [AuthController::class, 'create'])->name('signin.create');
Route::post('/signin', [AuthController::class, 'registration'])->name('signin.store');
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/category/{category}', [ArticleController::class, 'category'])->name('category');
    Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('articles', ArticleAdminController::class);
});
// посмотреть всех юзеров
Route::get('/users', function () {
    $jsonPath = storage_path('app/users.json');
    if (file_exists($jsonPath)) {
        $content = file_get_contents($jsonPath);
        return '<pre>' . $content . '</pre>';
    }
    return 'Нет зарегистрированных пользователей';
});
