<?php

namespace App\Filament\Resources\SignatureResource\Pages;

use App\Filament\Resources\SignatureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSignature extends EditRecord
{
    protected static string $resource = SignatureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
