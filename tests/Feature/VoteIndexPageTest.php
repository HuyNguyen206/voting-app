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

class VoteIndexPageTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_page_contains_idea_index_livewire_component()
    {
        Idea::factory(10)->create();
        $response = $this->actingAs(User::factory()->create())->get('/');
        $response->assertSeeLivewire('idea-index');
        $response->assertStatus(200);
    }
    public function test_index_page_correctly_receive_votes_counts()
    {
        $users = User::factory(15)->create();
        $idea = Idea::factory()->create();
        $idea->votedUsers()->attach($users->pluck('id')->toArray());

        $response = $this->actingAs(User::factory()->create())->get(route('ideas.index', $idea));
        $response->assertSee('<div class="font-semibold text-2xl">15</div>', false);
    }
    public function test_index_page_correctly_receive_votes_counts_in_livewire_component()
    {

        $users = User::factory(15)->create();
        $idea = Idea::factory()->create();
        $idea->votedUsers()->attach($users->pluck('id')->toArray());
        Livewire::test(IdeaIndex::class, [
            'idea' => $idea->loadCount('votedUsers as votedUsersCount')
        ])->assertSeeHtml('<div class="font-semibold text-2xl">15</div>');
    }

    public function test_user_login_can_see_voted_if_he_already_vote_that_idea()
    {

        $user = User::factory()->create();
        $idea = Idea::factory()->create();
        $idea->votedUsers()->attach($user->id);
        $this->actingAs($user)->get(route('ideas.index'))->assertSee('Voted');
    }


    public function test_user_not_login_redirect_to_login_page_when_click_on_vote()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();
        $idea->votedUsers()->attach($user->id);
        Livewire::test(IdeaIndex::class, [
            'idea' => $idea
        ])->call('vote')->assertRedirect(route('login'));
    }
}
