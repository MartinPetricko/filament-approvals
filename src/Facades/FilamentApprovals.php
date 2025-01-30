<?php

namespace MartinPetricko\FilamentApprovals\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MartinPetricko\FilamentApprovals\FilamentApprovals
 */
class FilamentApprovals extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \MartinPetricko\FilamentApprovals\FilamentApprovals::class;
    }
}
