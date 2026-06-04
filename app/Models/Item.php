<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'm_items';

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item_name',
        'unit',
        'item_type_id'
    ];

    public function itemType()
    {
        return $this->belongsTo(
            ItemType::class,
            'item_type_id'
        );
    }

    public function inventories()
    {
        return $this->hasMany(
            Inventory::class,
            'item_id'
        );
    }
}
