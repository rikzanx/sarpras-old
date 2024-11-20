<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaction_item';

    protected $table = "transaction_items";

    protected $fillable =
    [
        'id_transaction_item',
        'id_transaction',
        'id_item',
        'quantity',
        'remarks',
    ];

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }
}