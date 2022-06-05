<?php

namespace Database\Seeders;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ideas = Idea::query()->get('id');
        User::all()->each(function (User $user) use($ideas){
            $user->votedIdeas()->attach($ideas->random(5)->pluck('id')->toArray());
        });
    }
}
