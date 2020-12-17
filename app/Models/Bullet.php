<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bullet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bullet', 'urls', 'user_id', 'published_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
        'urls' => 'json'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'user_id'
    ];

    /**
     * User related to that bullet.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * Get the model messages for alerts.
     */
    public static function messages()
    {
        return [
            'index' => [
                'success' => '📓 Here is your journal.'
            ],
            'index' => [
                'success' => '📓 Here is your bullet.',
                'error' => '❌ Could not find this bullet.'
            ],
            'create' => [
                'success' => '✅ Bullet saved!',
                'error' => '❌ Could not save bullet.'
            ],
            'update' => [
                'success' => '✅ Bullet updated!',
                'error' => '❌ Could not update bullet.'
            ],
            'delete' => [
                'success' => '✅ Bullet deleted!',
                'error' => '❌ Could not delete bullet.'
            ]
        ];
    }

    public static function validation()
    {
        return [
            'create' => [
                'bullet' => 'required',
                'published_at' => 'date_format:Y-m-d\TH:i'
            ],
            'update' => [
                'bullet' => 'required',
                'published_at' => 'date_format:Y-m-d\TH:i'
            ],
        ];
    }
}
