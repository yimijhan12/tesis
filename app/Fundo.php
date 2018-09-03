<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Fundo extends Model
{
	protected $table ='fundo';
	protected $primaryKey ='fund_id';
        protected $fillable=[
    	'fund_nombre',
    	'fund_departamento',
    	'fund_provincia',
    	'fund_distrito',
    	'fund_lugar',
    	'fund_condicion'
    ];


    public function getFund_nombreAtribute($value)
    {
        return strtoupper($value);
    }
    public function alpacas()
    {
    	return $this->hasMany('App/Alpaca');
    }
}
