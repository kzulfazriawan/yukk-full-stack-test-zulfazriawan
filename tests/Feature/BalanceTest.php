<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BalanceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testBalanceAmountIncrease(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Create token through login
        $payload = [
            'email'    => 'kzulfazriawan@example.com',
            'password' => 'your_password_here'
        ];

        $response = $this->post('/api/v1/login', $payload);
        $response->assertStatus(200);
        $login = $response->decodeResponseJson();
        
        // Show balance amount
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->get('/api/v1/user/balance');
        $response->assertStatus(200);
        $balance = $response->decodeResponseJson();
        $this->assertEquals(660000, $balance['amount']);

        // Lists all the services
        $response = $this->get('/api/v1/services');
        $response->assertStatus(200);
        $services = $response->decodeResponseJson();

        // Create a transaction
        $payload = [
            'title'  => 'topup.saldo',
            'amount' => '25000',
            'type'   => 'topup',
            'service_id' => $services[0]['id']
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->post('/api/v1/transactions', $payload);
        $response->assertStatus(200);
        $transaction = $response->decodeResponseJson();

        // Update specified transaction status to paid
        $payload = [
            'status' => 'paid',
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->patch('/api/v1/transactions/' . $transaction['id'], $payload);
        $response->assertStatus(200);

        // Show balance amount
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->get('/api/v1/user/balance');
        $response->assertStatus(200);
        $balance = $response->decodeResponseJson();
        $this->assertEquals(685000, $balance['amount']);
    }

        /**
     * A basic feature test example.
     */
    public function testBalanceAmountDecrease(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Create token through login
        $payload = [
            'email'    => 'kzulfazriawan@example.com',
            'password' => 'your_password_here'
        ];

        $response = $this->post('/api/v1/login', $payload);
        $response->assertStatus(200);
        $login = $response->decodeResponseJson();
        
        // Show balance amount
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->get('/api/v1/user/balance');
        $response->assertStatus(200);
        $balance = $response->decodeResponseJson();
        $this->assertEquals(660000, $balance['amount']);

        // Lists all the services
        $response = $this->get('/api/v1/services');
        $response->assertStatus(200);
        $services = $response->decodeResponseJson();

        // Create a transaction
        $payload = [
            'title'  => 'transaction.marketplace',
            'amount' => '250000',
            'type'   => 'transaction',
            'service_id' => $services[0]['id']
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->post('/api/v1/transactions', $payload);
        $response->assertStatus(200);
        $transaction = $response->decodeResponseJson();

        // Update specified transaction status to paid
        $payload = [
            'status' => 'paid',
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->patch('/api/v1/transactions/' . $transaction['id'], $payload);
        $response->assertStatus(200);

        // Show balance amount
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->get('/api/v1/user/balance');
        $response->assertStatus(200);
        $balance = $response->decodeResponseJson();
        $this->assertEquals(410000, $balance['amount']);
    }
}
