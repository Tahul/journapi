<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bullet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bullet', 'user_id'
    ];

    /**
     * User related to that bullet.
     *
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
