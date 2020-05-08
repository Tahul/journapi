<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

class LandingController extends Controller
{
    /**
     * Show the application landing page.
     *
     * @param Request $request
     * @return Response
     */
    public function landing(Request $request)
    {
        return view('welcome');
    }
}
