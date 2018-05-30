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
        print_r((new Edamam)->get('/search', ['q' => 'chicken']));
    }
}