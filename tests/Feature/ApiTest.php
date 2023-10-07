<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testApiServices(): void
    {
        $response = $this->call('GET', '/api/v1/services/');
        $this->assertTrue($response->isOk());
    }

    public function testAuthCreateToken(): void
    {
        $payload = [
            'email'    => 'kzulfazriawan@example.com',
            'password' => 'your_password_here'
        ];

        $response = $this->call('POST', '/api/v1/login', $payload);
        $this->assertTrue($response->isOk());
    }
}
