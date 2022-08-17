<?php

namespace Tests\Feature\Comments;

use App\Http\Livewire\IdeaComment;
use App\Http\Livewire\IdeaComments;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowCommentsTest extends TestCase {

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_comments_livewire_component_renders()
    {
        $idea = Idea::factory()->create();
        $comments = Comment::factory(50)->create([
            'idea_id' => $idea->id
        ]);
        $this->get(route('ideas.show', $idea->slug))
            ->assertSeeText($comments->first()->body)
            ->assertSeeLivewire(IdeaComments::class);
    }

    public function test_comment_livewire_component_renders()
    {
        $idea = Idea::factory()->create();
        $comments = Comment::factory(50)->create([
            'idea_id' => $idea->id
        ]);
        $this->get(route('ideas.show', $idea->slug))
            ->assertSeeLivewire(IdeaComment::class);
    }

    public function test_no_comment_show_suitable_message()
    {
        $idea = Idea::factory()->create();
        $this->get(route('ideas.show', $idea->slug))
            ->assertSee('No comment found');
    }

    public function test_list_of_comment_show_on_idea_page()
    {
        $idea = Idea::factory()->create();
        $comments = Comment::factory(5)->create([
            'idea_id' => $idea->id
        ]);
        $resonpse = $this->get(route('ideas.show', $idea->slug));
        foreach ($comments as $comment) {
            $resonpse->assertSee($comment->body);
        }
        $resonpse->assertSee('5 comments');
    }

    public function test_comments_count_show_correctly_on_index_page()
    {
        $idea = Idea::factory()->create();
        $comments = Comment::factory(5)->create([
            'idea_id' => $idea->id
        ]);

        $idea2= Idea::factory()->create();
        $comments = Comment::factory(4)->create([
            'idea_id' => $idea2->id
        ]);
        $resonpse = $this->get(route('ideas.index'));
        $resonpse->assertSee('5 comments');
        $resonpse->assertSee('4 comments');
    }

    public function test_op_badge_show_if_author_of_idea_comment_on_idea()
    {
        $idea = Idea::factory()->create(['user_id' => $user = User::factory()->create()]);
        $comments = Comment::factory(5)->create([
            'idea_id' => $idea->id,
            'user_id' => $user
        ]);

        $resonpse = $this->get(route('ideas.show', $idea->slug));
        $resonpse->assertSee('OP');
    }

    public function test_list_of_comments_pagination_work()
    {
        $idea = Idea::factory()->create();
        $idea->comments()->saveMany(Comment::factory(21)->make());
        $comments = Comment::all();
        $commentOne = $comments->first();
        $comment21 = $comments->last();
//
        $pageOne = $this->get(route('ideas.show', $idea->slug));
        $pageOne->assertSee($commentOne->body);
        $pageOne->assertDontSee($comment21->body);

        $pageTwo = $this->get(route('ideas.show', [$idea->slug, 'page' => 2]));
        $pageTwo->assertSee($comment21->body);
        $pageTwo->assertDontSee($commentOne->body);
    }
}
