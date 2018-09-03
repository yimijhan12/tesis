<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
        protected $fillable = ['nombre','apellidos','tipo_documento','num_documento','direccion','telefono','email','avatar'];

        public function Pastor(){
        	return $this->hasOne('App\Pastor');
        }
}
