<?php

namespace App\Models;

use App\Providers\GuzzleProvider;
use Illuminate\Support\ServiceProvider;

class EdamamApi extends GuzzleProvider
{
    /**
     * use BaseApi for reusable Guzzle functionality
     */

    const URL = "https://api.edamam.com";

    public function __construct() 
    {
        $this->setApiBase();
    }

    protected function setApiBase()
    {
        $this->base_uri = self::URL . '/app_id=' . env('EDAMAM_ID') . '&app_key=' . env('EDAMAM_KEY');
        $this->setHeader('Accept-Encoding', 'gzip');
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