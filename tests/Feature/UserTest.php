<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\SetStatus;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_check_if_user_is_an_admin()
    {
        $admin = User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
        $this->assertTrue($admin->isAdmin());
        $user = User::factory()->create([
            'email' => 'test@gmail.com'
        ]);
        $this->assertFalse($user->isAdmin());
    }

    public function test_show_page_contain_set_status_livewire_component_when_user_is_admin()
    {
        $status = Status::factory(5)->create();
        $admin =  User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
        $this->actingAs($admin)->get(route('ideas.show', Idea::factory()->create()->slug))
            ->assertSeeLivewire(SetStatus::class);
        $user = User::factory()->create([
            'email' => 'test@gmail.com'
        ]);
        $this->actingAs($user)->get(route('ideas.show', Idea::factory()->create()->slug))
            ->assertDontSeeLivewire(SetStatus::class);
//        Livewire::actingAs($admin)->test(IdeaShow::class, ['idea' => Idea::factory()->create()])->assertSeeHtml('<form wire:submit.prevent="updateIdea" class="px-2 py-4" action="">');
//        Livewire::actingAs($user)->test(IdeaShow::class, ['idea' => Idea::factory()->create()])->assertDontSeeHtml('<form wire:submit.prevent="updateIdea" class="px-2 py-4" action="">');

    }


    public function test_show_page_contain_set_status_livewire_component_when_user_is_not_admin()
    {
        $status = Status::factory(5)->create();
        $user = User::factory()->create([
            'email' => 'test@gmail.com'
        ]);
        $this->actingAs($user)->get(route('ideas.show', Idea::factory()->create()->slug))
            ->assertDontSeeLivewire(SetStatus::class);
//        Livewire::actingAs($admin)->test(IdeaShow::class, ['idea' => Idea::factory()->create()])->assertSeeHtml('<form wire:submit.prevent="updateIdea" class="px-2 py-4" action="">');
//        Livewire::actingAs($user)->test(IdeaShow::class, ['idea' => Idea::factory()->create()])->assertDontSeeHtml('<form wire:submit.prevent="updateIdea" class="px-2 py-4" action="">');

    }

    public function test_init_status_is_correct()
    {
        Status::factory(5)->create();
        $new = Status::factory()->create();
        $admin =  User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
//        $this->actingAs($user)->get(route('ideas.show', Idea::factory()->create(['status_id' => $new->id])->slug))
//            ->assertDontSeeLivewire(SetStatus::class);
        Livewire::actingAs($admin)->test(SetStatus::class, ['idea' => $idea = Idea::factory()->create(['status_id' => $new->id])])
            ->assertSet('status', $idea->status_id);
//        Livewire::actingAs($user)->test(IdeaShow::class, ['idea' => Idea::factory()->create()])->assertDontSeeHtml('<form wire:submit.prevent="updateIdea" class="px-2 py-4" action="">');

    }

    public function test_can_set_status_correctly()
    {
        Status::factory(5)->create();
        $new = Status::factory()->create();
        $old = Status::factory()->create();
        $admin =  User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
//        $this->actingAs($user)->get(route('ideas.show', Idea::factory()->create(['status_id' => $new->id])->slug))
//            ->assertDontSeeLivewire(SetStatus::class);
        Livewire::actingAs($admin)->test(SetStatus::class, ['idea' => $idea = Idea::factory()->create(['status_id' => $new->id])])
            ->set('status', $old->id)
            ->call('updateIdea')
            ->assertEmittedTo(IdeaShow::class, 'updateIdea');
//        Livewire::actingAs($user)->test(IdeaShow::class, ['idea' => Idea::factory()->create()])->assertDontSeeHtml('<form wire:submit.prevent="updateIdea" class="px-2 py-4" action="">');
        $this->assertDatabaseHas('ideas', ['id' => $idea->id, 'status_id' => $old->id]);
    }
}
