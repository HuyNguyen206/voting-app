<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        return [
            'user_id' => User::factory()->create(),
            'title' => $title = ucwords($this->faker->words(4, true)),
//            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(5)
        ];
    }
}
