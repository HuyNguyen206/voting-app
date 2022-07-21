<?php

namespace Tests\Feature\Comments;

use App\Http\Livewire\DeleteComment;
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

class DeleteCommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_delete_comment_livewire_component_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $idea->comments()->saveMany(Comment::factory(5)->make(['user_id' => $user]));
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSeeLivewire(DeleteComment::class);
//
//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to edit your idea from the time you created');
    }

    public function test_delete_comment_livewire_component_not_show_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSeeLivewire(DeleteComment::class);

//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to edit your idea from the time you created');
    }

    public function test_delete_comment_is_set_correctly_when_user_click_it_from_menu()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $idea->comments()->saveMany($comments = Comment::factory(5)->make(['user_id' => $user]));
        $firstComment = $comments->first();
        $response = Livewire::actingAs($user)
            ->test(DeleteComment::class, ['idea' => $idea])
            ->call('setDeleteComment', $firstCommentId = $firstComment->id)
            ->assertSet('commentId', $firstCommentId);
    }

    public function test_delete_comment_work_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $this->assertEquals(0, Comment::count());
        $idea->comments()->save($comment = Comment::factory()->make(['user_id' => $user->id, 'body' => 'Test']));
        $this->assertEquals(1, Comment::count());
//
        Livewire::actingAs($user)
            ->test(DeleteComment::class)
            ->call('setDeleteComment', $firstCommentId = $comment->id)
            ->call('deleteComment');
        $this->assertEquals(0, Comment::count());

        $this->assertDatabaseMissing('comments', $comment->toArray());
    }

    public function test_delete_comment_show_on_menu_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSee('Delete comment');
    }

    public function test_delete_comment_not_show_on_menu_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $idea->comments()->save($comment = Comment::factory()->make(['user_id' => $user->id, 'body' => 'Test']));
        $category = Category::factory()->create();
//
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSee('Delete comment');
    }

    public function test_delete_comment_not_work_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $idea->comments()->save($comment = Comment::factory()->make(['user_id' => $user->id, 'body' => 'Test']));

        Livewire::actingAs(User::factory()->create())
            ->test(DeleteComment::class)
            ->call('setDeleteComment', $firstCommentId = $comment->id)
            ->call('deleteComment')
            ->assertStatus(Response::HTTP_FORBIDDEN);

    }
}
