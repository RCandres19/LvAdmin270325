<?php   // PARA DATOS DE PRUEBA 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Insertar roles
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'usuario'],
        ]);

        // Insertar usuario admin
        DB::table('usuarios')->insert([
            'nombre' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
            'role_id' => 1,
        ]);
    }
}
