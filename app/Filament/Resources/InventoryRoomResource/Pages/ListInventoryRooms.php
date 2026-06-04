<?php

namespace App\Filament\Resources\InventoryRoomResource\Pages;

use App\Filament\Resources\InventoryRoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventoryRooms extends ListRecords
{
    protected static string $resource = InventoryRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
