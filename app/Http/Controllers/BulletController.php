<?php

namespace App\Http\Controllers;

use App\Models\Bullet;
use Carbon\Carbon;
use Exception;
use Givebutter\LaravelKeyable\Auth\AuthorizesKeyableRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use JamesMills\LaravelTimezone\Facades\Timezone;

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
        $messages = Bullet::messages()['index'];
        $user = request()->keyable;

        return JsonResponse::create([
            'message' => $messages['success'],
            'data' => $user->bullets->groupBy(function ($item) {
                return $item->published_at->format('d-m-y');
            })
        ]);
    }

    /**
     * Return the requested bullet.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $user = request()->keyable;
        $messages = Bullet::messages()['index'];

        $bullet = $user->bullets->find($id);

        if (!is_null($bullet)) {
            return JsonResponse::create([
                'message' => $messages['success'],
                'data' => $bullet
            ]);
        } else {
            return JsonResponse::create([
                'message' => '❌ Bullet not found.',
                'data' => null
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

        // Validation
        try {
            request()->validate($validation);
        } catch (ValidationException $e) {
            return JsonResponse::create([
                'message' => '❌ The provided data is invalid.',
                'data' => $e->errors()
            ], 400);
        }

        // Creation
        try {
            $publishedAt = now()->timezone($user->timezone);

            if (request()->has('published_at')) {
                $publishedAt = request()->published_at;
            }

            $bullet = Bullet::create([
                'user_id' => $user->id,
                'published_at' => $publishedAt,
                'bullet' => request()->bullet
            ]);

            $message = $messages['success'];
        } catch (Exception $e) {
            $message = $messages['error'];

            return JsonResponse::create([
                'message' => $message,
                'data' => $bullet
            ], 400);
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

        // Deletion
        try {
            $bullet = $user->bullets->find($id);

            if (is_null($bullet)) {
                throw new Exception('bullet_not_found');
            }

            $bullet->delete();

            $message = $messages['success'];
        } catch (Exception $e) {
            $message = $messages['error'];

            return JsonResponse::create([
                'message' => $message,
                'data' => null
            ], 400);
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

        // Validation
        try {
            request()->validate($validation);
        } catch (ValidationException $e) {
            return JsonResponse::create([
                'message' => '❌ The provided data is invalid.',
                'data' => $e->errors()
            ], 400);
        }

        // Update
        try {
            $bullet = $user->bullets->find($id);

            if (is_null($bullet)) {
                throw new Exception('bullet_not_found');
            }

            $bullet->bullet = request()->bullet;

            if (request()->has('published_at')) {
                $bullet->published_at = request()->published_at;
            }

            $bullet->save();

            $message = $messages['success'];
        } catch (Exception $e) {
            $message = $messages['error'];

            return JsonResponse::create([
                'message' => $message,
                'data' => null
            ], 400);
        }

        return JsonResponse::create([
            'message' => $message,
            'data' => $bullet
        ]);
    }
}
