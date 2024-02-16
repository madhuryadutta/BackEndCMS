<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = faker::create();
        for ($i = 1; $i < 100; $i++) {
            $Category = new Category;
            $Category->parent_id = $i;
            $Category->category_name = Str::random(10);
            $Category->is_active = 1;
            $Category->save();
        }
    }
}
