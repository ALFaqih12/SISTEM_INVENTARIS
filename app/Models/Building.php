<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'm_buildings';

    protected $primaryKey = 'building_id';

    protected $fillable = [
        'building_name',
        'foundation_name'
    ];

    public function rooms()
    {
        return $this->hasMany(
            Room::class,
            'building_id'
        );
    }
}
