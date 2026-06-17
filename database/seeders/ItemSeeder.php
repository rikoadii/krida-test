<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'deskripsi' => 'Laptop Asus ROG',
                'price' => 15000000,
            ],
            [
                'deskripsi' => 'Mouse Logitech Wireless',
                'price' => 150000,
            ],
            [
                'deskripsi' => 'Keyboard Mechanical Keychron',
                'price' => 1200000,
            ],
            [
                'deskripsi' => 'Monitor Dell 24 Inch',
                'price' => 2500000,
            ],
            [
                'deskripsi' => 'Printer Epson L3110',
                'price' => 2100000,
            ],
            [
                'deskripsi' => 'Flashdisk SanDisk 64GB',
                'price' => 85000,
            ],
            [
                'deskripsi' => 'Hardisk Eksternal WD 1TB',
                'price' => 750000,
            ],
            [
                'deskripsi' => 'Headset Gaming Razer',
                'price' => 600000,
            ],
            [
                'deskripsi' => 'Webcam Logitech C920',
                'price' => 1100000,
            ],
            [
                'deskripsi' => 'SSD Samsung NVMe 512GB',
                'price' => 850000,
            ],
        ];

        DB::table('items')->insert($items);
    }
}
