<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $table = "Inventory";
    protected $fillable = [
    						'serial_number',
    						'model_number',
    						'category_id',
    						'brand_id',
    						'description',
    						'availability',
    					];

    public function category()
    {
    	return $this->belongsTo(App\Category::class);
    }

    public function brand()
    {
    	return $this->belongsTo(App\Brand::class);
    }

    public function issued()
    {
    	return $this->hasMany(App\Issued::class);
    }
}
