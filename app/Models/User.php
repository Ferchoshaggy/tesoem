<?php

namespace App\Models;
use App\Models\tabla_roles;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'matricula',
        'foto',
        'tipo_user',
        'm_tesoem',
        'carrera_tesoem',
        'id_proceso_activo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //esta es para la imagen
    public function adminlte_image(){

        if($this->foto==null){
            return "https://picsum.photos/300/300";
        }else{
            return asset("fotos_users\\".$this->foto);
        }

    }

    public function role(){
        return $this->belongsTo(tabla_roles::class,'tipo_user');
    }


    public function adminlte_desc(){

        //odtenemos el dato de la tabla de ese usuario, para saber que tipo de usuario es
        return $this->role->tipo;

    }

    public function adminlte_profile_url(){
        return '/User_config';
    }
}
