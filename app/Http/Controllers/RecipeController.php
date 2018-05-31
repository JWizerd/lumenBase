<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\EdamamApi as Edamam;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class RecipeController extends BaseController
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function search($recipe) 
    {
        $edamam = new Edamam;
        $response = $edamam->get('search', $edamam->params(['q' => $recipe]));
        return (
            new Response(
                    $response->getBody(), 
                    $response->getStatusCode()
                )
            )->header('Content-Type', 'application/json');
    }
}