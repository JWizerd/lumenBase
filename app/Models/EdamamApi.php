<?php

namespace App\Models;

use App\Providers\GuzzleProvider;
use Illuminate\Support\ServiceProvider;

class EdamamApi extends GuzzleProvider
{
    /**
     * use BaseApi for reusable Guzzle functionality
     */
    
    protected static $baseUri = "https://api.edamam.com";

    protected $baseParams;

    public function __construct() 
    {
        $this->setApiBase();
    }

    protected function setApiBase()
    {
        // using late static binding to pass $baseUri to parent ::api() method
        $this->base_uri = static::$baseUri;
        $this->setHeader('Accept-Encoding', 'gzip');
        $this->setBaseParams();
    }

    protected function setBaseParams()
    {
        $this->baseParams = [
            'app_id' => env('EDAMAM_ID'),
            'app_key' => env('EDAMAM_KEY')
        ];
    }

    public function params($otherParams) : array
    {
        return (!empty($this->baseParams)) ?
            array_merge($this->baseParams, $otherParams) :
            $otherParams;
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

?>