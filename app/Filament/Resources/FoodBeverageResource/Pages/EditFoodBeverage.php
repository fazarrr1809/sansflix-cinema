<?php

namespace App\Filament\Resources\FoodBeverageResource\Pages;

use App\Filament\Resources\FoodBeverageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFoodBeverage extends EditRecord
{
    protected static string $resource = FoodBeverageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
