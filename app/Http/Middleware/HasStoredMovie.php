<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Movie;

class HasStoredMovie
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

        $user = auth()->user();
        $title   = $request->title;

        $hasStore = Movie::where([
            'user_id' => $user->id,
            'title'   => $title
        ])->exists();

        if($hasStore)
        {
            abort(403, 'You already have this movie on your list');
        }

        return $next($request);




    }
}
