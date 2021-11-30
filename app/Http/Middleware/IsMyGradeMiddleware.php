<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Rate;

class IsMyGradeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('rate_id');

        $movie = Rate::findOrFail($id);

        if(auth()->user()->id === $movie->user_id)
        {
            return $next($request);
        }
        else
        {
            abort(401);
        }
    }
}
