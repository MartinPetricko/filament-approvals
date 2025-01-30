<?php

namespace MartinPetricko\FilamentApprovals;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentApprovalsPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-approvals';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverClusters(__DIR__ . '/Clusters', 'MartinPetricko\\FilamentApprovalsx\\Clusters')
            ->discoverResources(__DIR__ . '/Resources', 'MartinPetricko\\FilamentApprovalsx\\Resources');
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
