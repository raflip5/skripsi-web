<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingSeed extends Seeder
{
    public function run(): void
    {
        $trainings = [
            [
                'student_nis' => 9221,
                'umur' => 15,
                'insiden' => 'BV',
                'lokasi' => 'kelas',
                'frekuensi' => 'jarang',
                'insiden_kejadian' => 'Langsung',
                'pelaku' => 'Senior',
                'jenis_kelamin_pelaku' => 'Laki-Laki',
                'dampak' => 'rendah',
                'hasil' => 'Bullying Verbal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student_nis' => 9221,
                'umur' => 15,
                'insiden' => 'BF',
                'lokasi' => 'kelas',
                'frekuensi' => 'jarang',
                'insiden_kejadian' => 'Langsung',
                'pelaku' => 'Senior',
                'jenis_kelamin_pelaku' => 'Laki-Laki',
                'dampak' => 'tinggi',
                'hasil' => 'Bullying Fisik',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table('tbl_trainings')->insert($trainings);
    }
}
