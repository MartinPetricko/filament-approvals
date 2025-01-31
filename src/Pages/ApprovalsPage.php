<?php

namespace MartinPetricko\FilamentApprovals\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use MartinPetricko\LaravelApprovals\Enums\DraftStatus;
use MartinPetricko\LaravelApprovals\Models\Draft;

class ApprovalsPage extends Page
{
    use InteractsWithRecord;
    use WithPagination;

    public ?Draft $draft = null;

    protected static string $view = 'filament-approvals::approvals-page';

    public function isMessageRequired(): bool
    {
        return false;
    }

    public function getBreadcrumb(): string
    {
        return static::$breadcrumb ?? __('filament-approvals::approvals.pages.approvals.breadcrumb');
    }

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->draft = $this->record->latestDraft;

        abort_if($this->draft === null, 404);
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->getRejectAction(),
            $this->getApproveAction(),
        ];
    }

    public function getApproveAction(): Action
    {
        return Action::make('approve')
            ->label(__('filament-approvals::approvals.pages.approvals.actions.approve.label'))
            ->icon('heroicon-m-hand-thumb-up')
            ->color('success')
            ->visible(fn() => $this->draft->status === DraftStatus::Pending)
            ->action(fn() => $this->draft->approve());
    }

    public function getRejectAction(): Action
    {
        return Action::make('reject')
            ->label(__('filament-approvals::approvals.pages.approvals.actions.reject.label'))
            ->icon('heroicon-m-hand-thumb-down')
            ->color('danger')
            ->visible(fn() => $this->draft->status === DraftStatus::Pending)
            ->form([
                Textarea::make('message')
                    ->label(__('filament-approvals::approvals.pages.approvals.actions.reject.form.fields.message'))
                    ->rows(6)
                    ->required($this->isMessageRequired()),
            ])
            ->action(fn(Model $record, array $data) => $this->draft->reject($data['message'] ?? null));
    }

    public function showDraft(int $draftId): void
    {
        $this->draft = $this->record->drafts()->findOrFail($draftId);
    }

    #[Computed]
    public function draftsList(): LengthAwarePaginator
    {
        return $this->record
            ->drafts()
            ->with('author')
            ->latest()
            ->paginate($this->getDraftsListPerPage());
    }

    #[Computed]
    public function relatedDrafts(): Collection
    {
        return $this->draft->relatedDrafts()->get();
    }

    public function getDraftsListPerPage(): int
    {
        return 10;
    }
}
