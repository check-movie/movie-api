<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Movie;
use App\Http\Requests\StoreRateRequest;
use App\Services\RatingService;


class RateController extends Controller
{

    private $rate;

    public function __construct(RatingService $rate)
    {
        $this->rate = $rate;
    }

    public function rate(StoreRateRequest $request, $movie_id)
    {
        $user = auth()->user();

        $this->rate->store($user, $movie_id, $request->rate);
    }

    public function update(StoreRateRequest $request, $rate_id)
    {
        $user = auth()->user();

        $this->rate->update($user, $rate_id, $request->all());
    }
}
