<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $table = "brand";
    protected $fillable = ['name',];

    public function inventory()
    {
    	return $this->hasMany(App\inventory::class);
    }
}
