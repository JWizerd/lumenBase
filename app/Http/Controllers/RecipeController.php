<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\EdamamApi as Edamam;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    public $modelClass = Recipe::class;

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
        $this->validate($request, [
             'name' => 'required|string|max:60',
             'nutrient_id' => 'required|integer|max:11',
             'source' => 'string|max:255',
             'image'  => 'string|max:255'
         ]);

        $recipe = new Recipe;

        try {

            return parent::create($request);

        } catch(Exception $e) {

            echo $e->getMessage();

        }
    }

    protected function add_nutrients($data) 
    {
        $nutrient = new Nutrient;
    }

    protected function add_ingredients() 
    {
        $ingredients = new ingredient;
    }
}