<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "category";
    protected $fillable = ['name',];

    public function inventory()
    {
    	return $this->hasMany(App\Inventory::class);
    }

    public function order()
    {
    	return $this->hasMany(Order::class);
    }
}
