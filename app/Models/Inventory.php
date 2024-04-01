<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'user_id',
      'description',
      'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public  function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }
}
