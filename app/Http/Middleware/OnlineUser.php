<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class OnlineUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::check()))
        {
            $expiretime = \Carbon\Carbon::now()->addMinutes(5);
            Cache::put('OnlineUser'.Auth::user()->id, true, $expiretime);

            $getUserInfor = User::getSingle(Auth::user()->id);
            $getUserInfor->updated_at = date('Y-m-d H:i:s');
            $getUserInfor->save();

        }
        return $next($request);
    }
}
