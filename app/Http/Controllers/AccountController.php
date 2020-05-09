<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
            'user' => request()->user()
        ]);
    }

    /**
     * Return a json file containing all the journal of the logged in user.
     *
     * @return BinaryFileResponse
     */
    public function jsonExport()
    {
        $table = auth()->user()->bullets->groupBy(function ($item) {
            return $item->published_at->format('d-m-y');
        });

        $filename = "bullets.json";

        $handle = fopen($filename, 'w+');

        fputs($handle, $table->toJson(JSON_PRETTY_PRINT));

        fclose($handle);

        $headers = array('Content-type' => 'application/json');

        return response()->download($filename, 'journal.json', $headers);
    }
}
