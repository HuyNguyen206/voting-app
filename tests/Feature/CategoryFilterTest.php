<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryFilterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_selecting_a_category_filter_correctly()
    {
        $category = Category::factory()->create(['name' => 'PHP']);
        $category2 = Category::factory()->create();
        $category3 = Category::factory()->create();
        $category4 = Category::factory()->create();
        Idea::factory(10)->create([
            'category_id' => $category->id
        ]);
        Idea::factory(10)->create([
            'category_id' => $category2->id
        ]);
        Idea::factory(10)->create([
            'category_id' => $category3->id
        ]);
        Idea::factory(10)->create([
            'category_id' => $category4->id
        ]);

        Livewire::test(IdeasIndex::class)->set('category', $category->slug)->assertViewHas('ideas', function ($ideas) use($category) {
            return $ideas->count() == 10 && $ideas->random()->category_id == $category->id;
        });
        $this->get(route('ideas.index', ['category' => $category->slug]))
            ->assertSee('<span class="text-gray-400">'.$category->name.'</span>', false)
            ->assertDontSee('<span class="text-gray-400">'.$category2->name.'</span>', false)
            ->assertDontSee('<span class="text-gray-400">'.$category3->name.'</span>', false)
            ->assertDontSee('<span class="text-gray-400">'.$category4->name.'</span>', false);

    }
}
