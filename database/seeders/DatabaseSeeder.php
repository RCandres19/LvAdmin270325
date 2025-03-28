<?php   //SOLO PARA PRUEBAS, NO USAR EN PRODUCCIÓN

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Usuario;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Limpiar caché de permisos (opcional, para evitar problemas)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissions = [
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'ver usuarios',
            'crear boletines',
            'editar boletines',
            'eliminar boletines',
            'ver boletines',
            'crear infomacion',
            'editar infomacion',
            'eliminar infomacion',
            'ver infomacion'
        ];

        foreach ($permissions as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $usuarioRole = Role::firstOrCreate(['name' => 'usuario']);

        // Asignar permisos al rol de admin
        $adminRole->syncPermissions($permissions);

        // Crear usuario administrador
        $admin = Usuario::firstOrCreate([
            'documento' => '12345678',
            'nombre' => 'Admin',
            'apellido' => 'nistrador',
            'tipo_documento' => 'CC',
            'telefono' => '1234567890',
            'correo' => 'admin@example.com',
            'contraseña' => password_hash('contraseña', PASSWORD_DEFAULT),
        ]);

        // Asignar el rol de admin al usuario
        $admin->assignRole($adminRole);
    }
}
