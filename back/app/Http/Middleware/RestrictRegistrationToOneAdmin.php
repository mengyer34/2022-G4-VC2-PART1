<?php

namespace App\Http\Middleware;
use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class RestrictRegistrationToOneAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Admin::where('id', 1)->firstOrFail();

        if ($user && (string)$user->role == 'admin'){
            // fail and redirect silently if we already have a user with that role
            return response()->json(['sms'=> 'admin already exists'], 403);
        }

        return $next($request);
    }
}
