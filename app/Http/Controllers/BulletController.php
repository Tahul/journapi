<?php

namespace App\Http\Controllers;

use App\Models\Bullet;
use Exception;
use Givebutter\LaravelKeyable\Auth\AuthorizesKeyableRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BulletController extends Controller
{
    use AuthorizesKeyableRequests;

    /**
     * Return the whole journal.
     *
     * @return JsonResponse
     */
    public function index()
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
     * @return JsonResponse|RedirectResponse|Response
     */
    public function store()
    {
        $bullet = null;
        $message = null;
        $user = request()->keyable;
        $messages = Bullet::messages()['create'];
        $validation = Bullet::validation()['create'];

        try {
            request()->validate($validation);
        } catch (ValidationException $e) {
            return JsonResponse::create([
                'message' => '❌ The provided data is invalid.',
                'data' => $e->errors()
            ], 400);
        }

        try {
            $bullet = Bullet::create([
                'user_id' => $user->id,
                'published_at' => now()->timezone($user->timezone),
                'bullet' => request()->bullet,
                'urls' => unfurl_string(request()->bullet)
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
     * @param $id
     * @return JsonResponse|RedirectResponse|Response
     */
    public function delete($id)
    {
        $bullet = null;
        $message = null;
        $user = request()->keyable;
        $messages = Bullet::messages()['delete'];

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
     * @param $id
     * @return JsonResponse|RedirectResponse|Response
     */
    public function update($id)
    {
        $bullet = null;
        $message = null;
        $user = request()->keyable;
        $messages = Bullet::messages()['update'];
        $validation = Bullet::validation()['update'];

        try {
            request()->validate($validation);
        } catch (ValidationException $e) {
            return JsonResponse::create([
                'message' => '❌ The provided data is invalid.',
                'data' => $e->errors()
            ], 400);
        }

        try {
            $bullet = $user->bullets->find($id);

            if (is_null($bullet)) {
                throw new Exception('bullet_not_found');
            }

            $bullet->bullet = request()->bullet;

            $bullet->urls = unfurl_string(request()->bullet);

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
