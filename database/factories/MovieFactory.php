<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.state
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'            => $this->faker->title,
            'origin_title'     => $this->faker->title,
            'poster'           => $this->faker->url,
            'plot'             => $this->faker->text,
            'tmdb_rating'      => $this->faker->title,
            'tmdb_total_rates' => $this->faker->title,
            'homepage'         => $this->faker->title,
            'release_date'     => $this->faker->title,
            'user_id'          => 1,

        ];
    }
}
