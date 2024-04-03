<?php

namespace App\Services;

use App\Interfaces\InventoryItemInterface;
use App\Models\InventoryItem;

class InventoryItemService implements InventoryItemInterface
{
    private $filePath = 'inventory-item';

    public function save($data, $inventoryItem = null)
    {
        if (data_get($data, 'image')) {
            if (!blank($inventoryItem) && $inventoryItem->getRawOriginal('image')) {
                FileService::deleteFile($inventoryItem->getRawOriginal('image'));
            }
            $data['image'] = FileService::uploadFile($data['image'], $this->filePath);
        }

        if (blank($inventoryItem)) {
            $inventoryItem = new InventoryItem();
        }
        $inventoryItem->fill($data);
        $inventoryItem->save();
        return $inventoryItem;
    }

    public function delete($inventoryItem)
    {
        $inventoryItem->delete();
        return true;
    }
}
