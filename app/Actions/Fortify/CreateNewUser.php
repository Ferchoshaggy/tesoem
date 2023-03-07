<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use File;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        //echo $input['foto'];
        //echo "<br>".$input['foto']->getClientOriginalExtension();
        //echo $_FILES['foto']['tmp_name'];
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'matricula' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $foto=null;
        if (isset($input['foto'])) {

            if ($input['foto']->getClientOriginalExtension()=="png" || $input['foto']->getClientOriginalExtension()=="jpg" || $input['foto']->getClientOriginalExtension()=="ico" || $input['foto']->getClientOriginalExtension()=="gif") {
                //guardamos la nueva
                $foto = rand(11111,99999).'foto_user'.$input['matricula'].".".$input['foto']->getClientOriginalExtension();
                $destinationPath = public_path().'/fotos_users';
                $file_save = $input['foto'];
                $file_save->move($destinationPath,$foto);
            }

        }

        if(isset($input['m_tesoem'])){
            $mat_tesoem=1;
        }else{
            $mat_tesoem=null;
        }
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'matricula' => $input['matricula'],
            'foto' => $foto,
            'tipo_user'=>3,
            'm_tesoem' => $mat_tesoem,
            'carrera_tesoem' => $input['carrera_tesoem'],
        ]);
    }
}
