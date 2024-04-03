<?php

namespace App\Services;

use App\Interfaces\InventoryInterface;
use App\Models\Inventory;

class InventoryService implements InventoryInterface
{
    public function save($data, $inventory = null)
    {
        if (blank($inventory)) {
            $inventory = new Inventory();
        }
        $inventory->fill($data);
        $inventory->save();
        return $inventory;
    }

    public function delete($inventory)
    {
        $inventory->delete();
        return true;
    }
}
