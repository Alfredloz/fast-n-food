<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Plate extends Model
{
    protected $fillable = ['name', 'description_ingredients', 'picture', 'price', 'visibility', 'slug', 'user_id'];
    
    /** one to many table relation
     * @param User 
     */
    public function user()
    {
        return $this->belongsTo(User::class);

    }
    
    /** many to many table relation
     * @param Order 
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('plate_quantity');
    }
    // slug implement for URI
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
