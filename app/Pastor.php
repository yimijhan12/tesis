<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pastor extends Model
{
    protected $table = 'pastores';
    protected $fillable = [
        'id','sueldo','fecha_ingreso','nombre_conyugue', 'telefono_conyugue'

    ];

   public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }

}
