<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $table = 't_inventory_transactions';

    protected $primaryKey = 'inventory_transaction_id';

    protected $fillable = [
        'transaction_date',
        'transaction_number',
        'status',
        'start_date',
        'end_date',
        'evidence_file',
        'source_of_founds',
        'total_budget',
        'budget_realization',
        'transaction_type_id'
    ];

    public function transactionType()
    {
        return $this->belongsTo(
            TransactionType::class,
            'transaction_type_id'
        );
    }

    public function inventories()
    {
        return $this->hasMany(
            Inventory::class,
            'inventory_transaction_id'
        );
    }
    protected static function booted()
    {
        static::creating(function ($transaction) {

            $lastId = self::max('inventory_transaction_id') ?? 0;

            $transaction->transaction_number =
                'TRX-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
        });
    }
}
