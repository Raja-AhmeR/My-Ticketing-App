<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            $roleArray = Auth::user()->role->pluck('id')->toArray();

            if ($roleArray[0] == 1) {
                return $next($request);
            } elseif ($roleArray[0] == 2) {
                
                return redirect(route('view-ticket'));
            } elseif ($roleArray[0] == 3) {
                return redirect(route('view-ticket'));
            }
        } else {
            return redirect('/login');
        }

        if ($request->input('admin')) {
            return view('admin.new-agent');
        }
        return $next($request);
    }
}
