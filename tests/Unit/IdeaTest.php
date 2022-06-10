<?php

namespace Tests\Unit;

use App\Http\Livewire\IdeaShow;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Livewire\Request;
use Tests\TestCase;


class IdeaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_check_if_idea_is_voted_for_by_user()
    {
        $user = User::factory()->create();
        $user->votedIdeas()->attach($idea = Idea::factory()->create());

        $this->assertTrue($idea->isVotedByUser($user->id));
    }


    public function test_can_check_if_idea_is_not_voted_for_by_user()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        $this->assertFalse($idea->isVotedByUser($user->id));
        $user->votedIdeas()->attach($idea2 = Idea::factory()->create());
        $this->assertFalse($idea->isVotedByUser($user->id));
    }

    public function test_can_check_if_idea_is_not_voted_for_guest_user()
    {
        $idea = Idea::factory()->create();
        $this->assertFalse($idea->isVotedByUser(null));
    }

    public function test_user_can_vote_the_idea()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();
        $idea->load(['user', 'category', 'status'])
            ->loadCount('votedUsers as votedUsersCount');
        $this->assertFalse($idea->isVotedByUser($user->id));
        Livewire::actingAs($user)->test(IdeaShow::class, compact('idea'))
            ->call('vote');
        $this->assertTrue($idea->isVotedByUser($user->id));
    }

    public function test_user_can_unvote_the_idea()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();
        $idea->load(['user', 'category', 'status'])
            ->loadCount('votedUsers as votedUsersCount');
        Livewire::actingAs($user)->test(IdeaShow::class, compact('idea'))
            ->call('vote')
            ->call('vote');
        $this->assertFalse($idea->isVotedByUser($user->id));
    }

}
