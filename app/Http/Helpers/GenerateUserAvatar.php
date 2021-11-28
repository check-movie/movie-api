<?php

use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


function generateAvatar($user)
{
    $image_name  = Str::random(10);

    $avatar      = new Avatar(config('laravolt.avatar'));

    $user_avatar = $avatar->create($user->name);

    $user_avatar->save(Storage::disk('s3')
        ->put('avatars_movies/'.$image_name, $user_avatar->toSvg()));


    $image_url = Storage::disk('s3')
        ->url('avatars_movies/'.$image_name);

    return $image_url;
}


