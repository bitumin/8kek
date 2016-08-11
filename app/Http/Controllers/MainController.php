<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Post;
use DB;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth'); //only for "control panel" pages?
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $posts = DB::table('posts')->orderBy('id', 'desc')->simplePaginate(6);

        return view('home', ['posts' => $posts]);
    }

    /**
     * Show an application post.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function post(Post $post)
    {
        return view('post', ['post' => $post]);
    }

    public function nameIsAvailable(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users'
        ]);

        return response('', 200);
    }

    public function emailIsAvailable(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users'
        ]);

        return response('', 200);
    }
}
