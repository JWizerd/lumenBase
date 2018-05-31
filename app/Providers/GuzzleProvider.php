<?php 

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\Exception\TransferException;

class GuzzleProvider extends ServiceProvider {

    protected static $baseUri;
    protected static $guzzle = null;

    protected $headers = [];

    /**
     * for better usability of GuzzleHttp\Client lets create singleton
     * @link(php singleton using late static binding, https://stackoverflow.com/questions/203336/creating-the-singleton-design-pattern-in-php5)
     * @return [obj] Guzzle instance
     */
    protected function api() : Guzzle
    {
        if (is_null(static::$guzzle)) {
            static::$guzzle = (new Guzzle(['base_uri' => static::$baseUri]));   
        }

        return static::$guzzle;
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
        try {
            return $this->api()->get(
                        $endpoint, 
                        [
                            'headers' => $this->headers,
                            'query' => $params
                        ]
                    );
        } catch (TransferException $e) {
            echo 'External API Error' . $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
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

}