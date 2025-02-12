<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $table = 'tbl_students';

    protected $fillable = [
        'nis',
        'name',
        'jenis_kelamin',
        'kelas'
    ];

    protected $casts = [
        'nis' => 'integer'
    ];

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class, 'student_nis', 'nis');
    }
}
