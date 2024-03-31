<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session()->has("applocale") and array_key_exists(Session()->get("applocale"), config("languages"))) {
            App::setlocale(Session()->get("applocale"));
        } else {
            App::setLocale(Config("app.fallback_locale"));
            Session::put('applocale', Config("app.fallback_locale"));
        }

        return $next($request);
    }
}
