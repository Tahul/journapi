<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulletCreateRequest;
use App\Http\Requests\BulletUpdateRequest;
use App\Models\Bullet;
use Exception;
use Illuminate\Http\Response;

class BulletController extends Controller
{
    /**
     * Store a newly created bullet in storage.
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

    /**
     * Destroy a specified bullet.
     *
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        try {
            $bullet = Bullet::find($id);

            $bullet->delete();

            request()->session()->flash('success', '✅ Bullet deleted!');
        } catch (Exception $e) {
            request()->session()->flash('error', '❌ Could not delete bullet.');
        }

        return redirect('journal');
    }

    /**
     * Update a specified bullet.
     *
     * @param BulletUpdateRequest $request
     * @param $id
     * @return Response
     */
    public function update(BulletUpdateRequest $request, $id)
    {
        try {
            $bullet = Bullet::find($id);

            $bullet->bullet = $request->bullet;

            $bullet->save();

            request()->session()->flash('success', '✅ Bullet updated!');
        } catch (Exception $e) {
            request()->session()->flash('error', '❌ Could not update bullet.');
        }

        return redirect('journal');
    }
}
