<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateIdeaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_idea_form_doesnot_show_when_logout()
    {
//        $this->actingAs(User::factory()->create());
        $response = $this->get('/');
        $response->assertDontSee('<input wire:model.debounce.500ms="title" placeholder="Your idea" class=" w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" type="text" name="" id="">', false);
        $response->assertSee(' Please login to add idea');
        $response->assertDontSee('Let us know what you would like and we will tak a look over!');
        $response->assertStatus(200);
    }

    public function test_create_idea_form_show_when_login()
    {
        $response = $this->actingAs(User::factory()->create())->get('/');
        $response->assertSee('<input wire:model.debounce.500ms="title" placeholder="Your idea" class=" w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" type="text" name="" id="">', false);
        $response->assertDontSee(' Please login to add idea');
        $response->assertSee('Let us know what you would like and we will tak a look over!');
        $response->assertStatus(200);
    }
}
