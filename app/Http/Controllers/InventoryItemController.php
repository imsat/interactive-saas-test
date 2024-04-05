<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Services\InventoryItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InventoryItemController extends Controller
{
    protected $inventoryItemService;

    public function __construct(InventoryItemService $inventoryItemService)
    {
        $this->inventoryItemService = $inventoryItemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Inventory $inventory)
    {
//        $this->checkInventoryOwnership($inventory);
        try {
            $perPage = data_get($request, 'per_page', 10);
            $data['inventory_items'] = InventoryItem::select('id', 'name', 'image', 'quantity', 'description')
                ->whereInventoryId($inventory->id)
                ->latest()
                ->paginate($perPage);

            $data['inventory'] = $inventory->only('id', 'name');

            return $this->apiResponse(true, 'Inventory item list', $data);
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory, InventoryItem $inventoryItem)
    {
//        $this->checkInventoryOwnership($inventory);
        try {
            return $this->apiResponse(true, 'Inventory Item details', $inventoryItem);
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Inventory $inventory)
    {
//        $this->checkInventoryOwnership($inventory);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'image' => 'required|image|max:2048',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(false, 'Invalid data!', null, 400, $validator->errors());
        }
        $data = $request->only(['name', 'description', 'image', 'description']);
        $data['inventory_id'] = $inventory->id;

        try {
            $inventoryItem = $this->inventoryItemService->save($data);
            return $this->apiResponse(true, 'Created successfully', $inventoryItem);
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory, InventoryItem $inventoryItem)
    {
//        $this->checkInventoryOwnership($inventory);
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(false, 'Invalid data!', null, 400, $validator->errors());
        }
        $data = $request->only(['name', 'description', 'image', 'description']);

        try {
            $inventoryItem = $this->inventoryItemService->save($data, $inventoryItem);
            return $this->apiResponse(true, 'Updated successfully', $inventoryItem);
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory, InventoryItem $inventoryItem)
    {
//        $this->checkInventoryOwnership($inventory);
        try {
            $this->inventoryItemService->delete($inventoryItem);
            return $this->apiResponse(true, 'Deleted successfully');
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }

    }

    private function checkInventoryOwnership($inventory, $errorMessage = 'Something went wrong!', $statusCode = 404)
    {
        return !! $inventory->user_id === Auth::id();
    }
}
