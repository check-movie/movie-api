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

    public function show($movie_id)
    {
        $this->movie->findOrFail($movie_id);

        $movie = $this->movie->with('comments', 'rates')
                             ->where('id', $movie_id)
                             ->get();

        return $movie;

    }

    public function showMyMovies($user)
    {
        $movies = $user->movies()->get();

        return $movies;
    }

    public function showMyMoviesWithComments($user)
    {
        $movies = $this->movie->with('comments')
                              ->where([
                                  'user_id' => $user->id])
                                  ->get();
        return $movies;
    }

    public function showMyMoviesWithRates($user)
    {
        $movies = $this->movie->with('rates')
                              ->where([
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
