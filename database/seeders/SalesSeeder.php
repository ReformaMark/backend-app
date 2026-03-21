<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sales')->insert([
            [
                'product_id'     => 1,   // Steel Pipes
                'branch_id'      => 1,
                'product_name'   => 'Steel Pipes',
                'product_price'  => 1200,
                'total_quantity' => 10,
                'total_amount'   => 12000,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'product_id'     => 2,   // Cement Bags
                'branch_id'      => 1,
                'product_name'   => 'Cement Bags',
                'product_price'  => 250,
                'total_quantity' => 50,
                'total_amount'   => 12500,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'product_id'     => 3,   // Electrical Wires
                'branch_id'      => 2,
                'product_name'   => 'Electrical Wires',
                'product_price'  => 800,
                'total_quantity' => 20,
                'total_amount'   => 16000,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'product_id'     => 4,   // Paint Buckets
                'branch_id'      => 2,
                'product_name'   => 'Paint Buckets',
                'product_price'  => 600,
                'total_quantity' => 15,
                'total_amount'   => 9000,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
