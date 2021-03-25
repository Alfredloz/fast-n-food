<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{       
    
    protected $fillable = ['user_id', 'total_price'];
    

    /** one to many table relation
     * @param User 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** many to many table relation
     * @param Plate 
     */
    public function plates()
    {
        return $this->belongsToMany(Plate::class)->withPivot('plate_quantity');
    }
}
