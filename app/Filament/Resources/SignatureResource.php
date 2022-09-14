<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SignatureResource\Pages;
use App\Filament\Resources\SignatureResource\RelationManagers;
use App\Models\Signature;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SignatureResource extends Resource
{
    protected static ?string $model = Signature::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('signatureType')->minLength(3)->maxLength(120)->required(),
                TextInput::make('value')->minLength(3)->maxLength(120)->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('signatureType'),
                TextColumn::make('value'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSignatures::route('/'),
            'create' => Pages\CreateSignature::route('/create'),
            'edit' => Pages\EditSignature::route('/{record}/edit'),
        ];
    }
}