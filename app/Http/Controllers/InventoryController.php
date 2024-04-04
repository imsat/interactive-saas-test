<?php

namespace App\Http\Controllers;

use App\Interfaces\InventoryInterface;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    protected $inventoryService;

    public function __construct(InventoryInterface $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = data_get($request, 'per_page', 10);

            $inventories = Inventory::select('id', 'name', 'description')
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate($perPage);
            return $this->apiResponse(true, 'Inventory list', $inventories);
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        try {
            return $this->apiResponse(true, 'Inventory details', $inventory);
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(false, 'Invalid data!', null, 400, $validator->errors());
        }

        $data = $request->only('name', 'description');
        $data['user_id'] = Auth::id();

        try {
            $results = $this->inventoryService->save($data);
            return $this->apiResponse(true, 'Created successfully', $results);
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(false, 'Invalid data!', null, 400, $validator->errors());
        }
        $data = $request->only('name', 'description');

        try {
            $results = $this->inventoryService->save($data, $inventory);
            return $this->apiResponse(true, 'Updated successfully', $results);
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        try {
            $this->inventoryService->delete($inventory);
            return $this->apiResponse(true, 'Deleted successfully');
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 404);
        }
    }
}
