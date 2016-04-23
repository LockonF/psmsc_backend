<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valorizacion extends Model
{
     protected $table= "valorizacion";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['valor'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

     public function Publicaciones()
    {
        return $this->hasOne(Publicaciones::class);
    }

    public function Usuarios()
    {
        return $this->hasOne(Usuarios::class);
    }
}
