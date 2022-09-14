<?php

namespace App\Filament\Resources\SignatureResource\Pages;

use App\Filament\Resources\SignatureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSignatures extends ListRecords
{
    protected static string $resource = SignatureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
