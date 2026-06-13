<?php
 
namespace Database\Seeders;
 
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
 
class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar la caché de permisos antes de sembrar
        app(PermissionRegistrar::class)->forgetCachedPermissions();
 
        // 1) Permisos
        $permisos = [
            'ver-usuarios', 'crear-usuarios', 'editar-usuarios',
            'eliminar-usuarios', 'gestionar-roles',
            'ver-notas', 'crear-notas', 'editar-notas',
            'eliminar-notas', 'ver-todas-las-notas',
        ];
 
        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }
 
        // 2) Roles con sus permisos
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());
 
        $docente = Role::firstOrCreate(['name' => 'docente']);
        $docente->syncPermissions([
            'ver-usuarios',
            'ver-notas', 'crear-notas', 'editar-notas',
            'eliminar-notas', 'ver-todas-las-notas',
        ]);
 
        $estudiante = Role::firstOrCreate(['name' => 'estudiante']);
        $estudiante->syncPermissions([
            'ver-notas', 'crear-notas', 'editar-notas', 'eliminar-notas',
        ]);
 
        // 3) Usuarios
        $usuario = User::firstOrCreate(
            ['email' => 'admin@uatf.edu.bo'],
            ['name' => 'Administrador', 'password' => Hash::make('password')]
        );
        $usuario->assignRole('admin');
 
        $usuario = User::firstOrCreate(
            ['email' => 'huascar@uatf.edu.bo'],
            ['name' => 'Huascar Gonzales', 'password' => Hash::make('password')]
        );
        $usuario->assignRole('docente');
 
        $usuario = User::firstOrCreate(
            ['email' => 'juan@uatf.edu.bo'],
            ['name' => 'Juan Flores', 'password' => Hash::make('password')]
        );
        $usuario->assignRole('estudiante');
    }
}
