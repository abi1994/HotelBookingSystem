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
                'price' => 10000.00,
                'capacity' => 2,
                'description' => 'Our Standard Room offers a comfortable stay with essential amenities. Equipped with a cozy bed, a work desk, and a private bathroom, its perfect for travelers seeking simplicity and convenience',
                'image_path' => glob(public_path('img') . '/p1.jpg')[0],
            ],
            [
                'name' => 'Deluxe Room',
                'price' => 15000.00,
                'capacity' => 2,
                'description' => ': Indulge in luxury with our Deluxe Suite. Featuring spacious accommodation, a plush king-sized bed, a separate living area, and an elegant en-suite bathroom, this suite offers the ultimate in comfort and relaxation.',
                'image_path' => glob(public_path('img') . '/p2.jpg')[0],

            ],
            [
                'name' => 'Honeymoon Suite',
                'price' => 30000.00,
                'capacity' => 2,
                'description' => 'Celebrate love and romance in our luxurious Honeymoon Suite. Featuring a romantic ambiance, a luxurious king-sized bed, a private balcony with scenic views, and a lavish spa bath, its the perfect setting for a memorable honeymoon or romantic escape.',
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
                'title' => 'Fitness Center Access',
                'small_desc' => 'Stay active during your stay with our state-of-the-art fitness facilities.',
                'detail_desc' => 'Maintain your fitness routine even while traveling with complimentary access to our Fitness Center. Equipped with modern gym equipment, including cardio machines, free weights, and strength-training equipment, our fitness facilities cater to all fitness levels. Whether you prefer a high-intensity workout or a relaxing yoga session, our Fitness Center has everything you need to stay active and energized.',
                'image_path' => glob(public_path('img') . '/service1.jpg')[0],
            ],
            [
                'title' => 'Spa & Wellness Services',
                'small_desc' => 'Rejuvenate your body and mind with our spa treatments.',
                'detail_desc' => 'Treat yourself to a pampering experience with our Spa & Wellness Services. Choose from a range of rejuvenating treatments, including massages, facials, and body scrubs, designed to promote relaxation and wellness. Our skilled therapists will customize each treatment to suit your individual needs, leaving you feeling refreshed and revitalized.',
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
