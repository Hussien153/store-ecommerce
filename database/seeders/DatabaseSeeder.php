<?php

namespace Database\Seeders;
namespace Database\Factories;

use App\Models\Product;
use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Product::factory()->count(10)->create();
    }
}