<?php

use App\Models\User;

function respondWithToken($token, $request)
{
    $user = User::where('email', $request->email)
        ->first();

    return response()->json([
        'access_token' => $token,
        'user_avatar'  => $user->avatar,
        'user_name'    => $user->name,
        'token_type'   => 'bearer',
    ]);

}

?>
