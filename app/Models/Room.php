<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'm_rooms';

    protected $primaryKey = 'room_id';

    protected $fillable = [
        'room_name',
        'floor',
        'building_id'
    ];

    public function building()
    {
        return $this->belongsTo(
            Building::class,
            'building_id'
        );
    }

    public function inventoryRooms()
    {
        return $this->hasMany(
            InventoryRoom::class,
            'room_id'
        );
    }
}
