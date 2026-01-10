<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FoodBeverageResource\Pages;
use App\Filament\Resources\FoodBeverageResource\RelationManagers;
use App\Models\FoodBeverage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FoodBeverageResource extends Resource
{
    protected static ?string $model = FoodBeverage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Select::make('category')
                ->options([
                    'Popcorn' => 'Popcorn',
                    'Snacks' => 'Snacks',
                    'Drinks' => 'Drinks',
                    'Combo' => 'Combo Pack',
                ])->required(),
            Forms\Components\TextInput::make('price')->numeric()->prefix('Rp')->required(),
            // Menggunakan TextInput untuk URL Gambar sesuai preferensi Anda
            Forms\Components\TextInput::make('image_url')->url()->required(), 
            Forms\Components\Textarea::make('description')->rows(3),
            Forms\Components\Toggle::make('is_ready')->label('Tersedia')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListFoodBeverages::route('/'),
            'create' => Pages\CreateFoodBeverage::route('/create'),
            'edit' => Pages\EditFoodBeverage::route('/{record}/edit'),
        ];
    }
}
