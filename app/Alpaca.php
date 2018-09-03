<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alpaca extends Model
{
    	protected $primaryKey ='alpa_id';
        protected $fillable=[
    	'idfundo',
    	'alpa_arete',
    	'alpa_nombre',
    	'alpa_fotos',
    	'alpa_peso_nac',
    	'alpa_arete_padre',
    	'alpa_arete_madre',
    	'alpa_descripcion',
    	'alpa_condicion'	
    ];
        public function fundo(){
        return $this->belongsTo('App\Fundo');
    }
}
