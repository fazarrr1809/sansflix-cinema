<?php

namespace App\Filament\Resources\FoodBeverageResource\Pages;

use App\Filament\Resources\FoodBeverageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFoodBeverages extends ListRecords
{
    protected static string $resource = FoodBeverageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
