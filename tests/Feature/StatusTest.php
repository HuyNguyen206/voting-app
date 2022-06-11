<?php

namespace Tests\Feature;

use App\Http\Livewire\StatusFilters;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_count_of_each_status()
    {
        $consider = Status::factory()->create([
           'name' => 'Considering'
        ]);
        Idea::factory(5)->create([
            'status_id' => $consider
        ]);

        $inProgress = Status::factory()->create([
            'name' => 'In Progress'
        ]);
        Idea::factory(6)->create([
            'status_id' => $inProgress
        ]);

        $implemented = Status::factory()->create([
            'name' => 'Implemented'
        ]);
        Idea::factory(7)->create([
            'status_id' => $implemented
        ]);

        $close = Status::factory()->create([
           'name' =>  'Close'
        ]);
        Idea::factory(8)->create([
            'status_id' => $close
        ]);
        Livewire::test(StatusFilters::class)->assertSee('All ideas (26)')
            ->assertSee('Considering (5)')
            ->assertSee('In Progress (6)')
            ->assertSee('Implemented (7)')
            ->assertSee('Closed (8)');
    }
}
