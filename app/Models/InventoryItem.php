<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    /**
     * Get the user's avatar.
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => $image ?  asset('storage/'.  $image)  : 'https://picsum.photos/id/20/575/350',
        );
    }
}
