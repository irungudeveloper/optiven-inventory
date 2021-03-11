<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";
    protected $fillable = [
    						'user_id',
    						'employee_id',
    						'category_id',
    						'status',
    					];

    public function employee()
    {
    	return $this->belongsTo(App\Employee::class);
    }

    public function user()
    {
    	return $this->belongsTo(App\User::class);
    }
}
