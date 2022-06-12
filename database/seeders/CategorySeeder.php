<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Category::insert([
           [
               'name' => 'PHP',
               'slug' => 'php'
           ],
           [
               'name' => 'JavaScript',
               'slug' => 'java-script'
           ],
           [
               'name' => 'C++',
               'slug' => 'c'
           ],
           [
               'name' => 'Java',
               'slug' => 'java'
           ],
       ]);
    }
}
