<?php

namespace Tests\Feature\Job;

use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\SetStatus;
use App\Jobs\SendEmailNotficationToVoterJob;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Notifications\IdeaUpdatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class NotifyAllVotersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_send_email_to_all_voters()
    {
        Status::factory(5)->create();
        $new = Status::factory()->create();
        $old = Status::factory()->create();
        $admin =  User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
        $idea = Idea::factory()->create(['status_id' => $new->id]);
        $idea->votedUsers()->attach($users = User::factory(4)->create());
        Notification::fake();
//        Queue::assertNothingPushed();
//        $this->actingAs($user)->get(route('ideas.show', Idea::factory()->create(['status_id' => $new->id])->slug))
//            ->assertDontSeeLivewire(SetStatus::class);
        Livewire::actingAs($admin)->test(SetStatus::class, ['idea' => $idea])
            ->set('status', $old->id)
            ->set('notifyUser', true)
            ->call('updateIdea')
            ->assertEmittedTo(IdeaShow::class, 'updateIdea');
        Notification::assertSentTo($users, IdeaUpdatedNotification::class);
    }
}
