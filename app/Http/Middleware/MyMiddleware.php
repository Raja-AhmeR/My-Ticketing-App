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

            $permissions = getAllPermissions();
            // dd(array_key_exists('create-ticket', $permissions));

            if ($roleArray[0] == 1) {
                return $next($request);
            }
            elseif ($roleArray[0] == 2) {
                if (array_key_exists('view-ticket', $permissions)) {
                    // return redirect(route('view-ticket'));
                    return $next($request);
                }
                elseif (array_key_exists('create-ticket', $permissions)) {
                    // return redirect(route('create-ticket'));
                    return $next($request);
                }
                else {
                    // dd(!array_key_exists('view-ticket', $permissions));
                    return redirect('access');
                }
            } elseif ($roleArray[0] == 3) {
                if (array_key_exists('view-ticket', $permissions)) {
                    return $next($request);
                }
                elseif (array_key_exists('create-ticket', $permissions)) {
                    return $next($request);
                }
                return redirect('access');
            }
        } else {
            return redirect('/login');
        }

        if ($request->input('admin')) {
            return view('admin.new-agent');
        }

    }
}
