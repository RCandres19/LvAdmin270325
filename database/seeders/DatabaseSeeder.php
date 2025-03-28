<?php   //SOLO PARA PRUEBAS, NO USAR EN PRODUCCIÓN

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
            'crear usuarios', 'editar usuarios', 'eliminar usuarios', 'ver usuarios',

            'crear boletines', 'editar boletines', 'eliminar boletines', 'ver boletines',

            'crear infomacion', 'editar infomacion', 'eliminar infomacion', 'ver infomacion'
        ];

        foreach ($permissions as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $usuarioRole = Role::firstOrCreate(['name' => 'usuario']);

        // Asignar permisos al rol de admin
        $adminRole->syncPermissions($permissions);

        // Crear o actualizar usuario administrador
        $admin = Usuario::updateOrCreate(
            ['documento' => '12345678'], // ✔️ Buscar usuario con este documento
            [
                'nombre' => 'Admin',
                'apellido' => 'nistrador',
                'tipo_documento' => 'CC',
                'telefono' => '1234567890',
                'correo' => 'admin@example.com',
                'password' => bcrypt('contraseña'), // ✔️ Usa bcrypt()
            ]
        );
        $admin->assignRole($adminRole); // ✔️ Asignar rol directamente

        // Crear o actualizar usuario normal
        $usuario = Usuario::updateOrCreate(
            ['documento' => '87654321'], // ✔️ Buscar usuario con este documento
            [
                'nombre' => 'Usuario',
                'apellido' => 'Normal',
                'tipo_documento' => 'CC',
                'telefono' => '0987654321',
                'correo' => 'usuario@example.com',
                'password' => bcrypt('contraseña'), // ✔️ Usa bcrypt()
            ]
        );
        $usuario->assignRole($usuarioRole); // ✔️ Asignar rol directamente
    }
}
