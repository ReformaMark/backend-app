<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            // Branch 1 Products
            [
                'name'       => 'Steel Pipes',
                'amount'      => 1200,
                'branch_id'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Cement Bags',
                'amount'      => 250,
                'branch_id'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Branch 2 Products
            [
                'name'       => 'Electrical Wires',
                'amount'      => 800,
                'branch_id'  => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Paint Buckets',
                'amount'      => 600,
                'branch_id'  => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
