<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Training extends Model
{
    protected $table = 'tbl_trainings';

    protected $fillable = [
        'student_nis',
        'umur',
        'insiden',
        'lokasi',
        'frekuensi',
        'insiden_kejadian',
        'pelaku',
        'jenis_kelamin_pelaku',
        'dampak',
        'hasil'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_nis', 'nis');
    }
}
