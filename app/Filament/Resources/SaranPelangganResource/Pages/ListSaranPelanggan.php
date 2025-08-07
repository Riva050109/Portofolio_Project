<?php

namespace App\Filament\Resources\SaranPelangganResource\Pages;

use App\Filament\Resources\SaranPelangganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSaranPelanggan extends ListRecords
{
    protected static string $resource = SaranPelangganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}