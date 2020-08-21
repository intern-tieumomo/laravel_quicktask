<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function employees()
    {
    	return $this->belongsToMany('App\Employee');
    }
}
