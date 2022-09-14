<?php

namespace App\Filament\Resources\BusinessSettingsResource\Pages;

use App\Filament\Resources\BusinessSettingsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessSettings extends ListRecords
{
    protected static string $resource = BusinessSettingsResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}