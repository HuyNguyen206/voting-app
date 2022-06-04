<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class IdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryIds = Category::all(['id'])->pluck('id')->toArray();
        $statusIds = Status::all(['id'])->pluck('id')->toArray();
        return [
            'user_id' => User::factory(),
            'category_id' =>  $categoryIds ? Arr::random($categoryIds) : Category::factory(),
            'status_id' =>  $statusIds ? Arr::random($statusIds) : Status::factory(),
            'title' => $title = ucwords($this->faker->words(4, true)),
//            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(5)
        ];
    }
}
