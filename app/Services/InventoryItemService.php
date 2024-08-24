<?php

namespace App\Services;

use App\Models\InventoryItem;

class InventoryItemService extends Service
{
    private $filePath = 'inventory-item';
    public function createOrUpdate($data, $inventoryItem = null)
    {
        if (data_get($data, 'image')) {
            if (!blank($inventoryItem) && $inventoryItem->getRawOriginal('image')) {
                UploadService::cleanFile($inventoryItem->getRawOriginal('image'));
            }
            $data['image'] = UploadService::upload($data['image'], $this->filePath);
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
