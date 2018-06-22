<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if ($this->correctCredentials($request)) {
            $headers = array(
                'WWW-Authenticate' => 'Basic', 
                'Content-Type' => 'application/json'
            );
            return response($request, 200, $headers);
        }

        return $next($request);
    }

    public function correctCredentials($request) : bool
    {
        return ($request->getUser() !== (string)env('USER')) && ($request->getPassword() !== (string)env('KEY'));
    }
}