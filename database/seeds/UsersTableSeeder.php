<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::truncate();
        User::truncate();

        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $writerRole = Role::create(['name' => 'Writer', 'display_name' => 'Escritor']);

        $admin = new User;
        $admin->name = "Miguel Angel Cornielly";
        $admin->email = "mcornielly@gmail.com";
        $admin->password = '123123';
        $admin->save();

        $admin->assignRole($adminRole);

        $writer = new User;
        $writer->name = "Joshua Miguel Cornielly";
        $writer->email = "jcornielly15@gmail.com";
        $writer->password = '123123';
        $writer->save();

        $writer->assignRole($writerRole);

    }
}
