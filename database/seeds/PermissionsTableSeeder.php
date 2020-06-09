<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        $viewPostsPermission = Permission::create(['name' => 'view posts','display_name' => 'Ver Publicaciones']);
        $createPostsPermission = Permission::create(['name' => 'create posts', 'display_name' => 'Crear Publicaciones']);
        $updatePostsPermission = Permission::create(['name' => 'update posts', 'display_name' => 'Actualizar Publicaciones']);
        $deletePostsPermission = Permission::create(['name' => 'delete posts', 'display_name' => 'Eliminar Publicaciones']);
         
        $viewUsersPermission = Permission::create(['name' => 'view users', 'display_name' => 'Ver Usuarios']);
        $createUsersPermission = Permission::create(['name' => 'create users','display_name' => 'Crear Usuario']);
        $updateUsersPermission = Permission::create(['name' => 'update users', 'display_name' => 'Actualizar Usuario']);
        $deleteUsersPermission = Permission::create(['name' => 'delete users', 'display_name' => 'Eliminar Usuario']);
        
        $viewRolesPermission = Permission::create(['name' => 'view roles', 'display_name' => 'Ver Permisos']);
        $createRolesPermission = Permission::create(['name' => 'create roles', 'display_name' => 'Crear Permiso']);
        $updateRolesPermission = Permission::create(['name' => 'update roles', 'display_name' => 'Actualizar Permiso']);
        $deleteRolesPermission = Permission::create(['name' => 'delete roles','display_name' => 'Eliminar Permiso']);

        $viewPermissionsPermission = Permission::create(['name' => 'view permissions', 'display_name' => 'Ver Permisos']);
        $updatePermissionsPermission = Permission::create(['name' => 'update permissions', 'display_name' => 'Actualizar Permisos']);

    }
}
