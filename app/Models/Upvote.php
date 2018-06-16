<?php  

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    /**
     * Get the phone record associated with the user.
     */
    public function recipe()
    {
        return $this->belongsTo('App\Models\Upvote');
    }
}

?>