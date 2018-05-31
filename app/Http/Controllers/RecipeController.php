<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\EdamamApi as Edamam;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class RecipeController extends BaseController
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($recipe) 
    {
        $edamam = new Edamam;

        print_r($edamam);
        var_dump(($edamam->get('search', $edamam->params(['q' => 'chicken']))));
    }
}