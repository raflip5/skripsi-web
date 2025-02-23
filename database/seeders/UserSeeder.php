<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disini klo mau ganti username password awalan, atau nambah user karna gada regis sama gada menu tambah user
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Guru BK',
                'username' => 'user_bk',
                'password' => Hash::make('user_bk'),
                'role' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('tbl_users')->insert($users);
    }
}
