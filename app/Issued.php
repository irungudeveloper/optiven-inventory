<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issued extends Model
{
    //
    protected $table = "issued";
    protected $fillable = [
    						'inventory_id',
    						'employee_id',
    						'expected_return_date',
    					];
    public function inventory()
    {
    	return $this->belongsTo(App\Inventory::class);
    }

    public function employee()
    {
    	return $this->belongsTo(App\Employee::class);
    }
}
