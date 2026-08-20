<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (in_array($request->query('lang'), ['vi', 'en'], true)) {
            App::setLocale($request->query('lang'));
            session(['locale' => $request->query('lang')]);
        } elseif (session()->has('locale')) {
            App::setLocale(session('locale'));
        } else {
            App::setLocale(config('app.locale', 'vi'));
        }

        return $next($request);
    }
}
