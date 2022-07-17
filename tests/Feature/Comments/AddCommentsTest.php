<?php

namespace Tests\Feature\Comments;

use App\Http\Livewire\AddComment;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AddCommentsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_comment_livewire_component_render()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $response = $this->actingAs($user)->get(route('ideas.show', $idea->slug));
        $response->assertSee("Go ahead, don't be shy. Share your thought...", false)
        ->assertSeeLivewire(AddComment::class);
    }

    public function test_add_comment_livewire_component_not_render_when_user_log_out()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $response = $this->get(route('ideas.show', $idea->slug));
        $response->assertSee("Please login or register to add comment", false)
        ->assertSeeLivewire(AddComment::class);
    }

    public function test_add_comment_form_validation_work()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);

        $response = Livewire::actingAs($user)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('body', '')
            ->call('addComment')
            ->assertHasErrors(['body'])
            ->assertSee('The body field is required')
            ->set('body', 'a')
            ->call('addComment')
            ->assertHasErrors(['body'])
            ->assertSee('The body must be at least 2 characters.');

    }

    public function test_add_comment_form_work()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $this->assertCount(0, Comment::all());
        $this->assertDatabaseMissing('comments', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::actingAs($user)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('body', 'This is test')
            ->call('addComment')
            ->assertEmitted('updateIdea');
        $this->assertCount(1, Comment::all());
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

    }
}
