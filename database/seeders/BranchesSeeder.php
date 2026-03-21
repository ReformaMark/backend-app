<?php

namespace Database\Seeders;

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $branches = [
            [
                'name' => 'Caloocan Office',
                'location' => '130‑A 6th Street, 7th Ave, Grace Park East, Caloocan City, Metro Manila 1403',
            ],
            [
                'name' => 'Ortigas Office',
                'location' => '3/F Padilla Building, F. Ortigas Jr. Road, Ortigas Center, Pasig City, Metro Manila 1605',
            ],
        ];

        DB::table('branches')->insert($branches);
    }
}
