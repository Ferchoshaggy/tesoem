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

        date_default_timezone_set('America/Mexico_City');

        DB::table('instituciones')->insert([
            'nombre'  => 'TECNOLOGICO DE ESTUDIOS SUPERIORES DEL ORIENTE DEL ESTADO DE MÉXICO',
            'fecha' => date("Y-m-d"),
        ]);

        DB::table('carreras')->insert([
            'nombre'=> 'INGENIERIA EN SISTEMAS COMPUTACIONES',
            'id_institucion' => 1,
            'fecha' => date("Y-m-d"),
            'clave' => "jdjkd2333",
        ]);

        for($i=1;$i<6;$i++){

                DB::table('materias')->insert([
                    "id_institucion" => 1,
                    "id_carrera" => 1,
                    "semestre" => $i,
                    "nombre" => "materia".$i,
                    "matricula" => "mat".$i,
                    "temario" => "url",
                    "fecha" => date("Y-m-d"),
                ]);
        }

        DB::table('users')->insert([
            'name'  => 'SuperAdministrador',
            'tipo_user' => 1,
            'email'     => 'admin@gmail.com',
            'matricula' => '186010016',
            'carrera_tesoem' => 1,
            'password'  => bcrypt('123456789'),
        ]);

    }
}
