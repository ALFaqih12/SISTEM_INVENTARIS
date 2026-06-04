<?php

namespace App\Filament\Resources\InventoryRoomResource\Pages;

use App\Filament\Resources\InventoryRoomResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventoryRoom extends EditRecord
{
    protected static string $resource = InventoryRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
