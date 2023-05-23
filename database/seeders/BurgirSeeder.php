<?php

namespace Database\Seeders;

use App\Models\Burgir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BurgirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Burgir::factory()->create([
            'name' => "CBO",
            'price' => "5",
            //'user_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Burgir::factory()->count(20)->create();
    }
}
