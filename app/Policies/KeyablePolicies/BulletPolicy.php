<?php

namespace App\Policies\KeyablePolicies;

use App\Models\Bullet;
use App\Models\User;
use Givebutter\LaravelKeyable\Models\ApiKey;

class BulletPolicy
{
    public function view(ApiKey $apiKey, User $keyable, Bullet $bullet)
    {
        return !is_null($keyable->bullets()->find($bullet->id));
    }

}
