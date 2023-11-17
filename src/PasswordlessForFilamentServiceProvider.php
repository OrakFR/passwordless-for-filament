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

    public static string $viewNamespace = 'passwordless-for-filament';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasRoute('web')
            ->hasTranslations()
            ->hasViews();

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        $className = class_basename(Login::class);
        $alias = strtolower($className); // Converts 'Login' to 'login', or you can format it as needed
        Livewire::component($alias, Login::class);

        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );
    }

    protected function getAssetPackageName(): ?string
    {
        return 'passwordless-for-filament';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('passwordless-for-filament', __DIR__ . '/../resources/dist/components/passwordless-for-filament.js'),
            Css::make('passwordless-for-filament-styles', __DIR__ . '/../resources/dist/passwordless-for-filament.css'),
        ];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }
}
