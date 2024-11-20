<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_stock';

    protected $table = "stocks";

    protected $fillable =
    [
        'id_stock',
        'id_item',
        'available_stock',
    ];

    protected $guarded = [];

    public function getAvailableStockAttribute($value)
    {
        return number_format($value, 0, ',', '.'); // Menampilkan stok dengan format
    }

    public function item()
    {
        return $this->hasOne(Item::class, 'id_item', 'id_item');
    }
}