<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure; 
use Session; 
class AdminMiddleware
{
	
	public function handle($request,Closure $next)
	{
		if(@Auth::user()->status=='admin')
		{
			return $next($request);
		}
		else
		{	
			return redirect('/anggota/home'); 
		}

	 
	}
}
