<?php

namespace MartinPetricko\FilamentApprovals\Actions;

use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ApprovalsAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'approvals';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label(__('filament-approvals::approvals.actions.approvals.label'))
            ->icon('heroicon-m-lock-closed')
            ->button()
            ->url(function (Model $record, Component $livewire) {
                return app()->make($livewire::getResource())::getUrl('approvals', ['record' => $record]);
            });
    }
}
