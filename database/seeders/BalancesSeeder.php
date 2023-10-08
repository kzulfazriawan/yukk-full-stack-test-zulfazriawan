<?php

namespace Database\Seeders;

use App\Models\Balances;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = 0;

        $user         = User::where('email', 'kzulfazriawan@example.com')->first()->id;
        $transactions = Transactions::where('user_id', $user)->where('status', 'paid')->get();

        foreach($transactions as $item){
            $amount = ($item->is_income) ? $amount + $item->amount : $amount - $item->amount;
        }

        Balances::create([
            'user_id' => $user,
            'amount'  => $amount
        ]);
        
    }
}
