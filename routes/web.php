<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
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
// посмотреть всех юзеров
Route::get('/users', function () {
    $jsonPath = storage_path('app/users.json');
    if (file_exists($jsonPath)) {
        $content = file_get_contents($jsonPath);
        return '<pre>' . $content . '</pre>';
    }
    return 'Нет зарегистрированных пользователей';
});
