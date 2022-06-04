<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_generate_gravatar_default_image_when_no_email_found()
    {
        $this->withoutExceptionHandling();
       $user = User::factory()->create([
           'email' => 'hellohuy@fale.com'
       ]);
        $this->assertNotNull($user->avatar());

    }
}
