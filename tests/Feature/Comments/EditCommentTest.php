<?php

namespace Tests\Feature\Comments;

use App\Http\Livewire\EditComment;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EditCommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_edit_comment_livewire_component_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $idea->comments()->saveMany(Comment::factory(5)->make(['user_id' => $user]));
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSeeLivewire(EditComment::class);
//
//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to edit your idea from the time you created');
    }

    public function test_edit_comment_livewire_component_not_show_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSeeLivewire(EditComment::class);

//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to edit your idea from the time you created');
    }

    public function test_edit_comment_is_set_correctly_when_user_click_it_from_menu()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $idea->comments()->saveMany($comments = Comment::factory(5)->make(['user_id' => $user]));
        $firstComment = $comments->first();
        $response = Livewire::actingAs($user)
            ->test(EditComment::class, ['idea' => $idea])
            ->call('setEditComment', $firstCommentId = $firstComment->id)
            ->assertSet('body', $firstComment->body)
            ->assertSee('comment', $firstComment)
            ->assertDispatchedBrowserEvent('custom-show-edit-comment');
    }


    public function test_edit_comment_validation_work()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $idea->comments()->saveMany($comments = Comment::factory(5)->make(['user_id' => $user]));
        $firstComment = $comments->first();
        $response = Livewire::actingAs($user)
            ->test(EditComment::class, ['idea' => $idea])
            ->call('setEditComment', $firstCommentId = $firstComment->id)
            ->set('body', '')
            ->call('updateComment')
            ->assertHasErrors(['body'])
            ->assertSee('The body field is required')
            ->set('body', 'w')
            ->call('updateComment')
            ->assertHasErrors(['body'])
            ->assertSee('The body must be at least 2 characters.');
    }

    public function test_edit_comment_work_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $idea->comments()->save($comment = Comment::factory()->make(['user_id' => $user->id, 'body' => 'Test']));
//
        Livewire::actingAs($user)
            ->test(EditComment::class)
            ->call('setEditComment', $firstCommentId = $comment->id)
            ->set('body', 'Test update')
            ->call('updateComment');

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'idea_id' => $idea->id,
            'body' => 'Test update',
        ]);

        $this->assertEquals('Test update', Comment::find($firstCommentId)->body);
        $this->assertEquals('Test update', Comment::first()->body);
    }

    public function test_edit_comment_show_on_menu_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSee('Edit comment');
    }

    public function test_edit_comment_not_show_on_menu_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $idea->comments()->save($comment = Comment::factory()->make(['user_id' => $user->id, 'body' => 'Test']));
        $category = Category::factory()->create();
//
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSee('Edit comment');
    }

    public function test_edit_comment_not_work_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $idea->comments()->save($comment = Comment::factory()->make(['user_id' => $user->id, 'body' => 'Test']));

        Livewire::actingAs(User::factory()->create())
            ->test(EditComment::class)
            ->call('setEditComment', $firstCommentId = $comment->id)
            ->set('body', 'Test update')
            ->call('updateComment')
            ->assertStatus(Response::HTTP_FORBIDDEN);

    }
}
