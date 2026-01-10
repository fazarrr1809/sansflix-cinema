<?php

namespace App\Filament\Resources\AuditoriumResource\Pages;

use App\Filament\Resources\AuditoriumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAuditorium extends EditRecord
{
    protected static string $resource = AuditoriumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
