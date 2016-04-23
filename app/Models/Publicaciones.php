<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    protected $table= "publicaciones";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'precio','detallesUbicacion','inicioOferta','finOferta'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

     public function valorizacion()
    {
        return $this->hasOne('App\Models\Valorizacion');
    }

    public function categoria()
    {
        return $this->belongsToMany('App\Models\Categoria','categoria_publicacion','idPublicacion','idCategoria');
    }

    public function Reporte()
    {
        //return $this->hasMany(Reporte::class);
        return $this->hasMany('App\Models\Reporte','publicaciones_id');
    }

    public function Usuarios()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function Establecimiento()
    {
        return $this->belongsTo('App\Models\Establecimiento');
    }

    /* public function scopeName($query, $nombre)
    {
        dd("scope: ".$nombre);
        $query->where(\DB::raw("CONTACT(nombre)"),"LIKE", "%name%");
         return response()->json([
                    "msg"=>"failure: There is no image."
                ],500);
    }*/

    public function scopeSearch($query, $nombre)
    {
        return $query->where('nombre', 'LIKE', "%$nombre%");
    }

}
