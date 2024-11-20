<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_item';

    protected $table = "items";

    protected $fillable =
    [
        'id_item',
        'id_group_item',
        'id_satuan',
        'nama',
        'deskripsi',
    ];

    protected $guarded = [];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }

    public function group_item()
    {
        return $this->belongsTo(GroupItem::class, 'id_group_item', 'id_group_item');
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_items', 'id_item', 'id_transaction')
                ->withPivot('quantity', 'remarks')
                ->withTimestamps();
    }
}