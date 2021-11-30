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

    public function showMyMoviesWithComments()
    {
        $user = auth()->user();

        return $this->movie->showMyMoviesWithComments($user);
    }

    public function showMyMoviesWithRates()
    {
        $user = auth()->user();

        return $this->movie->showMyMoviesWithRates($user);
    }

    public function showMyMovies()
    {
        $user = auth()->user();

        return $this->movie->showMyMovies($user);
    }
}
