<?php

namespace BrunoPincaro\PasswordlessForFilament;

use Illuminate\Database\Eloquent\Model;

class PasswordlessForFilament
{
    protected string $model;

    public function __construct()
    {
        $this->model = config('passwordless-for-filament.model');
    }

    public function getModel(string $email): ?Model
    {
        return $this->model::query()
            ->where('email', $email)
            ->first();
    }

    public function getModelByRouteKey(string $key): Model
    {
        $routeKeyName = (new $this->model)->getRouteKeyName();

        return $this->model::query()
            ->where($routeKeyName, $key)
            ->first();
    }

}
