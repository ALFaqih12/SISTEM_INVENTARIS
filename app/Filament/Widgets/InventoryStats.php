<?php

namespace App\Filament\Widgets;

use App\Models\Inventory;
use App\Models\Building;
use App\Models\Room;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InventoryStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total Barang',
                Inventory::count()
            ),

            Stat::make(
                'Total Gedung',
                Building::count()
            ),

            Stat::make(
                'Total Ruangan',
                Room::count()
            ),

            Stat::make(
                'Barang Expired',
                Inventory::whereDate(
                    'expired_date',
                    '<',
                    now())
                ->count()
            ),

            Stat::make(
                'Barang Rusak',
                Inventory::where(
                    'status',
                    'damaged'
                )->count()
            ),

        ];
    }
}
