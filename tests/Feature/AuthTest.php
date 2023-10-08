<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testGenerateToken(): void
    {
        $this->seed(DatabaseSeeder::class);

        $payload = [
            'email'    => 'kzulfazriawan@example.com',
            'password' => 'your_password_here'
        ];

        $response = $this->post('/api/v1/login', $payload);
        $response->assertStatus(200);

        $payload = [
            'email'    => 'kzulfazriawan@example.com',
            'password' => 'your_password_her2'
        ];

        $response = $this->post('/api/v1/login', $payload);
        $this->assertNotEquals(200, $response->getStatusCode());    
    }

    public function testCreateNewUser(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Non-existing user payload
        $payload = [
            'name'     => 'John doe',
            'email'    => 'john.doe@example.com',
            'password' => 'your_password_here',
            'password_confirmation' => 'your_password_here'
        ];

        $response = $this->post('/api/v1/register', $payload);
        $register = $response->decodeResponseJson();
        $response->assertStatus(200);
        $this->assertEquals($payload['email'], $register['email']);

        // Existing user payload
        $payload = [
            'name'     => 'Kzulfazriawan',
            'email'    => 'kzulfazriawan@example.com',
            'password' => 'your_password_here',
            'password_confirmation' => 'your_password_here'
        ];
        $response = $this->post('/api/v1/register', $payload);
        $this->assertNotEquals(200, $response->getStatusCode());

        // Failed confirm password
        $payload = [
            'name'     => 'Jane doe',
            'email'    => 'jane.doe@example.com',
            'password' => 'your_password_her',
            'password_confirmation' => 'your_password_here'
        ];
        $response = $this->post('/api/v1/register', $payload);
        $this->assertNotEquals(200, $response->getStatusCode());
    }

    public function testVerifyUser(){
        $this->seed(DatabaseSeeder::class);

        // Non-existing user payload
        $payload = [
            'name'     => 'John doe',
            'email'    => 'john.doe@example.com',
            'password' => 'your_password_here',
            'password_confirmation' => 'your_password_here'
        ];

        $response = $this->post('/api/v1/register', $payload);
        $register = $response->decodeResponseJson();
        $response->assertStatus(200);
        $this->assertEquals($payload['email'], $register['email']);

        // Verify user data
        $payload = [
            'email' => $register['email'],
            'token' => $register['verify']
        ];

        $response = $this->post('/api/v1/verification', $payload);
        $response->assertStatus(200);
        
        // Verify user data token invalid or user is confirmed
        $payload = [
            'email' => $register['email'],
            'token' => $register['verify']
        ];

        $response = $this->post('/api/v1/verification', $payload);
        $this->assertNotEquals(200, $response->getStatusCode());
    }
}
