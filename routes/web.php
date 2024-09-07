<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\MyTestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VedicMathController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
    //เวทคณิต
    Route::get('/vedics',[VedicMathController::class, 'index'])->name('vedics.index');
    Route::post('/vedics',[VedicMathController::class, 'navigate'])->name('vedics.navigate');
    Route::get('/vedics/{type?}',[VedicMathController::class, 'index'])->name('vedics.index');
    
    Route::get('/answer-vedics/addition',[VedicMathController::class, 'addition'])->name('vedics.answers.addition');
    
    Route::get('mytest',[MyTestController::class, 'index']);
    
    Route::get('/books',[BookController::class, 'index'])->name('books.index');
    Route::get('/books/book',[BookController::class, 'test'])->name('books.book');
    Route::get('/books/test',[BookController::class, 'test'])->name('books.test');
    Route::get('/books/{level}/{difficulty}',[BookController::class, 'navigator'])->name('books.navigator');
});

require __DIR__.'/auth.php';
