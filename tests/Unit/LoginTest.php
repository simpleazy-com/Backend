<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function logging_in_user_into_app(){
        $user = [
            'email' => $this->user->email,
            'password' => 'secret'
        ];

        $response = $this->postJson('/login', $user);

        $response->assertStatus(200)->assertJson([
            'user' => [
                'email' => $this->user->email,
                'name' => $this->user->name,
                'image' => $this->user->image
            ]
        ]);

        $response->assertTrue(true);

    }
}
