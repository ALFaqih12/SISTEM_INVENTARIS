<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $table = 'm_transaction_type';

    protected $primaryKey = 'transaction_type_id';

    protected $fillable = [
        'transaction_type_name',
        'foundation_id'
    ];

    public function inventoryTransactions()
    {
        return $this->hasMany(
            InventoryTransaction::class,
            'transaction_type_id'
        );
    }
}
