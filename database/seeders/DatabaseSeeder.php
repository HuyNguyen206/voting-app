<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Status;
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
        $this->call(CategorySeeder::class);
       $this->call(StatusSeeder::class);
        Idea::factory(5)->create([
            'user_id' => $huy->id
        ]);
        Idea::factory(30)->create();
        $this->call(VoteSeeder::class);
        $users = User::all();

        Idea::all()->each(function ($idea) use($users){
           $idea->comments()->saveMany(Comment::factory(random_int(2, 5))->make([
               'user_id' => $users->random(),
               'idea_id' => $idea
           ]));
        });
    }
}
