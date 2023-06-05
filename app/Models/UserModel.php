<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends BaseModel
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'tipe_user',
    ];

    public static function allUser(){
        return self::query()->where('tipe_user', 'user')->get();
    }
}
