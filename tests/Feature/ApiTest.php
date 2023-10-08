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

    public function testTransactions(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Create token through login
        $payload = [
            'email'    => 'kzulfazriawan@example.com',
            'password' => 'your_password_here'
        ];

        $response = $this->post('/api/v1/login', $payload);
        $login    = $response->decodeResponseJson();
        $this->assertTrue($response->isOk());
        
        // Lists all the transactions
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$login['token']])->get('/api/v1/transactions');
        $this->assertTrue($response->isOk());

        // Lists all the services
        $response = $this->get('/api/v1/services');
        $services = $response->decodeResponseJson();
        $this->assertTrue($response->isOk());

        // Create a transaction
        $payload = [
            'title'  => 'topup.saldo',
            'amount' => '25000',
            'type'   => 'topup',
            'service_id' => $services[0]['id']
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer '.$login['token']])->post('/api/v1/transactions', $payload);
        $transaction = $response->decodeResponseJson();
        $this->assertTrue($response->isOk());

        // Show specified transaction
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$login['token']])->get('/api/v1/transactions/' . $transaction['id']);
        $transaction = $response->decodeResponseJson();
        $this->assertTrue($response->isOk());
        $this->assertTrue($transaction['status'] == 'open');

        // Update specified transaction status to paid
        $payload = [
            'status' => 'paid',
        ];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$login['token']])->patch('/api/v1/transactions/' . $transaction['id'], $payload);
        $transaction = $response->decodeResponseJson();
        $this->assertTrue($response->isOk());

        // Show specified transaction
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$login['token']])->get('/api/v1/transactions/' . $transaction['id']);
        $transaction = $response->decodeResponseJson();
        $this->assertTrue($response->isOk());
        $this->assertTrue($transaction['status'] == 'paid');

        // Update specified transaction status to paid again
        $payload = [
            'status' => 'paid',
        ];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$login['token']])->patch('/api/v1/transactions/' . $transaction['id'], $payload);
        $this->assertFalse($response->isOk());
    }
}
