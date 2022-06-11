<?php

namespace Tests\Feature;

use App\Http\Livewire\StatusFilters;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
            'class' => 'bg-purple text-white'
        ]);
        Idea::factory(5)->create([
            'status_id' => $consider
        ]);
        $this->get(route('ideas.index', ['status' => 'considering']))
            ->assertSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl bg-purple text-white">Considering</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl bg-green text-white">Implemented</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl bg-yellow text-white">In Progress</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl bg-red text-white">Closed</button>', false);


        $implemented = Status::factory()->create([
            'name' => 'Implemented',
            'class' => 'bg-green text-white'
        ]);
        Idea::factory(5)->create([
            'status_id' => $implemented
        ]);

        $this->get(route('ideas.index', ['status' => 'implemented']))
            ->assertSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl bg-green text-white">Implemented</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl bg-purple text-white">Considering</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl bg-yellow text-white">In Progress</button>', false)
            ->assertDontSee('<button class="px-6 py-2 font-semibold uppercase rounded-xl bg-red text-white">Closed</button>', false);
    }
}
