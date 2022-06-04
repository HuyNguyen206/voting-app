<?php

namespace Tests\Feature;

use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_of_idea_show_on_main_page()
    {
        $ideaOne = Idea::factory()->create();
        $ideaTwo = Idea::factory()->create();
        $response = $this->get(route('ideas.index'));
        $response->assertStatus(200);
        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaTwo->title);

        $response->assertSee($ideaOne->category->name);
        $response->assertSee($ideaTwo->category->name);
    }

    public function test_show_correct_idea_on_page()
    {
        $idea = Idea::factory()->create();
        $response = $this->get(route('ideas.show', $idea->slug));
        $response->assertSuccessful();
        $response->assertSee($idea->title);
        $response->assertSee($idea->category->name);
    }

    public function test_ideas_pagination_works()
    {
        $ideas = Idea::factory(6)->create();
        $ideaOne = $ideas->first();
        $ideaSix= $ideas->last();

        $pageOne = $this->get(route('ideas.index'));
        $pageOne->assertSee($ideaOne->title);
        $pageOne->assertDontSee($ideaSix->title);

        $pageTwo = $this->get(route('ideas.index', ['page' => 2]));
        $pageTwo->assertSee($ideaSix->title);
        $pageTwo->assertDontSee($ideaOne->title);

    }

    public function test_same_ideas_title_with_different_slug()
    {
        $idea1 = Idea::factory()->create([
            'title' => 'title'
        ]);
        $idea2 = Idea::factory()->create([
            'title'=> 'title'
        ]);
        $this->assertNotEquals($idea1->slug, $idea2->slug);


    }
}
