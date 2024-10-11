<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Главная страница
Route::get('/', function () {
    return view('pages.index');
})->name('home');

// Отображение меню (для всех пользователей)
Route::get('menu', [MenuController::class, 'showMenu'])->name('menu.show');

// Защищенные маршруты (требуется аутентификация)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('profile');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Маршруты для администратора (управление меню)
    Route::middleware(['admin'])->group(function () {
        Route::get('admin/menu', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::get('admin/menu/create', [MenuController::class, 'create'])->name('admin.menu.create');
        Route::post('admin/menu', [MenuController::class, 'store'])->name('admin.menu.store');
        Route::get('admin/menu/{menu}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::put('admin/menu/{menu}', [MenuController::class, 'update'])->name('admin.menu.update');
        Route::delete('admin/menu/{menu}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
    });
});

// Маршруты для гостей
Route::middleware('guest')->group(function () {
    // Регистрация
    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');

    // Логин
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginAuth'])->name('login.auth');

    // Восстановление пароля
    Route::get('forgot-password', function () {
        return view('user.forgot-password');
    })->name('password.request');

    Route::post('forgot-password', [PasswordController::class, 'forgotPasswordStore'])->name('password.email')->middleware('throttle:3,1');

    Route::get('reset-password/{token}', function (string $token) {
        return view('user.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('reset-password', [PasswordController::class, 'resetPasswordUpdate'])->name('password.update');
});

// Маршруты для подтверждения email
Route::middleware('auth')->group(function () {
    Route::get('/verify-email', function () {
        return view('user.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:3,1')->name('verification.send');
});
