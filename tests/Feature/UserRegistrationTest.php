<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRegistrationWithValidDataShouldSuccess()
    {
        $userData = [
            "name" => "navee",
            "email" => "navee@gmail.com",
            "password" => "User@1234",
            "status" => true
        ];

        $response = $this->postJson('/api/v2/create' , $userData);

        $response->assertStatus(201)
                 ->assertJson([
                    'message' => 'Registration successfully.',
        ]);
    }

    public function testUserRegistrationWithMissedFieldsShouldFail()
    {
        $userData = [];

        $response = $this->postJson('/api/v2/create' , $userData);

        $response->assertStatus(422)
                 ->assertJson([
                    "name"=> ["The name field is required."],
                    "email"=> ["The email field is required."],
                    "password"=> ["The password field is required."],
                    "status"=> ["The status field is required."]
        ]);
    }

    public function testUserRegistrationWithInvalidNameShouldFail()
    {
        $userData = [
            "name" => "ki",
            "email" => "king@gmail.com",
            "password" => "User@1234",
            "status" => true
        ];

        $response = $this->postJson('/api/v2/create' , $userData);

        $response->assertStatus(422)
                 ->assertJson([
                    "name" => ["The name field must be at least 3 characters."]
                 ]);
    }

    public function testUserRegistrationWithInvalidEmailShouldFail()
    {
        $userData = [
            "name" => "king",
            "email" => "kinggmail.com",
            "password" => "User@1234",
            "status" => true
        ];

        $response = $this->postJson('/api/v2/create' , $userData);

        $response->assertStatus(422)
                 ->assertJson([
                    "email" => ["The email field must be a valid email address."]
                 ]);
    }

    public function testUserRegistrationWithInvalidPasswordShouldFail()
    {
        $userData = [
            "name" => "king",
            "email" => "king@gmail.com",
            "password" => "User1234",
            "status" => true
        ];

        $response = $this->postJson('/api/v2/create' , $userData);

        $response->assertStatus(422)
                    ->assertJson([
                        "password" => ["The password field format is invalid."]
                    ]);
    }
}
