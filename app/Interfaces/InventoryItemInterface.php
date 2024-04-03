<?php

namespace App\Interfaces;

interface InventoryItemInterface
{
    public function save(array $data, $inventoryItem = null);

    public function delete($inventoryItem);
}
