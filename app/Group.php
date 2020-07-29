<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    public function admin(){
        return $this->hasMany('App\Admin');
    }
}
