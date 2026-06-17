<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'cust_nama' => 'Budi Santoso',
                'cust_alamat' => 'Jl. Sudirman No 1, Jakarta',
                'cust_hp' => '081234567890',
            ],
            [
                'cust_nama' => 'Siti Aminah',
                'cust_alamat' => 'Jl. Thamrin No 2, Bandung',
                'cust_hp' => '081298765432',
            ],
            [
                'cust_nama' => 'Andi Wijaya',
                'cust_alamat' => 'Jl. Gatot Subroto No 3, Surabaya',
                'cust_hp' => '081311223344',
            ],
            [
                'cust_nama' => 'Rina Wati',
                'cust_alamat' => 'Jl. Malioboro No 4, Yogyakarta',
                'cust_hp' => '081455667788',
            ],
            [
                'cust_nama' => 'Joko Anwar',
                'cust_alamat' => 'Jl. Diponegoro No 5, Semarang',
                'cust_hp' => '081599887766',
            ],
        ];

        DB::table('customers')->insert($customers);
    }
}
