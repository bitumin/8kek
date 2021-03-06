<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
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
}
