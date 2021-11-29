<?php

namespace App\Services;

use App\Models\Movie;


class MovieService
{
    private $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function index()
    {
        return $this->movie->all();
    }

    public function showMyMovies($user)
    {
        $movies = $user->movies()->get();

        return $movies;
    }

    public function showMoviesWithComments($user, $movie_id)
    {
        $movies = $this->movie->with('comments')
                              ->where(['id' => $movie_id,
                                  'user_id' => $user->id])
                                  ->get();
        return $movies;
    }

    public function store($user, array $attributes)
    {

        $this->movie->user_id = $user->id;

        $this->movie->fill($attributes);

        $this->movie->saveOrFail();

    }
}

















?>
