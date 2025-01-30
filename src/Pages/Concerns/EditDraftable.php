<?php

namespace MartinPetricko\FilamentApprovals\Pages\Concerns;

use MartinPetricko\LaravelApprovals\Concerns\HasApprovals;

trait EditDraftable
{
    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var HasApprovals $record */
        $record = $this->getRecord();

        if ($record->hasPendingDraft()) {
            return $record->loadDraftData()->attributesToArray();
        }

        return $data;
    }
}
