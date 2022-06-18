<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class OtherFilterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_voted_filter_work_when_user_login()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'PHP']);
        $idea = Idea::factory()->create([
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);
        $idea2 = Idea::factory()->create([
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);

        $idea3 =Idea::factory()->create([
            'category_id' => $category->id
        ]);
        $idea4 =Idea::factory()->create([
            'category_id' => $category->id
        ]);
        $idea2->votedUsers()->attach(User::factory(4)->create());
        $idea3->votedUsers()->attach(User::factory(5)->create());
        $idea4->votedUsers()->attach(User::factory(6)->create());

        //Assert my_ideas
        Livewire::actingAs($user)->test(IdeasIndex::class)->set('filter', 'my_ideas')
            ->assertViewHas('ideas', function ($ideas) use($user) {
            return $ideas->count() == 2 && $ideas->random()->user_id == $user->id;
        });

        //Assert top_voted
        Livewire::actingAs($user)->test(IdeasIndex::class)->set('filter', 'top_voted')
            ->assertViewHas('ideas', function ($ideas) use($idea4, $idea3, $idea2, $idea) {
                $isTopVotedIdea = $ideas->first()->is($idea4);
                $isSecondVotedIdea = $ideas->get(1)->is($idea3);
                $isThirdVotedIdea = $ideas->get(2)->is($idea2);
                $isLastVotedIdea = $ideas->get(3)->is($idea);
            return $isTopVotedIdea && $isSecondVotedIdea && $isThirdVotedIdea && $isLastVotedIdea;
        });


    }

    public function test_voted_filter_work_when_user_not_login()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'PHP']);
        $idea = Idea::factory()->create([
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);
        $idea2 = Idea::factory()->create([
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);

        $idea3 =Idea::factory()->create([
            'category_id' => $category->id
        ]);
        $idea4 =Idea::factory()->create([
            'category_id' => $category->id
        ]);
        $idea2->votedUsers()->attach(User::factory(4)->create());
        $idea3->votedUsers()->attach(User::factory(5)->create());
        $idea4->votedUsers()->attach(User::factory(6)->create());

        //Assert my_ideas
        Livewire::test(IdeasIndex::class)->set('filter', 'my_ideas')
            ->assertRedirect(route('login'));

        //Assert top_voted
        Livewire::test(IdeasIndex::class)->set('filter', 'top_voted')
            ->assertViewHas('ideas', function ($ideas) use($idea4, $idea3, $idea2, $idea) {
                $isTopVotedIdea = $ideas->first()->is($idea4);
                $isSecondVotedIdea = $ideas->get(1)->is($idea3);
                $isThirdVotedIdea = $ideas->get(2)->is($idea2);
                $isLastVotedIdea = $ideas->get(3)->is($idea);
            return $isTopVotedIdea && $isSecondVotedIdea && $isThirdVotedIdea && $isLastVotedIdea;
        });


    }
}
