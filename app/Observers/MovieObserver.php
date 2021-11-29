<?php

namespace App\Observers;

use App\Models\Movie;

class MovieObserver
{
    /**
     * Handle the Movie "created" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function created(Movie $movie)
    {
        $title  = request('title');

        $movies = $movie->where('title', $title)
                        ->limit(1)
                        ->get();

        foreach($movies as $model)
        {
            $movie->check_movie_rating = $model->check_movie_rating;
            $movie->rates_time = $model->rates_time;

            $movie->update();
        }

    }

    /**
     * Handle the Movie "updated" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function updated(Movie $movie)
    {
        //
    }

    /**
     * Handle the Movie "deleted" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function deleted(Movie $movie)
    {
        //
    }

    /**
     * Handle the Movie "restored" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function restored(Movie $movie)
    {
        //
    }

    /**
     * Handle the Movie "force deleted" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function forceDeleted(Movie $movie)
    {
        //
    }
}
