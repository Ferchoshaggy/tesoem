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

        DB::table("datos_pdf")->insert([
            "id_carrera" => 1,
            "j_division" => "ING. CIRILO MARTINEZ LIGA",
            "sexo_j_division" => 2,
            "p_academia" => "JOSÉ PABLO IBARRA",
            "sexo_p_academia" => 2,
            "s_academia" => "ALMA ALEJANDRA AGILAR RODRÍGUEZ",
            "sexo_s_academia" => 1,
            "j_control_escolar" => "LIC. IVONNE ADRIANA CARLILLO FLORES",
            "sexo_j_control_escolar" => 1,
            "texto_superior" => "2023. AÑO DEL QUINCENTENARIO DE LA FUNDACIÓN DE TOLUCA DE LERDO, CAPITAL DEL ESTADO DE MÉXICO",
            "fecha" => date("Y-m-d")
        ]);

        DB::table('users')->insert([
            'name'  => 'ProgramadorSupremo',
            'tipo_user' => 1,
            'email'     => 'admin@gmail.com',
            'matricula' => '186010016',
            'carrera_tesoem' => 1,
            'password'  => bcrypt('123456789'),
        ]);

    }
}
