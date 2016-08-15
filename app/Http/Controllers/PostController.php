<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
    /**
     * Show post page.
     *
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function post(Request $request, Post $post)
    {
        $allowVote = !($request->session()->has('voted.posts')
            && in_array($post->id, $request->session()->get('voted.posts'), false));

        $comments = DB::table('comments')
            ->where('post_id', $post->id)
            ->latest()
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.name AS author')
            ->paginate(25);

        return view('post', [
            'allowVote' => $allowVote,
            'post' => $post,
            'comments' => $comments
        ]);
    }

    /**
     * @param Requests\UploadImageRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadImage(Requests\UploadImageRequest $request) {
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $extension = $request->file('file')->guessExtension() ?: $request->file('file')->getClientOriginalExtension();
            $destinationPath = public_path('image');
            $fileName = uniqid($request->user()->id, false) . $extension;

            $request->file('file')->move($destinationPath, $fileName);

            $request->session()->put('imageUploadFilename', $fileName);

            return response('', 200);
        }

        return response('', 400);
    }

    /**
     * @param Requests\UploadPostRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newPost(Requests\UploadPostRequest $request) {
        if (!$request->session()->has('imageUploadFilename')) {
            return response('', 400);
        }

        $post = Post::create([
            'title' => $request->input('title'),
            'image' => $request->session()->pull('imageUploadFilename')
        ]);

        if (!isset($post->id)) {
            return response('', 400);
        }

        return redirect()->route('home.last');
    }
}
