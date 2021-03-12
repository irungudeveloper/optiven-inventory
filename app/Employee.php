<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = "employee";
    protected $fillable = [
    						'sir_name',
    						'other_name',
    						'phone_number',
    						'email',
    						'department_id',

    					];

    public function department()
    {
    	return $this->belongsTo(Departments::class);
    }

    public function order()
    {
    	return $this->hasMany(Order::class);
    }

    public function issued()
    {
    	return $this->hasMany(Issued::class);
   
    }
}
