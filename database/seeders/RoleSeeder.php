<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('roles')->insert([
            'name' => 'Administrador',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('roles')->insert([
            'name' => 'Empleado',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('roles')->insert([
            'name' => 'Inspector',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
