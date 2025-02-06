<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'tbl_users';

    protected $fillable = [
        'name',
        'username',
        'password',
        'role'
    ];
}
