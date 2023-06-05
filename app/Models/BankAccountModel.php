<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccountModel extends BaseModel {
    use HasFactory;

    protected $table = 'bank_account';

    public static function withBalanceByUserId($userId) {
        \DB::statement("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

        $sql = "SELECT
                    u1.id as users_id,
                    u1.nama,
                    b1.id as bank_account_id,
                    b1.account_name,
                    b1.account_number,
                    b1.bank_name,
                    MAX_BALANCE.balance
                FROM
                    users u1
                    LEFT JOIN bank_account b1 ON u1.id = b1.users_id
                    LEFT JOIN ( SELECT MAX( ID ) AS ID, balance, users_id FROM users_balance GROUP BY users_id ) AS MAX_BALANCE ON u1.id = MAX_BALANCE.users_id
                WHERE
                    u1.id = '$userId'";
        $query = \DB::select($sql);
        if (count($query)) {
            return $query[0];
        }

        return [];
    }
}
