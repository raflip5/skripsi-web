<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'tbl_students';

    protected $fillable = [
        'nis',
        'name',
        'jenis_kelamin',
        'kelas'
    ];
}
