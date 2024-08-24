<?php

namespace App\Services;

use App\Models\Inventory;

class InventoryService extends Service
{
    public function createOrUpdate($data, $inventory = null)
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
