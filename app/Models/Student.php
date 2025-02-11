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

    public function getNisAttribute($value)
    {
        // Remove BOM (Byte Order Mark) and trim the value
        return trim(preg_replace('/\xEF\xBB\xBF/', '', $value));
    }

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class, 'student_nis', 'nis');
    }
}
