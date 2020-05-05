<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function landing()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return view('home', [
            'bullets' => $request->user()->bullets->groupBy(function ($item) {
                return $item->created_at->format('d M y');
            })
        ]);
    }
}
