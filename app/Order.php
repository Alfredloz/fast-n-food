<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plates()
    {
        return $this->belongsToMany(Plate::class)->withPivot('plate_quantity');
    }
}
