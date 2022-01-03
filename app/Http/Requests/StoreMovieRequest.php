<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'            => 'required',
            'origin_title'     => 'string',
            'poster'           => 'string',
            'tmdb_rating'      => 'string',
            'tmdb_total_rates' => 'string',
            'plot'             => 'string',
            'homepage'         => 'string',
            'release_date'     => 'string',
            'my_rate'          => 'integer',

        ];
    }
}
