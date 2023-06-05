<?php

namespace Database\Seeders;

use App\Models\UserBalanceModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'users_id' => 2,
                'kredit' => 0,
                'debit' => 100000,
                'balance' => 100000,
                'keterangan' => 'Deposit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($users as $user_data) {
            UserBalanceModel::query()->insert($user_data);
        }
    }
}
