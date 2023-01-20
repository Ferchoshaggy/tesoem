<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\tabla_roles;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $usuario=['SuperAdministrador','Docente','Alumno'];

        for($i=0;$i<count($usuario);$i++){
                DB::table('tabla_roles')->insert([
                    'tipo' => $usuario[$i],

                ]);
        }

        DB::table('users')->insert([
            'name'  => 'SuperAdministrador',
            'tipo_user' => 1,
            'email'     => 'admin@gmail.com',
            'matricula' => '186010016',
            'password'  => bcrypt('123456789'),
        ]);


    }
}
