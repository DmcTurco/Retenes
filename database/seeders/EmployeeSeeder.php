<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            'name' => 'Administrador',
            'email' => 'adminsitrador@vipusa.com',
            'password' => Hash::make('0000'),
            'doc_type' => 1,
            'status' => 1,
            'role_id' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('employees')->insert([
            'name' => 'Empleado',
            'email' => 'empleado@vipusa.com',
            'password' => Hash::make('0000'),
            'doc_type' => 1,
            'status' => 1,
            'role_id' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
