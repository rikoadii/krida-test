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
                'itemId' => 'ITEM-001',
                'deskripsi' => 'Laptop Asus ROG',
                'price' => 15000000,
            ],
            [
                'itemId' => 'ITEM-002',
                'deskripsi' => 'Mouse Logitech Wireless',
                'price' => 150000,
            ],
            [
                'itemId' => 'ITEM-003',
                'deskripsi' => 'Keyboard Mechanical Keychron',
                'price' => 1200000,
            ],
            [
                'itemId' => 'ITEM-004',
                'deskripsi' => 'Monitor Dell 24 Inch',
                'price' => 2500000,
            ],
            [
                'itemId' => 'ITEM-005',
                'deskripsi' => 'Printer Epson L3110',
                'price' => 2100000,
            ],
            [
                'itemId' => 'ITEM-006',
                'deskripsi' => 'Flashdisk SanDisk 64GB',
                'price' => 85000,
            ],
            [
                'itemId' => 'ITEM-007',
                'deskripsi' => 'Hardisk Eksternal WD 1TB',
                'price' => 750000,
            ],
            [
                'itemId' => 'ITEM-008',
                'deskripsi' => 'Headset Gaming Razer',
                'price' => 600000,
            ],
            [
                'itemId' => 'ITEM-009',
                'deskripsi' => 'Webcam Logitech C920',
                'price' => 1100000,
            ],
            [
                'itemId' => 'ITEM-010',
                'deskripsi' => 'SSD Samsung NVMe 512GB',
                'price' => 850000,
            ],
        ];

        DB::table('items')->insert($items);
    }
}
