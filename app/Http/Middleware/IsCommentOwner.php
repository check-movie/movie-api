<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Comment;

class IsCommentOwner
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
        $id = $request->route('comment_id');

        $comment = Comment::findOrFail($id);

        if(auth()->user()->id === $comment->user_id)
        {
            return $next($request);
        }
        else
        {
            abort(401);
        }

    }
}
