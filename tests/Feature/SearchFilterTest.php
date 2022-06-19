<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_search_filter_work()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'PHP']);
        $idea = Idea::factory()->create([
            'title' => 'This is huy',
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);
        $idea2 = Idea::factory()->create([
            'title' => 'This is huy second time',
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);

        $idea3 =Idea::factory()->create([
            'category_id' => $category->id
        ]);
        $idea4 =Idea::factory()->create([
            'category_id' => $category->id
        ]);
        //Assert my_ideas
        Livewire::test(IdeasIndex::class)->set('search', 'huy')
            ->assertViewHas('ideas', function ($ideas) use($user, $idea) {
                return $ideas->contains('id', $idea->id);
            })
            ->assertViewHas('ideas', function ($ideas) use($user, $idea2) {
                return $ideas->contains('id', $idea2->id);
            })
            ->assertViewHas('ideas', function ($ideas) use($user, $idea3, $idea4) {
                return !$ideas->contains('id', $idea3->id) && !$ideas->contains('id', $idea4->id);
            });

    }
}
