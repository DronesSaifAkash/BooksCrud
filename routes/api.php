<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiBookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// routes/api.php



Route::prefix('books')->group(function () {
    // List all books
    Route::get('/', [ApiBookController::class, 'index']);
    
    // Get a specific book by ID
    Route::get('{book}', [ApiBookController::class, 'show']);
    
    // Create a new book
    Route::post('/', [ApiBookController::class, 'store']);
    
    // Update an existing book
    Route::put('{book}', [ApiBookController::class, 'update']);
    
    // Delete a book
    Route::delete('{book}', [ApiBookController::class, 'destroy']);
    
    // Check out a book
    Route::patch('{book}/checkout', [ApiBookController::class, 'checkout']);
    
    // Return a book
    Route::patch('{book}/return', [ApiBookController::class, 'return']);
});
