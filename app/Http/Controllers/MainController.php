<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Post;
use DB;
use File;
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
     * Show the application home page. Newest first.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $posts = DB::table('posts')
            ->latest()
            ->simplePaginate(6);

        return view('home', array_merge(
            [
                'posts' => $posts,
                'title' => 'Last posts'
            ],
            $this->sinceParams()
        ));
    }

    /**
     * Show the application home page. Oldest first.
     *
     * @return \Illuminate\Http\Response
     */
    public function homeOld()
    {
        $posts = DB::table('posts')
            ->oldest()
            ->simplePaginate(6);

        return view('home', array_merge(
            [
                'posts' => $posts,
                'title' => 'Old posts'
            ],
            $this->sinceParams()
        ));
    }

    /**
     * @param string $since
     * @return array
     */
    private function sinceParams($since = '') {
        if ($since === '') {
            return ['hasSinceScopes' => false];
        }

        $params = [
            'hasSinceScopes' => true,
            'lastWeekScopeIsActive' => false,
            'lastMonthScopeIsActive' => false,
            'lastYearScopeIsActive' => false,
            'allTimeScopeIsActive' => false
        ];

        switch ($since) {
            case 'all-time':
                $params['allTimeScopeIsActive'] = true;
                break;
            case 'last-year':
                $params['lastYearScopeIsActive'] = true;
                break;
            case 'last-month':
                $params['lastMonthScopeIsActive'] = true;
                break;
            case 'last-week':
            default:
                $params['lastWeekScopeIsActive'] = true;
                break;
        }

        return $params;
    }

    /**
     * Show the application home page. Most viewed first.
     *
     * @param string $since
     * @return \Illuminate\Http\Response
     */
    public function homePopular(Request $request, $since = 'last-week')
    {
        $posts = Post::popular($since)->simplePaginate(6);

        return view('home', array_merge(
            [
                'posts' => $posts,
                'title' => 'Popular posts',
                'currentRoute' => $request->route()->getName()
            ],
            $this->sinceParams($since)
        ));
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function homeObscure(Request $request, $since = 'last-week')
    {
        $posts = Post::popular($since, true)->simplePaginate(6);

        return view('home', array_merge(
            [
                'posts' => $posts,
                'title' => 'Obscure posts',
                'currentRoute' => $request->route()->getName()
            ],
            $this->sinceParams($since)
        ));
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function homePraised(Request $request, $since = 'last-week')
    {
        $posts = Post::praised($since)->simplePaginate(6);

        return view('home', array_merge(
            [
                'posts' => $posts,
                'title' => 'Praised posts',
                'currentRoute' => $request->route()->getName()
            ],
            $this->sinceParams($since)
        ));
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function homeVilified(Request $request, $since = 'last-week')
    {
        $posts = Post::praised($since, true)->simplePaginate(6);

        return view('home', array_merge(
            [
                'posts' => $posts,
                'title' => 'Vilified posts',
                'currentRoute' => $request->route()->getName()
            ],
            $this->sinceParams($since)
        ));
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function homeControversial(Request $request, $since = 'last-week')
    {
        $posts = Post::controversial($since)->simplePaginate(6);

        return view('home', array_merge(
            [
                'posts' => $posts,
                'title' => 'Controversial posts',
                'currentRoute' => $request->route()->getName()
            ],
            $this->sinceParams($since)
        ));
    }

    /**
     * Show an application post.
     *
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \RuntimeException
     */
    public function post(Request $request, Post $post)
    {
        $allowVote = !($request->session()->has('voted.posts')
            && in_array($post->id, $request->session()->get('voted.posts'), false));

        return view('post', [
            'allowVote' => $allowVote,
            'post' => $post
        ]);
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

    public function postImageUpload(Requests\UploadPostImage $request) {
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

    public function postUpload(Requests\UploadPost $request) {
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

    public function upVote(Requests\Vote $request) {
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

    public function downVote(Requests\Vote $request) {
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
