<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowIdeasTest extends TestCase {

    use RefreshDatabase;

    public function test_list_of_idea_show_on_main_page()
    {
        $openStatus = $this->getOpenStatus();

        $consideringStatus = Status::create([
            'name' => 'Considering',
        ]);
        $ideaOne = Idea::factory()->create(['status_id' => $openStatus->id]);
        $ideaTwo = Idea::factory()->create(['status_id' => $consideringStatus->id]);

        $response = $this->get(route('ideas.index'));
        $response->assertStatus(200);
        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaTwo->title);

        $response->assertSee($ideaOne->category->name);
        $response->assertSee($ideaTwo->category->name);

        $response->assertSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-open">Open</button>', false);
        $response->assertSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-considering">Considering</button>', false);
    }

    public function test_show_correct_idea_on_page()
    {
        $this->withoutExceptionHandling();
        $openStatus = $this->getOpenStatus();
        $idea = Idea::factory()->create([
            'status_id' => $openStatus->id
        ]);
        $response = $this->get(route('ideas.show', $idea->slug));
        $response->assertSuccessful();
        $response->assertSee($idea->title);
        $response->assertSee($idea->category->name);
    }

    public function test_ideas_pagination_works()
    {
        $openStatus = $this->getOpenStatus();
        $openStatus->ideas()->saveMany(Idea::factory(11)->make());
        $ideas = Idea::all();
        $ideaOne = $ideas->first();
        $ideaElevent = $ideas->last();

        $pageOne = $this->get(route('ideas.index'));
        $pageOne->assertSee($ideaOne->title);
        $pageOne->assertDontSee($ideaElevent->title);

        $pageTwo = $this->get(route('ideas.index', ['page' => 2]));
        $pageTwo->assertSee($ideaElevent->title);
        $pageTwo->assertDontSee($ideaOne->title);

    }

    public function test_same_ideas_title_with_different_slug()
    {
        $openStatus = $this->getOpenStatus();
        $idea1 = Idea::factory()->create([
            'title' => 'title',
            'status_id' => $openStatus->id
        ]);
        $idea2 = Idea::factory()->create([
            'title' => 'title',
            'status_id' => $openStatus->id
        ]);
        $this->assertNotEquals($idea1->slug, $idea2->slug);
    }

    /**
     * @return mixed
     */
    private function getOpenStatus()
    {
        $openStatus = Status::create([
            'name' => 'Open',
        ]);

        return $openStatus;
    }

    /**
     * @return mixed
     */
    private function getImplementedStatus()
    {
        $openStatus = Status::create([
            'name' => 'Implemented',
        ]);

        return $openStatus;
    }

    public function test_get_back_url_work()
    {
        $implemented = $this->getImplementedStatus();

        $consideringStatus = Status::create([
            'name' => 'Considering',
        ]);
        $category = Category::factory()->create([
            'name' => 'PHP'
        ]);
        $ideaOne = Idea::factory()->create(['status_id' => $implemented->id, 'category_id'=> $category->id]);
        $ideaTwo = Idea::factory()->create(['status_id' => $consideringStatus->id]);

        $response = $this->get(route('ideas.index', ['status' => 'implemented', 'category' => 'php']));
        $queryString = http_build_query(['category' => 'php','status' => 'implemented']);
        $response2 = $this->get(route('ideas.show', $ideaOne->slug))
            ->assertViewHas('url', route('ideas.index'). '/?' .$queryString);

        $this->assertStringContainsString($queryString, $response2['url']);
        $response3= $this->get(route('ideas.show', $ideaOne->slug))
            ->assertViewHas('url', route('ideas.index'));
        $this->assertEquals(route('ideas.index'), $response3['url']);

//        issuense->assertSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl bg-purple text-white">Considering</button>', false);
    }

}
