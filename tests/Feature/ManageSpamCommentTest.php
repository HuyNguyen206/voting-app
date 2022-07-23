<?php

namespace Tests\Feature;

use App\Http\Livewire\DeleteIdea;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\IdeasIndex;
use App\Http\Livewire\MarkCommentAsSpam;
use App\Http\Livewire\MarkIdeaAsSpam;
use App\Models\Category;
use App\Models\Comment;
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

class ManageSpamCommentTest extends TestCase
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
            ->assertSeeLivewire(MarkCommentAsSpam::class);
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
            ->assertDontSeeLivewire(MarkCommentAsSpam::class);

//        Livewire::actingAs($user)->test(EditIdea::class, [
//            'idea' => $idea
//        ])->assertSee('You have one hour to delete your idea from the time you created');
    }


    public function test_mark_spam_work_when_user_authorization()
    {
        $this->withDeprecationHandling();
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $comment = $idea->comments()->create(Comment::factory()->make(['user_id' => $user->id])->toArray());
//
        Livewire::actingAs($user)->test(MarkCommentAsSpam::class)
            ->call('setMarkCommentAsSpam', $comment->id)
            ->call('markCommentAsSpam');

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'id' => $comment->id,
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
            ->assertSee('Mark comment as spam');
    }

    public function test_mark_spam_not_show_on_menu_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $category = Category::factory()->create();
//
        $this->get(route('ideas.show', $idea->slug))
            ->assertDontSee('Mark comment as spam');
    }

    public function test_mark_spam_not_work_when_user_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $idea->comments()->save($comment = Comment::factory()->make(['user_id' => $user->id]));
        Livewire::test(MarkCommentAsSpam::class)
            ->call('setMarkCommentAsSpam', $comment->id)
            ->call('markCommentAsSpam')
            ->assertStatus(Response::HTTP_FORBIDDEN);

    }

    public function test_spam_report_count_show_on_ideas_show_page_when_user_is_admin()
    {
        $user = User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
        $idea = Idea::factory()->create(['user_id' => $user, 'title' => 'Note', 'description' => 'note desc']);
        $idea->comments()->save($comment = Comment::factory()->make(['user_id' => $user->id]));
        Livewire::actingAs(User::factory()->create())->test(MarkCommentAsSpam::class)
            ->call('setMarkCommentAsSpam', $comment->id)
            ->call('markCommentAsSpam');

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
        $idea->comments()->saveMany($comments = Comment::factory(4)->make(['user_id' => $user->id]));
//        Comment::find($comments->pluck('id')->toArray())->update(['spam_reports' => 1]);
        $idea2 = Idea::factory()->create([
            'title' => 'This is huy second time',
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);
        $idea2->comments()->saveMany($comments2 = Comment::factory(3)->make(['user_id' => $user->id]));
        Comment::whereIn('id', $comments2->merge($comments)->pluck('id')->toArray())->update(['spam_reports' => 1]);

        //Assert my_ideas
        Livewire::actingAs($user)->test(IdeasIndex::class)->set('filter', 'most_spam_comment')
            ->assertViewHas('ideas', function (LengthAwarePaginator $ideas) use($idea, $idea2) {
                $correctOrder = $ideas->first()->id === $idea->id && $ideas->last()->id === $idea2->id;
                return $ideas->count() === 2 && $ideas->contains('id', $idea->id)
                    && $ideas->contains('id', $idea2->id) && $correctOrder;
            });

        Comment::whereIn('id',$comments2->merge($comments)->pluck('id')->toArray())->update(['spam_reports' => 0]);
        Livewire::actingAs($user)->test(IdeasIndex::class)->set('filter', 'most_spam_comment')
            ->assertViewHas('ideas', function (LengthAwarePaginator $ideas) use($idea, $idea2) {
                return $ideas->count() === 0 && !$ideas->contains('id', $idea->id)
                    && !$ideas->contains('id', $idea2->id);
            });
    }

}
