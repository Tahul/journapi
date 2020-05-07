<?php

namespace App\Traits;

use Givebutter\LaravelKeyable\Models\ApiKey;

trait Keyable
{
    public function getApiKeyAttribute()
    {
        return $this->apiKeys()->first()->key;
    }

    public function apiKeys()
    {
        return $this->morphMany(ApiKey::class, 'keyable');
    }

    public function generateApiKey()
    {
        $this->apiKeys()->each(function (ApiKey $key) {
            $key->delete();
        });

        return $this->apiKeys()->save(new ApiKey([
            'key' => ApiKey::generate()
        ]));
    }
}
