<?php

namespace App\Filament\Resources\Vacation\VacationResource\Pages;

use App\Filament\Resources\Vacation\VacationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVacations extends ListRecords
{
    protected static string $resource = VacationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
