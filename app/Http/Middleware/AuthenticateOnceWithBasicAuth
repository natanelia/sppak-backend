<?php
/**
 * Created by IntelliJ IDEA.
 * User: natanelia
 * Date: 31/03/16
 * Time: 16:11
 */

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AuthenticateOnceWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return Auth::onceBasic() ?: $next($request);
    }

}