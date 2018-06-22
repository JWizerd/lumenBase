<?php  

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    public function recipe()
    {
        return $this->belongsTo('App\Models\Upvote');
    }
}

?>