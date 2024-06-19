<?php

namespace App\Filament\Resources\Worker\WorkerResource\Pages;

use App\Filament\Resources\Worker\WorkerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWorker extends CreateRecord
{
    protected static string $resource = WorkerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $this->redirect($this->getRedirectUrl());
    }
}
