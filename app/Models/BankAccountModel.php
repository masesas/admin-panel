<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccountModel extends BaseModel {
    use HasFactory;

    protected $table = 'bank_account';
}
