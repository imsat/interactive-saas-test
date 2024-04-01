<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inventory_id',
        'image',
        'quantity',
        'description',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
