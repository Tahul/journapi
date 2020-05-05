<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulletCreateRequest;
use App\Models\Bullet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BulletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

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
                'bullet' => $request->bullet
            ]);

            $request->session()->flash('success', '✅ Bullet saved!');
        } catch (Exception $e) {
            $request->session()->flash('error', '❌ Could not save bullet.');
        }

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
