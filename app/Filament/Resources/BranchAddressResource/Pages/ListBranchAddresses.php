<?php

namespace App\Filament\Resources\BranchAddressResource\Pages;

use App\Filament\Resources\BranchAddressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBranchAddresses extends ListRecords
{
    protected static string $resource = BranchAddressResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}