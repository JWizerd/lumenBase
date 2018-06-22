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
        // Guzzle either returns either a string if echoed or a stream object in it's response. 
        // Guzzle requires that you use it's json option inside of the request to get proper
        // contents of the response instead of a reference to the stream object
        return (
            new Response(
                    $response->getBody(), 
                    $response->getStatusCode()
                )
            )->header('Content-Type', 'application/json');
    }

    public function add(Request $request) 
    {
        /**
         * @todo data will be normalized in the edamam api before it is served to the view
         *       and then hitting this action
         */
        $data = json_decode($request->getContent())->hits[0]->recipe;
        $recipe = new Recipe;

        try {
            $recipe->name = $data->label;
            $recipe->url  = $data->url;
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    protected add_nutrients($data) 
    {
        $nutrient = new Nutrient;
    }

    protected add_ingredients() 
    {
        $ingredients = new ingredient;
    }
}