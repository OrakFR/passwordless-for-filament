<?php

namespace BrunoPincaro\PasswordlessForFilament;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class PasswordlessForFilamentMagicLink
{
    protected Model $model;
    protected bool $remember;
    protected int $expiry;
    protected string $url;

    public function __construct(Model $model, bool $remember = false)
    {
        $this->model = $model;
        $this->remember = $remember;
        $this->expiry = config("passwordless-for-filament.magic_link_expiry");
        $this->generateUrl();
    }

    public static function create(Model $model, bool $remember = false): static
    {
        return new static($model, $remember);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getExpiry(): int
    {
        return $this->expiry;
    }

    public function generateUrl(): void
    {
        $url = URL::temporarySignedRoute(
            name: 'filament.auth.login.magic-link',
            expiration: now()->addMinutes($this->getExpiry()),
            parameters: [
                'key' => $this->model->getRouteKey(),
                'remember' => $this->remember,
            ]
        );

        $this->url = $url;
    }
}