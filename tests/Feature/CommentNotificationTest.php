<?php

namespace Tests\Feature;

use App\Http\Livewire\AddComment;
use App\Http\Livewire\CommentNotification;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        $this->actingAs($user)->get(route('ideas.index'))
            ->assertSee('<div class="absolute top-0 -right-1 rounded-full bg-red text-white w-5 h-5">2 </div>', false);

    }
}
