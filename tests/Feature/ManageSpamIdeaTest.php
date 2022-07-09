<?php

namespace Tests\Feature;

use App\Http\Livewire\DeleteIdea;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\IdeasIndex;
use App\Http\Livewire\MarkIdeaAsSpam;
use App\Models\Category;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ManageSpamIdeaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_mark_spam_livewire_component_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSeeLivewire(MarkIdeaAsSpam::class);
//
//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to delete your idea from the time you created');
    }

    public function test_does_not_show_mark_spam_livewire_component_not_show_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user]);
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSeeLivewire(MarkIdeaAsSpam::class);

//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to delete your idea from the time you created');
    }


    public function test_mark_spam_work_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        Livewire::actingAs($user)->test(MarkIdeaAsSpam::class, [
            'idea' => $idea
        ])
        ->call('markIdeaAsSpam');
        $this->assertDatabaseHas('ideas', [
            'user_id' => $user->id,
            'id' => $idea->id,
            'spam_reports' => 1
        ]);
    }

    public function test_mark_spam_show_on_menu_when_user_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))
            ->assertSee('Mark idea as spam');
    }

    public function test_mark_spam_not_show_on_menu_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSee('Mark idea as spam');
    }

    public function test_mark_spam_not_work_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();

        Livewire::test(MarkIdeaAsSpam::class, [
            'idea' => $idea
        ])
            ->call('markIdeaAsSpam')
            ->assertStatus(Response::HTTP_FORBIDDEN);

    }

    public function test_spam_report_count_show_on_ideas_index_page_when_user_is_admin()
    {
        $user = User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        Livewire::actingAs(User::factory()->create())->test(MarkIdeaAsSpam::class, [
            'idea' => $idea
        ])
            ->call('markIdeaAsSpam');
        $this->actingAs($user)->get(route('ideas.index'))->assertSee('Spam reports: 1');

    }

    public function test_spam_report_count_show_on_idea_show_page_when_user_is_admin()
    {
        $user = User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        Livewire::actingAs(User::factory()->create())->test(MarkIdeaAsSpam::class, [
            'idea' => $idea
        ])
            ->call('markIdeaAsSpam');
        $this->actingAs($user)->get(route('ideas.show', $idea->slug))->assertSee('Spam reports: 1');

    }

    public function test_spam_filter_work_when_user_is_admin()
    {
        $user = User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
        $category = Category::factory()->create(['name' => 'PHP']);
        $idea = Idea::factory()->create([
            'title' => 'This is huy',
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);
        $idea2 = Idea::factory()->create([
            'title' => 'This is huy second time',
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);

        $idea3 =Idea::factory()->create([
            'category_id' => $category->id
        ]);
        $idea4 =Idea::factory()->create([
            'category_id' => $category->id
        ]);
        $idea3->increment('spam_reports',2);
        $idea4->increment('spam_reports',3);
        //Assert my_ideas
        Livewire::actingAs($user)->test(IdeasIndex::class)->set('filter', 'most_spam_idea')
            ->assertViewHas('ideas', function (LengthAwarePaginator $ideas) use($idea3, $idea4) {
//                dd($ideas);
                $correctOrder = $ideas->first()->id === $idea4->id && $ideas->last()->id === $idea3->id;
                return $ideas->count() === 2 && $ideas->contains('id', $idea3->id)
                    && $ideas->contains('id', $idea4->id) && $correctOrder;
            });

        $idea3->decrement('spam_reports',2);
        $idea4->decrement('spam_reports',3);
        Livewire::actingAs($user)->test(IdeasIndex::class)->set('filter', 'most_spam_idea')
            ->assertViewHas('ideas', function (LengthAwarePaginator $ideas) use($idea3, $idea4) {
                return $ideas->count() === 0 && !$ideas->contains('id', $idea3->id)
                    && !$ideas->contains('id', $idea4->id);
            });
    }

}
