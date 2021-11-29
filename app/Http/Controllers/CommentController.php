<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    private $comment;

    public function __construct(CommentService $comment)
    {
        $this->comment = $comment;
    }
    public function store(StoreCommentRequest $request, $movie_id)
    {
        $user = auth()->user();

        $this->comment->store($user, $movie_id, $request->all());

    }



}
