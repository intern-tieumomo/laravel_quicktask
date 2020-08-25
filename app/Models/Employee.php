<?php

namespace App\Models;

use App\Task;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable = [
		'name',
		'birthday',
		'phone',
		'email',
	];

    public function tasks()
    {
    	return $this->belongsToMany(Task::class);
    }
}
