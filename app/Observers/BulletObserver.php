<?php

namespace App\Observers;

use App\Models\Bullet;

class BulletObserver
{
    /**
     * Handle the bullet "saving" event.
     *
     * @param Bullet $bullet
     */
    public function saving(Bullet $bullet)
    {
        $bullet->urls = unfurl_string($bullet->bullet);
    }
}
