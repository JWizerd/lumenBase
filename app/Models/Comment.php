<?php  

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe');
    }
}

?>