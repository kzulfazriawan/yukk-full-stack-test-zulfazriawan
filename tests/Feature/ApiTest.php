<?php

namespace Tests\Unit;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->assertTrue(true);
    }

    public function testApiServices(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->call('GET', '/api/v1/services/');
        $this->assertTrue($response->isOk());
    }

    public function testAuthCreateToken(): void
    {
        $this->seed(DatabaseSeeder::class);

        $payload = [
            'email'    => 'kzulfazriawan@example.com',
            'password' => 'your_password_here'
        ];

        $response = $this->call('POST', '/api/v1/login', $payload);
        $this->assertTrue($response->isOk());
    }

    public function testRegisterNewUser(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Non-existing user payload
        $payload = [
            'name'     => 'John doe',
            'email'    => 'john.doe@example.com',
            'password' => 'your_password_here',
            'password_confirmation' => 'your_password_here'
        ];

        $response = $this->call('POST', '/api/v1/register', $payload);
        $user     = $response->decodeResponseJson();
        $this->assertTrue($response->isOk());

        // Existing user payload
        $payload = [
            'name'     => 'Kzulfazriawan',
            'email'    => 'kzulfazriawna@example.com',
            'password' => 'your_password_here',
            'password_confirmation' => 'your_password_her'
        ];

        $response = $this->call('POST', '/api/v1/register', $payload);
        $this->assertFalse($response->isOk());

        // Verify user data
        $payload = [
            'email' => $user['email'],
            'token' => $user['verify']
        ];

        $response = $this->call('POST', '/api/v1/verification', $payload);
        $this->assertTrue($response->isOk());

    }
}
