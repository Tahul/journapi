<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class AccountController extends Controller
{
    /**
     * Show the application settings.
     *
     * @return Response
     */
    public function settings()
    {
        return view('account.settings');
    }
}
