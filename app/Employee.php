<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public function tasks()
    {
    	return $this->belongsToMany('App\Task');
    }
}
