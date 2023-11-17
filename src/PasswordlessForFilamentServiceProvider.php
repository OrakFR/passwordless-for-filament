<?php

namespace BrunoPincaro\PasswordlessForFilament;

use BrunoPincaro\PasswordlessForFilament\Livewire\Auth\Login;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

use Livewire\Livewire;

class PasswordlessForFilamentServiceProvider extends PackageServiceProvider
{
    public static string $name = 'passwordless-for-filament';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name(static::$name)
            ->hasConfigFile() // php artisan vendor:publish --tag=your-package-name-config
            ->hasRoute('web')
            ->hasTranslations() // php artisan vendor:publish --tag=your-package-name-translations
            ->hasViews(); // php artisan vendor:publish --tag=your-package-name-views
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        $className = class_basename(Login::class);
        $alias = strtolower($className); // Converts 'Login' to 'login', or you can format it as needed
        Livewire::component($alias, Login::class);
    }
}
