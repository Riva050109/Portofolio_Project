<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;



    protected function getCancelAction(): Actions\Action
    {
        return Actions\Action::make('cancel')
            ->label('Kembali')
            ->url($this->getResource()::getUrl('index'))
            ->color('gray');
    }
}