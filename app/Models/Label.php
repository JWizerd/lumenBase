<?php  

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe');
    }
}

?>