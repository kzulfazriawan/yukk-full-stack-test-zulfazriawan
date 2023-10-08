<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateTransactionAndPaid(): void
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
        
        // Lists all the transactions
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->get('/api/v1/transactions');
        $response->assertStatus(200);

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

        // Check specified transaction by id
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->get('/api/v1/transactions/' . $transaction['id']);
        $response->assertStatus(200);
        $transaction = $response->decodeResponseJson();
        $this->assertEquals('open', $transaction['status']);

        // Update specified transaction status to paid
        $payload = [
            'status' => 'paid',
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->patch('/api/v1/transactions/' . $transaction['id'], $payload);
        $response->assertStatus(200);
        $transaction = $response->decodeResponseJson();

        // Check specified transaction by id
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->get('/api/v1/transactions/' . $transaction['id']);
        $response->assertStatus(200);
        $transaction = $response->decodeResponseJson();
        $this->assertEquals('paid', $transaction['status']);
    
        // Create a transaction failed amount > balance
        $payload = [
            'title'  => 'transaction.marketplace',
            'amount' => '5000000',
            'type'   => 'transaction',
            'service_id' => $services[0]['id']
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                            ->post('/api/v1/transactions', $payload);
        $this->assertNotEquals(200, $response->getStatusCode());

        // Update a not opened transaction or invalid id
        $payload = [
            'status' => 'paid',
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $login['token']])
                         ->patch('/api/v1/transactions/' . $transaction['id'], $payload);
        $this->assertNotEquals(200, $response->getStatusCode());
        }
}
