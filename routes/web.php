<?php
use BrunoPincaro\PasswordlessForFilament\Http\Controllers\HandleMagicLinkController;
use Illuminate\Support\Facades\Route;

Route::domain(config('filament.domain'))
    ->middleware(config('filament.middleware.base'))
    ->prefix(config('filament.path'))
    ->name('filament.auth.login')
    ->group(function () {
        Route::get('/login/magic-link/{key}/{remember?}', HandleMagicLinkController::class)
            ->middleware('signed')
            ->name('magic-link');
    });