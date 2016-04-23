<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoria_publicacion extends Model
{
     protected $table= "categoria_publicacion";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
