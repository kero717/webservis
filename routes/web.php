<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LoanController;
use Inertia\Inertia;

// Главная страница (просто верни view, без Inertia)
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ТВОИ МАРШРУТЫ (которые работали)
Route::post('/items', [ItemController::class, 'store']);

// Маршруты для книг (добавишь позже)
// Route::get('/books', function () { return view('books/index'); })->middleware(['auth'])->name('books.index');
// Route::post('/books', [BookController::class, 'store'])->middleware(['auth']);

Route::get('/items', [ItemController::class, 'index']); // показать все
Route::post('/items', [ItemController::class, 'store']); // сохранить

Route::get('/test-admin', function () {
    return 'Ты админ!';
})->middleware(['auth', 'admin']);

Route::get('/test-librarian', function () {
    return 'Ты библиотекарь!';
})->middleware(['auth', 'librarian']);

Route::get('/test-client', function () {
    return 'Ты клиент!';
})->middleware(['auth', 'client']);
Route::resource('books', BookController::class)->middleware('auth');
// Бронирования (клиент)
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/books/{book}/book', [BookingController::class, 'store'])->name('books.book');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

// Выдачи (библиотекарь)
Route::middleware(['auth', 'librarian'])->prefix('loans')->name('loans.')->group(function () {
    Route::get('/', [LoanController::class, 'index'])->name('index');
    Route::get('/create', [LoanController::class, 'create'])->name('create');
    Route::post('/', [LoanController::class, 'store'])->name('store');
    Route::patch('/{loan}/return', [LoanController::class, 'return'])->name('return');
    Route::middleware(['auth', 'librarian'])->group(function () {
    Route::get('/admin/bookings', [BookingController::class, 'allBookings'])->name('admin.bookings');
});
});

require __DIR__.'/auth.php';
Route::middleware(['auth'])->group(function () {
    // Дашборды для разных ролей
    Route::get('/client/dashboard', function () {
        return view('client-dashboard');
    })->name('client.dashboard');

    Route::get('/librarian/dashboard', function () {
        return view('librarian-dashboard');
    })->middleware('librarian')->name('librarian.dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin-dashboard');
    })->middleware('admin')->name('admin.dashboard');
     Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});
Route::middleware(['auth'])->group(function () {
    // другие маршруты...
    Route::get('/client/dashboard', fn() => Inertia::render('Client/Dashboard'))->name('client.dashboard');
});
// Администратор
Route::middleware(['auth', 'admin'])->get('/admin/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->name('admin.dashboard');

// Библиотекарь
Route::get('/librarian/dashboard', fn() => Inertia::render('Librarian/Dashboard'))
    ->name('librarian.dashboard')
    ->middleware(['auth', 'librarian']);