<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $primaryKey ='rol_id';

        public function users(){
        return $this->belongsToMany('App\User','role_user','id_users','id_rol');
    }
}
