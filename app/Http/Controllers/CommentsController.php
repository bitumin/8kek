<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;

class CommentsController extends Controller
{
    public function postComment(StoreCommentRequest $request)
    {
        $comment = Comment::create([
            'post_id' => $request->input('post_id'),
            'user_id' => $request->has('user_id') ? $request->input('user_id') : null,
            'content' => $request->input('content')
        ]);

        if(!isset($comment->id)) {
            return response('', 500);
        }

        return response('ok', 200);
    }
}
