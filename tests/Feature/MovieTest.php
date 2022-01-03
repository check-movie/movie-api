<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Movie;
use App\Models\User;
use JWTAuth;


class MovieTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function store_movie_test()
    {

        $user = User::factory()->create();


        $movie = Movie::factory()->definition([
            'id'      => 1,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAsUser($user)->post('api/movie/store', $movie);

        $response
            ->assertStatus(200);
    }



    public function actingAsUser($user, $driver = null)
    {
        $token = JWTAuth::fromUser($user);

        $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'multipart/form-data',
            'Authorization' => "Bearer {$token}"

        ]);
        parent::actingAs($user);

        return $this;
    }


}
