<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
     protected $table= "reporte";
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

    public function Publicaciones()
    {
        return $this->belongsTo('App\Models\Publicaciones','publicaciones_id');
    	//return $this->belongsTo(Publicaciones::class);
    }

}
