<?php  

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function nutrients()
    {
        return $this->hasOne('App\Models\Nutrient');
    }

    public function ingredients()
    {
        return $this->hasMany('App\Models\Ingredient');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function upvotes()
    {
        return $this->hasMany('App\Models\Upvote');
    }

    public function labels()
    {
        return $this->hasMany('App\Models\Label');
    }
}

?>