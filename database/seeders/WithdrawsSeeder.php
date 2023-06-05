<?php

namespace Database\Seeders;

use App\Models\WithdrawModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wd = [
            [
                'users_id' => 2,
                'amount' => 20000,
                'request_date' => Carbon::now(),
                'status' => 'approved'
            ],
        ];

        foreach ($wd as $data) {
            WithdrawModel::query()->insert($data);
        }
    }
}
