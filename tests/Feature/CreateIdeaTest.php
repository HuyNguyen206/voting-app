<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateIdea;
use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateIdeaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_idea_form_doesnot_show_when_logout()
    {
//        $this->actingAs(User::factory()->create());
        $response = $this->get('/');
        $response->assertDontSee('<input wire:model.debounce.500ms="title" placeholder="Your idea" class=" w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" type="text" name="" id="">', false);
        $response->assertSee(' Please login to add idea');
        $response->assertDontSee('Let us know what you would like and we will tak a look over!');
        $response->assertStatus(200);
    }

    public function test_create_idea_form_show_when_login()
    {
        $response = $this->actingAs(User::factory()->create())->get('/');
        $response->assertSee('<input wire:model.debounce.500ms="title" placeholder="Your idea" class=" w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" type="text" name="" id="">', false);
        $response->assertDontSee(' Please login to add idea');
        $response->assertSee('Let us know what you would like and we will tak a look over!');
        $response->assertStatus(200);
    }

    public function test_main_page_contains_create_idea_livewire_component()
    {
        $response = $this->actingAs(User::factory()->create())->get('/');
        $response->assertSeeLivewire('create-idea');
    }

    public function test_idea_form_validation_work()
    {
        $response = Livewire::actingAs(User::factory()->create())
            ->test(CreateIdea::class)
            ->set('title', '')
            ->set('category', '')
            ->call('createIdea')
             ->assertHasErrors(['title', 'category'])
            ->assertSee('The title field is required');
    }

    public function test_creating_an_idea_work_correctly()
    {
        $this->withoutExceptionHandling();
        $category = Category::factory()->create();
        $status = Status::factory()->create(['name' => 'Open', 'class' => 'test']);
        $response = Livewire::actingAs(User::factory()->create())
            ->test(CreateIdea::class)
            ->set('title', 'test')
            ->set('category', $category->id)
            ->set('description', 'tsdadsasd')
            ->call('createIdea')
            ->assertRedirect('/');
        $this->assertDatabaseHas('ideas', [
            'title' => 'test',
            'category_id' => $category->id,
            'status_id' => $status->id
        ]);
    }

    public function test_creating_two_idea_work_correctly_with_same_title_but_diff_slug()
    {
        $this->withoutExceptionHandling();
        $category = Category::factory()->create();
        $status = Status::factory()->create(['name' => 'Open', 'class' => 'test']);
        $response = Livewire::actingAs($user = User::factory()->create())
            ->test(CreateIdea::class)
            ->set('title', 'test')
            ->set('category', $category->id)
            ->set('description', 'tsdadsasd')
            ->call('createIdea')
            ->assertRedirect('/');

        $response2 = Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'test')
            ->set('category', $category->id)
            ->set('description', 'tsdadsasd')
            ->call('createIdea')
            ->assertRedirect('/');

        $this->assertDatabaseHas('ideas', [
            'title' => 'test',
            'slug' => 'test',
            'category_id' => $category->id,
            'status_id' => $status->id
        ]);

        $this->assertDatabaseHas('ideas', [
            'title' => 'test',
            'slug' => 'test-2',
            'category_id' => $category->id,
            'status_id' => $status->id
        ]);
    }
}
