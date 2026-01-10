<?php

namespace App\Filament\Resources\AuditoriumResource\Pages;

use App\Filament\Resources\AuditoriumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAuditoria extends ListRecords
{
    protected static string $resource = AuditoriumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
