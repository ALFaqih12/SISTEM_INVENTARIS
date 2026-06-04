<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 't_inventory';

    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'quantity',
        'price',
        'spesification',
        'status',
        'foto',
        'description',
        'merk',
        'barcode',
        'expired_date',
        'item_id',
        'inventory_transaction_id'
    ];

    public function item()
    {
        return $this->belongsTo(
            Item::class,
            'item_id'
        );
    }

    public function transaction()
    {
        return $this->belongsTo(
            InventoryTransaction::class,
            'inventory_transaction_id'
        );
    }

    public function inventoryRooms()
    {
        return $this->hasMany(
            InventoryRoom::class,
            'inventory_id'
        );
    }
    protected static function booted()
    {
        static::creating(function ($inventory) {

            $lastId = self::max('inventory_id') ?? 0;

            $inventory->barcode =
                'BC-' .
                now()->format('Ymd') .
                '-' .
                str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
        });
    }
}
