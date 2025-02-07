<?php

use App\Http\Controllers\ShortenerControler;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShortenerControler::class, 'index'])->name('shortener.index');

Route::get('/{url?}', [ShortenerControler::class, 'show'])
    ->name('shortener.show')
    ->whereAlphaNumeric('url');

Route::post('/', [ShortenerControler::class, 'store'])->name('shortener.store');

Route::delete('/{url}', [ShortenerControler::class, 'destroy'])
    ->name('shortener.destroy')
    ->whereAlphaNumeric('url');