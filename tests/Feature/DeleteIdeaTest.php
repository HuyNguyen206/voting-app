<?php

namespace Tests\Feature;

use App\Http\Livewire\DeleteIdea;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteIdeaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_idea_livewire_component_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSeeLivewire(DeleteIdea::class);
//
//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to delete your idea from the time you created');
    }

    public function test_delete_idea_livewire_component_not_show_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSeeLivewire(DeleteIdea::class);

//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to delete your idea from the time you created');
    }


    public function test_delete_idea_work_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        Livewire::actingAs($user)->test(DeleteIdea::class, [
            'idea' => $idea
        ])
        ->call('deleteIdea')
        ->assertRedirect(route('ideas.index'));
        $this->assertDatabaseMissing('ideas', [
            'user_id' => $user->id,
            'id' => $idea->id,
            'title' => 'test',
            'description' => 'test desc',
        ]);
    }

    public function test_delete_idea_with_vote_work_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $idea->votedUsers()->attach(User::factory(5)->create());
        $this->assertEquals(5, Vote::count());
        Livewire::actingAs($user)->test(DeleteIdea::class, [
            'idea' => $idea
        ])
        ->call('deleteIdea')
        ->assertRedirect(route('ideas.index'));
        $this->assertDatabaseMissing('ideas', [
            'user_id' => $user->id,
            'id' => $idea->id,
            'title' => 'test',
            'description' => 'test desc',
        ]);
        $this->assertEquals(0, Vote::count());
    }

    public function test_delete_idea_with_comments_work_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $idea->comments()->saveMany(Comment::factory(5)->create());
        $this->assertEquals(5, Comment::count());
        Livewire::actingAs($user)->test(DeleteIdea::class, [
            'idea' => $idea
        ])
        ->call('deleteIdea')
        ->assertRedirect(route('ideas.index'));
        $this->assertDatabaseMissing('ideas', [
            'user_id' => $user->id,
            'id' => $idea->id,
            'title' => 'test',
            'description' => 'test desc',
        ]);
        $this->assertEquals(0, Comment::count());
    }

    public function test_delete_idea_show_on_menu_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSee('Deactivate idea');
    }

    public function test_delete_idea_not_show_on_menu_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSee('Deactivate idea');

        $this->actingAs(User::factory()->create())->get(route('ideas.show', $idea->slug))
            ->assertDontSee('Deactivate idea');
    }

    public function test_delete_idea_not_work_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();

        Livewire::test(DeleteIdea::class, [
            'idea' => $idea
        ])
            ->call('deleteIdea')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
//
        Livewire::actingAs(User::factory()->create())->test(DeleteIdea::class, [
            'idea' => $idea
        ])->call('deleteIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);

    }


    public function test_can_delete_idea_when_user_is_admin()
    {
        $user = User::factory()->create(['email' => 'nguyenlehuyuit@gmail.com']);
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc', 'created_at' => now()->subHour(2)]);
        $category = Category::factory()->create();

        Livewire::actingAs($user)->test(DeleteIdea::class, [
            'idea' => $idea
        ])->call('deleteIdea');

        $this->assertDatabaseMissing('ideas', [
            'user_id' => $user->id,
            'id' => $idea->id,
            'title' => 'test',
            'description' => 'test desc',
        ]);

    }
}
