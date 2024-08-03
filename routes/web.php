<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth' , 'verified'])->group(function () {
    Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
    // Book management routes
    Route::resource('books', BookController::class);

    // Additional routes that require authentication
    // For example, checking out and returning books
    Route::post('books/{id}/checkout', [BookController::class, 'checkout'])->name('books.checkout');
    Route::post('books/{id}/return', [BookController::class, 'return'])->name('books.return');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
