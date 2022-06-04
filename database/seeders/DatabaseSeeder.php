<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
        $huy = User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com',
            'name' => 'huy'
        ]);
        Category::factory(10)->create();
        Idea::factory(5)->create([
            'user_id' => $huy->id
        ]);
        Idea::factory(30)->create();
    }
}
