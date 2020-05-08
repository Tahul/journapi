<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulletUpdateRequest;
use App\Models\Bullet;
use Exception;
use Givebutter\LaravelKeyable\Auth\AuthorizesKeyableRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BulletController extends Controller
{
    use AuthorizesKeyableRequests;

    /**
     * Store a newly created bullet in storage.
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function store(Request $request)
    {
        $bullet = null;
        $message = null;
        $user = is_null($request->user()) ? $request->keyable : $request->user();
        $messages = [
            'success' => '✅ Bullet saved!',
            'error' => '❌ Could not save bullet.'
        ];

        try {
            $bullet = Bullet::create([
                'user_id' => $user->id,
                'published_at' => now()->timezone($user->timezone),
                'bullet' => $request->bullet
            ]);

            if (!$request->wantsJson() && $request->hasSession()) {
                $request->session()->flash('success', $messages['success']);
            } else {
                $message = $messages['success'];
            }
        } catch (Exception $e) {
            if (!$request->wantsJson() && $request->hasSession()) {
                $request->session()->flash('error', $messages['error']);
            } else {
                $message = $messages['error'];
            }
        }

        if (!$request->wantsJson() && $request->hasSession()) {
            return redirect('journal');
        } else {
            return JsonResponse::create([
                'message' => $message,
                'data' => $bullet
            ]);
        }
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
