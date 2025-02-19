<?php

use App\Http\Controllers\ShortenerController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/data', function () {
    for ($i = 0; $i < 1000; $i++) {
        DB::table('url')->insert([
            'short_url' => Str::random(5),
            'full_url'  => 'https://laravel.com',
            'click'     => 0
        ]);
    }

    return 1;
});

Route::get('/', [ShortenerController::class, 'index'])->name('shortener.index');

Route::get('/{url?}', [ShortenerController::class, 'show'])
    ->name('shortener.show')
    ->whereAlphaNumeric('url');

Route::post('/', [ShortenerController::class, 'store'])->name('shortener.store');

Route::delete('/{url}', [ShortenerController::class, 'destroy'])
    ->name('shortener.destroy')
    ->whereAlphaNumeric('url');
