<?php   //SOLO PARA PRUEBAS, NO USAR EN PRODUCCIÓN

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Limpiar caché de permisos (opcional, para evitar problemas)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //  Desactivar restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //  Eliminar datos en el orden correcto
        DB::table('model_has_roles')->delete(); // Primero elimina la relación
        Role::truncate();
        Permission::truncate();

        //  Reactivar restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Permisos CRUD para administrar usuarios, boletines e información
        // Puedes agregar más permisos según sea necesario

        
        $permisosAdmin = [
            'crear usuarios', 'editar usuarios', 'eliminar usuarios', 'ver usuarios',

            'crear boletines', 'editar boletines', 'eliminar boletines', 'ver boletines',

            'crear infomacion', 'editar infomacion', 'eliminar infomacion', 'ver infomacion'
        ];

        $permisosUsuario = [
            'ver boletines',
            'ver informacion'
        ];

        foreach (array_merge($permisosAdmin, $permisosUsuario) as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $usuarioRole = Role::firstOrCreate(['name' => 'usuario', 'guard_name' => 'web']);


        // Asignar permisos
        $adminRole->syncPermissions($permisosAdmin);
        $usuarioRole->syncPermissions($permisosUsuario);


        // Crear usuario administrador
        $admin = Usuario::firstOrCreate(  // Crear o actualizar usuario administrador
            ['documento' => '12345678'],
            [
                'correo' => 'admin@example.com',
                'nombre' => 'Admin',
                'apellido' => 'nistrador',
                'tipo_documento' => 'CC',
                'telefono' => '1234567890',
                'password' => bcrypt('password'), //usa bcrypt para encriptar la contraseña
            ]
        );
        $admin->assignRole($adminRole); //  Asignar rol directamente

        // Crear usuario normal
        $usuario = Usuario::firstOrCreate( // Crear o actualizar usuario normal
            ['documento' => '87654321'],
            [
                'correo' => 'usuario@example.com',
                'nombre' => 'Usuario',
                'apellido' => 'Normal',
                'tipo_documento' => 'CC',
                'telefono' => '0987654321',
                'password' => bcrypt('password'), //usa bcrypt para encriptar la contraseña
            ]
        );
        $usuario->assignRole($usuarioRole); // Asignar rol directamente
    }
}
