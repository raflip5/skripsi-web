<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'nis' => '9221',
                'name' => 'ADITYA EKA SAPUTRA',
                'jenis_kelamin' => 'L',
                'kelas' => 'X 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nis' => '9222',
                'name' => 'AFIFAH LUTHFIYA ZAHRA',
                'jenis_kelamin' => 'P',
                'kelas' => 'X 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nis' => '9223',
                'name' => 'ALDO AINUR ROHMAN',
                'jenis_kelamin' => 'L',
                'kelas' => 'X 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nis' => '9224',
                'name' => 'ANISA WULANDARI',
                'jenis_kelamin' => 'P',
                'kelas' => 'X 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nis' => '9225',
                'name' => 'AULIA DZAKIRA',
                'jenis_kelamin' => 'P',
                'kelas' => 'X 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('tbl_students')->insert($students);
    }
}
