<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaIndex;
use App\Http\Livewire\IdeaShow;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteShowPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_show_page_contains_idea_show_livewire_component()
    {
        $idea = Idea::factory()->create();
        $response = $this->actingAs(User::factory()->create())->get(route('ideas.show', $idea));
        $response->assertSeeLivewire('idea-show');
        $response->assertStatus(200);
    }

    public function test_show_page_correctly_receive_votes_counts()
    {

        $users = User::factory(15)->create();
        $idea = Idea::factory()->create();
        $idea->votedUsers()->attach($users->pluck('id')->toArray());

        $response = $this->actingAs(User::factory()->create())->get(route('ideas.show', $idea));
        $response->assertSee('<div class="font-semibold text-2xl">15</div>', false);
        $response->assertViewHas('idea', function ($idea){
            return $idea->votedUsers()->count() == 15;
        });
    }




    public function test_show_page_correctly_receive_votes_counts_in_livewire_component()
    {

        $users = User::factory(15)->create();
        $idea = Idea::factory()->create();
        $idea->votedUsers()->attach($users->pluck('id')->toArray());
        Livewire::test(IdeaShow::class, [
           'idea' => $idea
        ])->assertSeeHtml('<div class="font-semibold text-2xl">15</div>');
    }



}
