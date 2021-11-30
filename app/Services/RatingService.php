<?php

namespace App\Services;

use App\Models\Rate;
use App\Models\Movie;


class RatingService
{

    private $rate, $movie;

    public function __construct(Rate $rate, Movie $movie)
    {
        $this->rate  = $rate;
        $this->movie = $movie;
    }

    public function showMyRates($user)
    {
        $rates = $user->rates()->get();

        return $rates;

    }

    public function store($user, $movie_id, $rate)
    {
        $movie = $this->movie->findOrFail($movie_id);

        $this->rate->movie_id = $movie_id;
        $this->rate->title    = $movie->title;
        $this->rate->user_id  = $user->id;
        $this->rate->rate     = $rate;


        $this->rate->saveOrFail();

        $this->calculate($movie_id, $rate);

    }

    public function update($rate_id, array $data)
    {

        $rates = $this->rate->findOrFail($rate_id);

        $movie_id = $rates->movie_id;

        $rates->update($data);

        $this->calculate($movie_id);
    }


    public function calculate($movie_id)
    {
        $times_rate = null;

        $movie = $this->movie->findOrFail($movie_id);

        $total_ratings = $this->rate->where('title', $movie->title)
                                    ->count('rate');

        for($i=0; $i<=5; ++$i)
        {
            $rates = Rate::where([
                'title' => $movie->title,
                'rate'     => $i
            ])->count();


            $assoc_rates = array($i=>$rates);

            foreach($assoc_rates as $x => $x_value)
            {
                $multi[$i]    = $x*$x_value;
                $times_rate  += $x_value;
            }
        }

        $multisum = array_sum($multi);

        $movie_rate = fdiv($multisum,$times_rate);

        $movie->check_movie_rating = $movie_rate;
        $movie->rates_time         = $total_ratings;

        $this->movie->where('title', $movie->title)
                    ->update(['check_movie_rating' => $movie_rate,
                        'rates_time' => $total_ratings]);
    }
}

?>
