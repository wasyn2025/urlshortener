<?php

use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UrlShortenerController::class, 'index'])->name('shortener.index');

Route::get('/{url?}', [UrlShortenerController::class, 'show'])
    ->name('shortener.show')
    ->whereAlphaNumeric('url');

Route::post('/', [UrlShortenerController::class, 'store'])->name('shortener.store');

Route::delete('/{url}', [UrlShortenerController::class, 'destroy'])
    ->name('shortener.destroy')
    ->whereAlphaNumeric('url');