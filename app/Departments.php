<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    //
    protected $table = "departments";
    protected $fillable = ['name',];

    public function employee()
    {
    	return $this->hasMany(App\Employee::class);
    }
}
