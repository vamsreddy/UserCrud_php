<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUserLoginWithValidDataShouldSuccess()
    {
        $userData = [
            "name" => "kings",
            "email" => "kings@gmail.com",
            "password" => "User@1234",
            "status" => true
        ];

        $response = $this->postJson('/api/v2/create' , $userData);

        $user = ['email' => 'kings@gmail.com', 'password' => 'User@1234'];
        $this->json('GET', '/api/v2/login', $user)
            ->assertStatus(200)
            ->assertJsonStructure([
                'token',
            ]);
    }

    public function testUserLoginWithInValidDataShouldFail()
    {
        $user = ['email' => 'ki@gmail.com', 'password' => 'User@1234'];
        $this->json('GET', '/api/v2/login', $user)
            ->assertStatus(401)
            ->assertJson([
                'error' => 'User is Unauthorized'
            ]);
    }

    public function testUserLoginWithValidDataShouldGetUserData()
    {
        $userData = [
            "name" => "kins",
            "email" => "kins@gmail.com",
            "password" => "User@1234",
            "status" => true
        ];

        $response = $this->postJson('/api/v2/create' , $userData);

        $user = ['email' => 'kins@gmail.com', 'password' => 'User@1234'];
        $this->json('GET', '/api/v2/login', $user);

        $response = $this->GetJson('/api/v2/show' , $user);

        $response->assertStatus(200)
                 ->assertJson([
                    'name' =>'kins',
                    'email'=>'kins@gmail.com',
                    'status'=> true,
                 ]);
    }

    public function testUserLoginWithValidDataShouldUpdateUserData()
    {
        $userData = [
            "name" => "virat",
            "email" => "virat@gmail.com",
            "password" => "User@1234",
            "status" => true
        ];

        $response = $this->postJson('/api/v2/create' , $userData);

        $user = ['email' => 'virat@gmail.com', 'password' => 'User@1234'];
        $this->json('GET', '/api/v2/login', $user);

        $updatedUserData = [
            "name" => "updated_naveens",
            "status" => false
        ];

        $response = $this->PUTJson('/api/v2/update' , $updatedUserData);

        $response->assertStatus(200)
                 ->assertJson([
                    'message' => 'User updated successfully.'
                 ]);
    }

    public function testUserLoginWithValidDataShouldDeleteUserData()
    {
        $userData = [
            "name" => "vamshi",
            "email" => "vamshi@gmail.com",
            "password" => "User@1234",
            "status" => true
        ];

        $response = $this->postJson('/api/v2/create' , $userData);

        $user = ['email' => 'vamshi@gmail.com', 'password' => 'User@1234'];
        $this->json('GET', '/api/v2/login', $user);

        $response = $this->DELETEJson('/api/v2/delete');

        $response->assertStatus(200)
                 ->assertJson([
                    'message' => 'User deleted successfully.'
                 ]);
    }

    public function testUserLogoutWithValidDataShouldSuccess()
    {
        $userData = [
            "name" => "nanaji",
            "email" => "nanaji@gmail.com",
            "password" => "User@1234",
            "status" => true
        ];

        $response = $this->postJson('/api/v2/create' , $userData);

        $user = ['email' => 'nanaji@gmail.com', 'password' => 'User@1234'];
        $this->json('GET', '/api/v2/login', $user);

        // $userData = [
        //     "email" => 'naveens@gmail.com',
        //     "password" => "User@1234"
        // ];

        $response = $this->POSTJson('/api/v2/logout' , $userData);

        $response->assertStatus(200)
                 ->assertJson([
                    'message' => 'User logged out successfully'
                 ]);
    }
}
