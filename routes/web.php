<?php

use App\Http\Controllers\ShortenerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShortenerController::class, 'index'])->name('shortener.index');

Route::get('/{url?}', [ShortenerController::class, 'show'])
    ->name('shortener.show')
    ->whereAlphaNumeric('url');

Route::post('/', [ShortenerController::class, 'store'])->name('shortener.store');

Route::delete('/{url}', [ShortenerController::class, 'destroy'])
    ->name('shortener.destroy')
    ->whereAlphaNumeric('url');