<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use App\Http\Requests\StoreMovieRequest;

class MovieController extends Controller
{
    private $movie;

    public function __construct(MovieService $movie)
    {
        $this->movie = $movie;
    }

    public function index()
    {
        return $this->movie->index();
    }

    public function store(StoreMovieRequest $request)
    {
        $user = auth()->user();

        $this->movie->store($user, $request->all());

        return response()->json(['The movie has been added']);
    }

    public function showMyMovies()
    {
        $user = auth()->user();

        return $this->movie->showMyMovies($user);
    }

    public function showMoviesWithComments($movie_id)
    {
        $user = auth()->user();

        return $this->movie->showMoviesWithComments($user, $movie_id);
    }
}
