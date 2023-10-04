<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $requireAge = 18, int $deafultAge = 0): Response
    {
        if($request->input('age', $deafultAge) < $requireAge){

            abort(423, "Musisz mieć skończone {$requireAge} lat");
        }
        return $next($request);
    }
}
