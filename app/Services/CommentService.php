<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Movie;

class CommentService
{
    private $comment, $movie;

    public function __construct(Comment $comment, Movie $movie)
    {
        $this->comment = $comment;
        $this->movie   = $movie;
    }

    public function store($user, $movie_id, array $attributes)
    {
        $this->movie->findOrFail($movie_id);

        $this->comment->author        = $user->name;
        $this->comment->author_avatar = $user->avatar;
        $this->comment->movie_id      = $movie_id;

        $this->comment->fill($attributes);

        $this->comment->saveOrFail();

    }
}














?>
