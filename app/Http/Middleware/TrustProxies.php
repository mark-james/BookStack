<?php

namespace BookStack\Http\Middleware;

use Closure;
use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;

    /**
     * Handle the request, Set the correct user-configured proxy information.
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $setProxies = config('app.proxies');
        if ($setProxies !== '**' && $setProxies !== '*' && $setProxies !== '') {
            $setProxies = explode(',', $setProxies);
        }
        $this->proxies = $setProxies;

        return parent::handle($request, $next);
    }
}
