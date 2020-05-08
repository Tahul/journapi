<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulletCreateRequest;
use App\Http\Requests\BulletUpdateRequest;
use App\Models\Bullet;
use Exception;
use Givebutter\LaravelKeyable\Auth\AuthorizesKeyableRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BulletController extends Controller
{
    use AuthorizesKeyableRequests;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $user = request()->keyable;

        if (!is_null($user)) {
            return JsonResponse::create([
                'message' => '📓 Here is your entire journal.',
                'data' => $user->bullets->groupBy(function ($item) {
                    return $item->published_at->format('d-m-y');
                })
            ]);
        } else {
            return JsonResponse::create([
                'message' => '❌ You need an API key to use this endpoint.'
            ], 400);
        }
    }

    /**
     * Store a newly created bullet in storage.
     *
     * @param BulletCreateRequest $request
     * @return JsonResponse|RedirectResponse|Response
     */
    public function store(BulletCreateRequest $request)
    {
        $bullet = null;
        $message = null;
        $user = request()->keyable;
        $messages = [
            'success' => '✅ Bullet saved!',
            'error' => '❌ Could not save bullet.'
        ];

        try {
            $bullet = Bullet::create([
                'user_id' => $user->id,
                'published_at' => now()->timezone($user->timezone),
                'bullet' => $request->bullet,
                'urls' => unfurl_string($request->bullet)
            ]);

            $message = $messages['success'];
        } catch (Exception $e) {
            $message = $messages['error'];
        }

        return JsonResponse::create([
            'message' => $message,
            'data' => $bullet
        ]);
    }

    /**
     * Destroy a specified bullet.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse|RedirectResponse|Response
     */
    public function delete(Request $request, $id)
    {
        $bullet = null;
        $message = null;
        $user = request()->keyable;
        $messages = [
            'success' => '✅ Bullet deleted!',
            'error' => '❌ Could not delete bullet.'
        ];

        try {
            $bullet = $user->bullets->find($id);

            if (is_null($bullet)) {
                throw new Exception('bullet_not_found');
            }

            $bullet->delete();

            $message = $messages['success'];
        } catch (Exception $e) {
            $message = $messages['error'];
        }

        return JsonResponse::create([
            'message' => $message,
            'data' => null
        ]);
    }

    /**
     * Update a specified bullet.
     *
     * @param BulletUpdateRequest $request
     * @param $id
     * @return JsonResponse|RedirectResponse|Response
     */
    public function update(BulletUpdateRequest $request, $id)
    {
        $bullet = null;
        $message = null;
        $user = request()->keyable;
        $messages = [
            'success' => '✅ Bullet updated!',
            'error' => '❌ Could not update bullet.'
        ];

        try {
            $bullet = $user->bullets->find($id);

            if (is_null($bullet)) {
                throw new Exception('bullet_not_found');
            }

            $bullet->bullet = $request->bullet;

            $bullet->save();

            $message = $messages['success'];
        } catch (Exception $e) {
            $message = $messages['error'];

        }

        return JsonResponse::create([
            'message' => $message,
            'data' => $bullet
        ]);
    }
}
