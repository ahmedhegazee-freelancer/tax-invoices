<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchAddressResource\Pages;
use App\Filament\Resources\BranchAddressResource\RelationManagers;
use App\Models\BranchAddressSetting;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchAddressResource extends Resource
{
    protected static ?string $model = BranchAddressSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('key')->disabled(),
                TextInput::make('value')->minLength(1)->maxLength(120),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key'),
                TextColumn::make('value'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBranchAddresses::route('/'),
            // 'create' => Pages\CreateBranchAddress::route('/create'),
            'edit' => Pages\EditBranchAddress::route('/{record}/edit'),
        ];
    }
}
