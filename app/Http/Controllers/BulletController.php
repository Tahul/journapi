<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulletCreateRequest;
use App\Models\Bullet;
use Exception;
use Illuminate\Http\Response;

class BulletController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param BulletCreateRequest $request
     * @return Response
     */
    public function store(BulletCreateRequest $request)
    {
        try {
            Bullet::create([
                'user_id' => $request->user()->id,
                'published_at' => now()->timezone(auth()->user()->timezone),
                'bullet' => $request->bullet
            ]);

            $request->session()->flash('success', '✅ Bullet saved!');
        } catch (Exception $e) {
            $request->session()->flash('error', '❌ Could not save bullet.');
        }

        return redirect('journal');
    }
}
