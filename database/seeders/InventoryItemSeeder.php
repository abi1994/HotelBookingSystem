<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\InventoryItem;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

// Assuming the Room model exists

class InventoryItemSeeder extends Seeder
{
    public function run()
    {
        // Predefined inventory items
        $inventoryItems = [
            ['room_id' => 1, 'item_name' => 'Bed', 'quantity' => 10],
            ['room_id' => 1, 'item_name' => 'TV', 'quantity' => 5],
            ['room_id' => 1, 'item_name' => 'Chair', 'quantity' => 15],
        ];

        // Insert the predefined inventory items
        foreach ($inventoryItems as $item) {
            DB::table('inventory_items')->insert([
                'room_id' => $item['room_id'],
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'description'=> $item['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        // Optionally, you can add more inventory items if needed
    }
}
