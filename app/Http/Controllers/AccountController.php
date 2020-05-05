<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

class AccountController extends Controller
{
    /**
     * Show the application settings.
     *
     * @param Request $request
     * @return Response
     */
    public function settings(Request $request)
    {
        return view('account.settings', [
            'token' => request()->user()->api_token
        ]);
    }
}
