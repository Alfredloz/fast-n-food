<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    /** many to many table relation
     * @param User 
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
