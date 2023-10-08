<?php

namespace Database\Seeders;

use App\Models\Services;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'kzulfazriawan@example.com')->first()->id;
        $transactions = [
            [
                'user_id'   => $user,
                'title'     => 'topup.saldo',
                'amount'    => 1000000,
                'is_income' => 1,
                'remarks'   => '',
                'service_id'=> Services::where('name', 'BCA VA')->first()->id,
                'status'    => 'paid'
            ], [
                'user_id'   => $user,
                'title'     => 'transactions',
                'amount'    => 150000,
                'is_income' => 0,
                'remarks'   => '',
                'service_id'=> Services::where('name', 'GOPAY')->first()->id,
                'status'    => 'paid'
            ], [
                'user_id'   => $user,
                'title'     => 'transactions',
                'amount'    => 220000,
                'is_income' => 0,
                'remarks'   => '',
                'service_id'=> Services::where('name', 'DANA')->first()->id,
                'status'    => 'paid'
            ], [
                'user_id'   => $user,
                'title'     => 'transactions',
                'amount'    => 95000,
                'is_income' => 0,
                'remarks'   => '',
                'service_id'=> Services::where('name', 'BCA VA')->first()->id,
                'status'    => 'paid'
            ], [
                'user_id'   => $user,
                'title'     => 'topup.saldo',
                'amount'    => 125000,
                'is_income' => 1,
                'remarks'   => '',
                'service_id'=> Services::where('name', 'BCA VA')->first()->id,
                'status'    => 'paid'
            ]
        ];

        foreach($transactions as $items){
            Transactions::create($items);
        }
    }
}
