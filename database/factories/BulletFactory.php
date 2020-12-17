<?php

namespace Database\Factories;

use App\Models\Bullet;
use Illuminate\Database\Eloquent\Factories\Factory;

class BulletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bullet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'published_at' => now(),
            'bullet' => $this->faker->realText(),
        ];
    }
}
