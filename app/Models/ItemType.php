<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    protected $table = 'm_item_types';

    protected $primaryKey = 'item_type_id';

    protected $fillable = [
        'item_type_name',
        'description',
        'foundation_id'
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'item_type_id');
    }
}
