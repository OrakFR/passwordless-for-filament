<?php

namespace BrunoPincaro\PasswordlessForFilament\Http\Controllers;

use BrunoPincaro\PasswordlessForFilament\Facades\PasswordlessForFilament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Routing\Controller;
use Filament\Facades\Filament;

class HandleMagicLinkController extends Controller
{
    public function __invoke(string $key, bool $remember = false): LoginResponse
    {
        $model = app(PasswordlessForFilament::class)->getModelByRouteKey($key);

        Filament::auth()->login($model, $remember);

        return app(LoginResponse::class);
    }
}
