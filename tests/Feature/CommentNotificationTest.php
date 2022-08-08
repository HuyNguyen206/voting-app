<?php

namespace Tests\Feature;

use App\Http\Livewire\AddComment;
use App\Http\Livewire\CommentNotification;
use App\Http\Livewire\DeleteIdea;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Livewire;
use Livewire\Response;
use Tests\TestCase;

class CommentNotificationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_idea_notification_livewire_component_show_when_user_login()
    {
        $this->actingAs(User::factory()->create())->get(route('ideas.index'))->assertSeeLivewire(CommentNotification::class);
    }

    public function test_add_comment_livewire_component_not_render_when_user_log_out()
    {
        $this->get(route('ideas.index'))->assertDontSeeLivewire(CommentNotification::class);
    }

    public function test_notification_show_for_login_user()
    {
        $idea = Idea::factory()->create(['user_id' => $user = User::factory()->create()]);
        $this->actingAs($user)->get(route('ideas.index'))
            ->assertDontSee('<div class="absolute top-0 -right-1 rounded-full bg-red text-white w-5 h-5"></div>', false);
        $userCommenter = User::factory()->create();
        $userCommenterB = User::factory()->create();
        Livewire::actingAs($userCommenter)->test(AddComment::class)
            ->set('idea', $idea)
            ->set('body', 'test')
            ->call('addComment');
        Livewire::actingAs($userCommenterB)->test(AddComment::class)
            ->set('idea', $idea)
            ->set('body', 'another one')
            ->call('addComment');

        Livewire::actingAs($user)->test(CommentNotification::class)
            ->set('user', $user)
            ->assertSet('notificationCount', 2);

        $this->actingAs($user)->get(route('ideas.index'))
            ->assertSee('<div class="absolute top-0 -right-1 rounded-full bg-red text-white w-5 h-5">2</div>', false);

    }

    public function test_notification_count_show_greated_than_limit_for_login_user()
    {
        $idea = Idea::factory()->create(['user_id' => $user = User::factory()->create()]);
        $this->actingAs($user)->get(route('ideas.index'))
            ->assertDontSee('<div class="absolute top-0 -right-1 rounded-full bg-red text-white w-5 h-5"></div>', false);
        $userCommenter = User::factory()->create();
        $limit = CommentNotification::MAX_NOTIFICATION_DISPLAY;
        foreach (range(1,$limit + 1) as $loop) {
            Livewire::actingAs($userCommenter)->test(AddComment::class)
                ->set('idea', $idea)
                ->set('body', 'test')
                ->call('addComment');
        }

        Livewire::actingAs($user)->test(CommentNotification::class)
            ->set('user', $user)
            ->assertSet('notificationCount', "$limit+")
            ->assertSee("$limit+");

    }

    public function test_can_mark_all_notification_as_read_login_user()
    {
        $idea = Idea::factory()->create(['user_id' => $user = User::factory()->create()]);
        $userCommenter = User::factory()->create();
        $limit = CommentNotification::MAX_NOTIFICATION_DISPLAY;
        foreach (range(1,$limit + 1) as $loop) {
            Livewire::actingAs($userCommenter)->test(AddComment::class)
                ->set('idea', $idea)
                ->set('body', 'test')
                ->call('addComment');
        }
        $this->assertEquals($limit + 1, $user->unreadNotifications()->count());

        Livewire::actingAs($user)->test(CommentNotification::class)
            ->set('user', $user)
            ->assertSet('notificationCount', "$limit+")
            ->call('markAllAsRead')
            ->assertSet('notificationCount', 0);
        $this->assertEquals(0, $user->unreadNotifications()->count());

    }

    public function test_can_mark_individual_notification_as_read_login_user()
    {
        $idea = Idea::factory()->create(['user_id' => $user = User::factory()->create()]);
        $userCommenter = User::factory()->create();
        $limit = CommentNotification::MAX_NOTIFICATION_DISPLAY;
        foreach (range(1,$limit + 1) as $loop) {
            Livewire::actingAs($userCommenter)->test(AddComment::class)
                ->set('idea', $idea)
                ->set('body', 'test')
                ->call('addComment');
        }

        $firstNotification = DatabaseNotification::first();

        Livewire::actingAs($user)->test(CommentNotification::class)
            ->set('user', $user)
            ->assertSet('notificationCount', "$limit+")
            ->call('markAsRead', $firstNotification->id)
            ->assertRedirect($firstNotification->data['linkToIdea'] . "?page=1");

        $this->assertNotNull($firstNotification->fresh()->read_at);

        $this->assertEquals($limit, $user->unreadNotifications()->count());

    }

    public function test_notification_idea_delete_redirect_to_index_page()
    {
        $this->withoutExceptionHandling();
        $idea = Idea::factory()->create(['user_id' => $user = User::factory()->create()]);
        $userCommenter = User::factory()->create();
        $limit = CommentNotification::MAX_NOTIFICATION_DISPLAY;
        foreach (range(1,$limit + 1) as $loop) {
            Livewire::actingAs($userCommenter)->test(AddComment::class)
                ->set('idea', $idea)
                ->set('body', 'test')
                ->call('addComment');
        }

//        $idea->comments()->delete();
        $idea->delete();

        $firstNotification = DatabaseNotification::first();

        Livewire::actingAs($user)->test(CommentNotification::class)
            ->set('user', $user)
            ->assertSet('notificationCount', "$limit+")
            ->call('markAsRead', $firstNotification->id)
            ->assertRedirect(route('ideas.index'));

    }

    public function test_notification_comment_delete_redirect_to_index_page()
    {
        $this->withoutExceptionHandling();
        $idea = Idea::factory()->create(['user_id' => $user = User::factory()->create()]);
        $userCommenter = User::factory()->create();
        $limit = CommentNotification::MAX_NOTIFICATION_DISPLAY;
        foreach (range(1,$limit + 1) as $loop) {
            Livewire::actingAs($userCommenter)->test(AddComment::class)
                ->set('idea', $idea)
                ->set('body', 'test')
                ->call('addComment');
        }

        $firstNotification = DatabaseNotification::first();
        $commentId = $firstNotification->data['commentId'];
        Comment::where('id', $commentId)->delete();

        Livewire::actingAs($user)->test(CommentNotification::class)
            ->set('user', $user)
            ->assertSet('notificationCount', "$limit+")
            ->call('markAsRead', $firstNotification->id)
            ->assertRedirect(route('ideas.index'));

    }
}
