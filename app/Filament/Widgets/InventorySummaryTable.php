<?php

namespace App\Filament\Widgets;

use App\Models\Room;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class InventorySummaryTable extends BaseWidget
{
    protected static ?string $heading = 'Monitoring Inventory';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Room::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('room_name')
                    ->label('Lokasi'),

                Tables\Columns\TextColumn::make('inventory_count')
                    ->label('Total Barang')
                    ->state(function ($record) {
                        return $record->inventoryRooms()->count();
                    }),

                Tables\Columns\TextColumn::make('damaged_count')
                    ->label('Rusak')
                    ->state(function ($record) {
                        return $record->inventoryRooms()
                            ->where('status', 'damaged')
                            ->count();
                    }),

                Tables\Columns\TextColumn::make('expired_count')
                    ->label('Expired')
                    ->state(function ($record) {
                        return $record->inventoryRooms()
                            ->where('status', 'expired')
                            ->count();
                    }),
            ]);
    }
}