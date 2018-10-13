<?php

namespace App;

use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';

    const USUARIO_ADMINISTRADOR = 'true';
    const USUARIO_REGULAR = 'false';

    public $transformer = UserTransformer::class;

    protected $table = 'users';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token',
    ];

    public function setNameAttribute($valor)    //mutador
    {
        $this->attributes['name'] = strtolower($valor);
    }

    public function setEmailAttribute($valor)   //mutador
    {
        $this->attributes['email'] = strtolower($valor);
    }

    public function getNameAttribute($valor)    //accesor
    {
        return ucwords($valor);
    }

    public function esVerificado()
    {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    public function esAdministrador()
    {
        return $this->admin == User::USUARIO_ADMINISTRADOR;
    }

    public static function generarVerificationToken()
    {
        return str_random(40);
    }
}
