<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\RoomType;
use App\Models\Service;
use Illuminate\Http\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class RoomTypesTableSeeder extends Seeder
{
    public function run()
    {

        $roomTypesData = [
            [
                'name' => 'Standard Room',
                'price' => 100.00,
                'capacity' => 2,
                'description' => 'A cozy room with basic amenities.',
                'image_path' => glob(public_path('img') . '/p1.jpg')[0],
            ],
            [
                'name' => 'Deluxe Room',
                'price' => 150.00,
                'capacity' => 2,
                'description' => 'A luxurious room with extra amenities.',
                'image_path' => glob(public_path('img') . '/p2.jpg')[0],

            ],
            [
                'name' => 'Suite',
                'price' => 250.00,
                'capacity' => 3,
                'description' => 'A spacious suite with a beautiful view.',
                'image_path' => glob(public_path('img') . '/p3.jpg')[0],

            ],
        ];

        foreach ($roomTypesData as $roomType) {
            $path = Storage::putFile('/public',new File($roomType['image_path']), 'public');

            // Storage::disk('public')->put('/storage', file_get_contents( $roomType['image_path']));
            
            // $path = Storage::disk('public')->put('storage/' . $roomType['image_path'], $roomType['image_path']);

            $data = collect($roomType)->except('image_path')->toArray();

            $newRoomType = RoomType::create($data);

            $newRoomType->images()->create(['filename' => $path]);
        }

        $bannerData = [
            [
                'alt_text' => 'one',
                'publish_status' => 'on',
                'image_path' => glob(public_path('img') . '/banner1.jpg')[0],
            ],
            [
                'alt_text' => 'two',
                'publish_status' => 'on',
                'image_path' => glob(public_path('img') . '/banner2.jpg')[0],
            ],
            [
                'alt_text' => 'three',
                'publish_status' => 'on',
                'image_path' => glob(public_path('img') . '/banner3.jpg')[0],
            ]
        ];

        foreach ($bannerData as $banner) {
            $path = Storage::putFile('/public',new File($banner['image_path']), 'public');

            $data = collect($banner)->except('image_path')->toArray();

            $newBanner = Banner::create($data);

            $newBanner->image()->create(['filename' => $path]);
        }

        $serviceData = [
            [
                'title' => 'one',
                'small_desc' => 'test',
                'detail_desc' => 'welcome',
                'image_path' => glob(public_path('img') . '/service1.jpg')[0],
            ],
            [
                'title' => 'two',
                'small_desc' => 'test 1',
                'detail_desc' => 'welcome 2',
                'image_path' => glob(public_path('img') . '/service4.jpg')[0],
            ],
        ];

        foreach ($serviceData as $service) {
            $path = Storage::putFile('/public',new File($service['image_path']), 'public');

            $data = collect($service)->except('image_path')->toArray();

            $newService = Service::create($data);

            $newService->image()->create(['filename' => $path]);
        }
    }
}
