<?php

namespace App\Interfaces;

interface InventoryInterface
{
    public function save(array $data, $inventory = null);

    public function delete($inventory);
}
