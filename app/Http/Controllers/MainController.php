<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
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
