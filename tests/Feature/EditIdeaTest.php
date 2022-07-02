<?php

namespace Tests\Feature;

use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EditIdeaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_edit_idea_livewire_component_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSeeLivewire(EditIdea::class);
//
//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to edit your idea from the time you created');
    }

    public function test_edit_idea_livewire_component_not_show_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSeeLivewire(EditIdea::class);

//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to edit your idea from the time you created');
    }


    public function test_edit_idea_validation_work()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $response = Livewire::actingAs($user)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', '')
            ->set('category', 5)
            ->call('updateIdea')
            ->assertHasErrors(['title', 'category'])
            ->assertSee('The title field is required');
    }

    public function test_edit_idea_work_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        Livewire::actingAs($user)->test(EditIdea::class, [
            'idea' => $idea
        ])->assertSee('You have one hour to edit your idea from the time you created')
        ->set('title', 'test')
        ->set('description', 'test desc')
        ->set('category', $category->id)
        ->call('updateIdea')
        ->assertEmittedTo(IdeaShow::class, 'updateIdea');
        $this->assertDatabaseHas('ideas', [
            'user_id' => $user->id,
            'id' => $idea->id,
            'title' => 'test',
            'description' => 'test desc',
        ]);
    }

    public function test_edit_idea_show_on_menu_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSee('Edit idea');
    }

    public function test_edit_idea_not_show_on_menu_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSee('Edit idea');

        $this->actingAs(User::factory()->create())->get(route('ideas.show', $idea->slug))
            ->assertDontSee('Edit idea');
    }

    public function test_edit_idea_not_work_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();

        Livewire::test(EditIdea::class, [
            'idea' => $idea
        ])->assertSee('You have one hour to edit your idea from the time you created')
            ->set('title', 'test')
            ->set('description', 'test desc')
            ->set('category', $category->id)
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
//
        Livewire::actingAs(User::factory()->create())->test(EditIdea::class, [
            'idea' => $idea
        ])->assertSee('You have one hour to edit your idea from the time you created')
            ->set('title', 'test')
            ->set('description', 'test desc')
            ->set('category', $category->id)
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);

    }


    public function test_edit_idea_not_work_when_user_not_authorization_because_the_idea_was_created_more_than_one_hour_ago()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc', 'created_at' => now()->subHour(2)]);
        $category = Category::factory()->create();

        Livewire::actingAs($user)->test(EditIdea::class, [
            'idea' => $idea
        ])->assertSee('You have one hour to edit your idea from the time you created')
            ->set('title', 'test')
            ->set('description', 'test desc')
            ->set('category', $category->id)
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        Livewire::test(EditIdea::class, [
            'idea' => $idea
        ])->assertSee('You have one hour to edit your idea from the time you created')
            ->set('title', 'test')
            ->set('description', 'test desc')
            ->set('category', $category->id)
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);

    }
}
