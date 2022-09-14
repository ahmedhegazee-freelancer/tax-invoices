<?php

namespace App\Filament\Resources\BranchAddressResource\Pages;

use App\Filament\Resources\BranchAddressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBranchAddress extends EditRecord
{
    protected static string $resource = BranchAddressResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}