<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests;

class VoteController extends Controller
{
    public function upVote(Requests\VoteRequest $request) {
        // one vote per session
        if (
            !$request->session()->has('voted.posts')
            || !in_array($request->input('post-id'), $request->session()->get('voted.posts'), false)
        ) {
            $request->session()->push('voted.posts', $request->input('post-id'));
        } else {
            return response()->json(['status' => 'nook']);
        }

        $post = Post::find($request->input('post-id'));
        ++$post->up;

        if(!$post->save()) {
            return response()->json(['status' => 'nook']);
        }

        return response()->json(['status' => 'ok', 'up-votes' => $post->up]);
    }

    public function downVote(Requests\VoteRequest $request) {
        // one vote per session
        if (
            !$request->session()->has('voted.posts')
            || !in_array($request->input('post-id'), $request->session()->get('voted.posts'), false)
        ) {
            $request->session()->push('voted.posts', $request->input('post-id'));
        } else {
            return response()->json(['status' => 'nook']);
        }

        $post = Post::find($request->input('post-id'));
        ++$post->down;

        if(!$post->save()) {
            return response()->json(['status' => 'nook']);
        }

        return response()->json(['status' => 'ok', 'down-votes' => $post->down]);
    }
}
