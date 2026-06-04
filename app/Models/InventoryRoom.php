<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryRoom extends Model
{
    protected $table = 't_inventory_room';

    protected $primaryKey = 'inventory_room_id';

    protected $fillable = [
        'status',
        'inventory_date',
        'inventory_id',
        'room_id'
    ];

    public function inventory()
    {
        return $this->belongsTo(
            Inventory::class,
            'inventory_id'
        );
    }

    public function room()
    {
        return $this->belongsTo(
            Room::class,
            'room_id'
        );
    }
}
