<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
     public function run(): void
    {
        $categories = Category::factory()->count(5)->create();

        \App\Models\Product1::factory()
            ->count(2000)
            ->recycle($categories)
            ->create();

        User::factory(20)->create();
    }
}
