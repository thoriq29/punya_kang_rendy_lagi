<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

use Session;
class CheckStatus
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
        $response = $next($request);
        //If the status is not approved redirect to login 
        if(Auth::check() && Auth::user()->status == 0){
            Auth::logout();
            Session::flash("flash_notification", [
                "level" => "error",
                "message" => "Pengguna tidak aktif"
            ]);
            return redirect('/login');
        }
        return $response;
    }
}