<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_group_item';

    protected $table = "group_items";

    protected $fillable =
    [
        'id_group_item',
        'nama',
        'deskripsi'
    ];

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Item::class,'id_group_item');
    }
}