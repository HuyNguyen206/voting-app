<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_generate_gravatar_default_image_when_no_email_found()
    {
       $user = User::factory()->create([
           'emaii' => 'hellohuy@fale.com'
       ]);


    }
}
