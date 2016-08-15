<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Auth;

class CommentController extends Controller
{
    public function postComment(CommentRequest $request)
    {
        $comment = Comment::create([
            'post_id' => $request->input('post_id'),
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'content' => $request->input('content')
        ]);

        if(!isset($comment->id)) {
            return response('', 500);
        }

        return redirect()->route('post', $request->input('post_id'));
    }
}
