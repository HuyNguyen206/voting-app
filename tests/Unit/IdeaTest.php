<?php

namespace Tests\Unit;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
