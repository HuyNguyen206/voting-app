<?php

namespace Tests\Feature;

use App\Http\Livewire\StatusFilters;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StatusFillterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page_contain_status_filter_livewire_component()
    {
        Idea::factory(10)->create();
        $response = $this->get(route('ideas.index'))
            ->assertSeeLivewire(StatusFilters::class);

        $response->assertStatus(200);
    }

    public function test_show_page_contain_status_filter_livewire_component()
    {
        $idea = Idea::factory()->create();
        $response = $this->get(route('ideas.show', $idea))
            ->assertSeeLivewire(StatusFilters::class);

        $response->assertStatus(200);
    }

    public function test_fillter_work_when_has_query_status_string()
    {
        $consider = Status::factory()->create([
            'name' => 'Considering',
        ]);
        Idea::factory(5)->create([
            'status_id' => $consider
        ]);
        $this->get(route('ideas.index', ['status' => 'considering']))
            ->assertSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-considering">Considering</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-implemented">Implemented</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-in-progress">In Progress</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-closed">Closed</button>', false);


        $implemented = Status::factory()->create([
            'name' => 'Implemented',
        ]);
        Idea::factory(5)->create([
            'status_id' => $implemented
        ]);

        $this->get(route('ideas.index', ['status' => 'implemented']))
            ->assertSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-implemented">Implemented</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-considering">Considering</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-in-progress">In Progress</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl status-idea-closed">Closed</button>', false);
    }

    public function test_show_page_does_not_show_selected()
    {
        $consider = Status::factory()->create([
            'name' => 'Considering',
        ]);
       $ideas = Idea::factory(5)->create([
            'status_id' => $consider
        ]);
        $this->get(route('ideas.show', $ideas->first()))
            ->assertDontSee('font-semibold text-gray-800 border-blue', false);

    }

    public function test_index_page_show_selected()
    {
        $consider = Status::factory()->create([
            'name' => 'Considering',
        ]);
       $ideas = Idea::factory(5)->create([
            'status_id' => $consider
        ]);
        $this->get(route('ideas.index'))
            ->assertSee('font-semibold text-gray-800 border-blue', false);

    }
}
