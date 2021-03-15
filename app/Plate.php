<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Plate extends Model
{
    protected $fillable = ['name', 'description_ingredients', 'picture', 'price', 'visibility', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);

    }
    
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('plate_quantity');
    }

}
