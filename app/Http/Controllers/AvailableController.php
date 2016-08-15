<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvailableController extends Controller
{
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
