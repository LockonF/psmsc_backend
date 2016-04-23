<?php

namespace App;

use App\Models\Publicaciones;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract

{

    use Authenticatable, Authorizable, CanResetPassword;

    protected $table= "usuarios";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password','email', 'FechaNac'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function Valorizacion()
    {
        return $this->hasOne('App\Models\Valorizacion');
    }

    public function Publicaciones()
    {
        return $this->hasMany('App\Models\Publicaciones','user_id');
    }
}
