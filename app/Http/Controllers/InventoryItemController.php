<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\Room;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the inventory items.
     */
    public function index()
    {
        $inventoryItems = InventoryItem::with('room')->get();

        return view('inventory-items.index', compact('inventoryItems'));
    }

    /**
     * Show the form for creating a new inventory item.
     */
    public function create()
    {
    $rooms = Room::all(); // Fetch all rooms for the dropdown
    return view('inventory-items.create', compact('rooms'));
    }


    /**
     * Store a newly created inventory item in the database.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'nullable|string',
        ]);

        // Create the inventory item
        InventoryItem::create([
            'item_name' => $request->input('item_name'),
            'quantity' => $request->input('quantity'),
            'room_id' => $request->input('room_id'),
            'description' => $request->input('description'),
        ]);

        // Redirect with a success message
        return redirect('admin/inventory-items')->with('success', 'Inventory item added successfully!');
    }




    /**
     * Show the form for editing the specified inventory item.
     */
    public function edit($id)
    {
        $item = InventoryItem::findOrFail($id); // Fetch the item by ID
        $rooms = Room::all(); // Fetch all rooms from the database
        return view('inventory-items.edit', compact('item', 'rooms')); // Return the edit view
    }

    /**
     * Update the specified inventory item in the database.
     */
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'room_id' => 'required|exists:rooms,id', // Ensure room_id is valid
            'description' => 'nullable|string',
        ]);

        // Find the inventory item by ID
        $inventoryItem = InventoryItem::findOrFail($id);

        // Update the item details
        $inventoryItem->item_name = $request->input('item_name');
        $inventoryItem->quantity = $request->input('quantity');
        $inventoryItem->room_id = $request->input('room_id'); // Set the selected room_id
        $inventoryItem->description = $request->input('description');
        $inventoryItem->save();

        // Redirect back with a success message
        return redirect('admin/inventory-items')->with('success', 'Inventory item updated successfully!');
    }



    /**
     * Remove the specified inventory item from the database.
     */

    public function destroy($id)
    {
        // Find the inventory item by ID
        $inventoryItem = InventoryItem::findOrFail($id);

        // Delete the inventory item
        $inventoryItem->delete();

        // Redirect back with a success message
        return redirect('admin/inventory')->with('success', 'Inventory item deleted successfully!');
    }

}
