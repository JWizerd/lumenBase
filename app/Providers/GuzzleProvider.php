<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class GuzzleProvider extends ServiceProvider {

    protected $base_uri;

    protected $headers = [];

    /**
     * The implementation of this method ensures that child classes 
     * and more importantly, instantiated classes do not have direct access
     * to credentials. This prevents security measures such as full object display
     * via printing, __string(), and echo properties that could reveal sensitive information.
     * @param  string $type the type of credential you need
     * @return return the nested array of creds if exists
     */
    protected function getCredentials(string $type) 
    {
        $creds = require 'api_credentials.php';

        if (array_key_exists($type, $creds)) {
            return $creds[$type];
        }

        return false;
    }

    /**
     * for better usability of GuzzleHttp\Client instantiation
     * @return [obj]
     */
    protected function api() 
    {
        return (new Guzzle(['base_uri' => $this->base_uri]));   
    }

    protected function setHeader(string $type, $value) 
    {
        $this->headers[$type] = $value;
    }

    public function create(string $endpoint, array $data) 
    {
        return json_decode(
            $this->api()->post(
                $endpoint, 
                [
                    'headers' => $this->headers,
                    'json' => $data
                ]
            )->getBody()
        );
    }

    public function update(string $operation, string $endpoint, array $data) 
    {
        return json_decode(
            $this->api()->request(
                $operation,
                $endpoint,
                [
                    'headers' => $this->headers,
                    'json'    => $data
                ]
            )->getBody()
        );
    }

    public function get(string $endpoint, $params = []) 
    {
        return json_decode(
            $this->api()->get(
                $endpoint, 
                [
                    'headers' => $this->headers,
                    'query' => $params
                ]
            )->getBody()
        );
    }

    public function postForm($endpoint, $data) {
        return json_decode(
            $this->api()->post(
                $endpoint, 
                [
                    'headers' => $this->headers,
                    'form_params' => $data
                ]
            )->getBody()
        );
    }

    public function delete($endpoint) 
    {
        $this->api()->delete( 
            $endpoint,
            [
                'headers' => $this->headers
            ]
        );
    }

    /**
     * Date format must be in 
     * @param  string $date ACF datetime
     * @return string TZ - UTC formated datetime 
     */
    protected function format_date(string $date) 
    {
        return gmdate("Y-m-d\TH:i:s\Z", strtotime($date));
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

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('Client', function () {
            return new Client;
        });
    }

}