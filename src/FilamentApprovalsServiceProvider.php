<?php

namespace MartinPetricko\FilamentApprovals;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentApprovalsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-approvals';

    public static string $viewNamespace = 'filament-approvals';

    public static string $assetPackageName = 'martinpetricko/filament-approvals';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasTranslations()
            ->hasViews(static::$viewNamespace);
    }

    public function packageRegistered(): void
    {
        //
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('filament-approvals-styles', __DIR__ . '/../resources/dist/filament-approvals.css')->loadedOnRequest(),
            Js::make('filament-approvals-scripts', __DIR__ . '/../resources/dist/filament-approvals.js'),
        ], static::$assetPackageName);
    }
}
