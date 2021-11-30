<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Movie;

class IsMovieOwnerMiddleware
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

        $id = $request->route('movie_id');

        $movie = Movie::findOrFail($id);

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
