<?php

namespace MartinPetricko\FilamentApprovals\Helpers;

use BackedEnum;
use MartinPetricko\LaravelApprovals\Enums\DraftStatus;
use MartinPetricko\LaravelApprovals\Enums\DraftType;

class EnumManager
{
    public static function getLabel(BackedEnum $enum): ?string
    {
        if ($enum instanceof DraftStatus) {
            return match ($enum) {
                DraftStatus::Pending => __('filament-approvals::approvals.enums.draft_status.label.pending'),
                DraftStatus::Approved => __('filament-approvals::approvals.enums.draft_status.label.approved'),
                DraftStatus::Rejected => __('filament-approvals::approvals.enums.draft_status.label.rejected'),
            };
        }

        if ($enum instanceof DraftType) {
            return match ($enum) {
                DraftType::Create => __('filament-approvals::approvals.enums.draft_type.label.create'),
                DraftType::Update => __('filament-approvals::approvals.enums.draft_type.label.update'),
                DraftType::Delete => __('filament-approvals::approvals.enums.draft_type.label.delete'),
            };
        }

        return null;
    }

    public static function getIcon(BackedEnum $enum): ?string
    {
        if ($enum instanceof DraftStatus) {
            return match ($enum) {
                DraftStatus::Pending => 'heroicon-o-lock-closed',
                DraftStatus::Approved => 'heroicon-o-hand-thumb-up',
                DraftStatus::Rejected => 'heroicon-o-hand-thumb-down',
            };
        }

        return null;
    }

    public static function getColor(BackedEnum $enum): ?string
    {
        if ($enum instanceof DraftStatus) {
            return match ($enum) {
                DraftStatus::Pending => 'warning',
                DraftStatus::Approved => 'success',
                DraftStatus::Rejected => 'danger',
            };
        }

        if ($enum instanceof DraftType) {
            return match ($enum) {
                DraftType::Create => 'success',
                DraftType::Update => 'primary',
                DraftType::Delete => 'danger',
            };
        }

        return null;
    }
}
