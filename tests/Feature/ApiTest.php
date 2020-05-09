<?php

namespace Tests\Feature;

use App\Models\Bullet;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use DatabaseTransactions;

    public string $baseUrl;
    public User $user;

    public function setUp(): void
    {
        parent::setUp();;

        $this->baseUrl = env('APP_URL') . '/api';

        $this->user = factory(User::class)->create();

        $this->user->generateApiKey();
    }

    /**
     * INDEX
     */

    /** @test */
    public function it_allows_users_to_get_bullets()
    {
        $response = $this->get($this->baseUrl . '/bullets', [
            'Authorization' => 'Bearer ' . $this->user->apiKey
        ]);

        $response->assertStatus(200);
    }


    /** @test */
    public function it_blocks_users_to_get_bullets_without_api_key()
    {
        $response = $this->get($this->baseUrl . '/bullets', [
            'Authorization' => 'Bearer '
        ]);

        $response->assertStatus(401);
    }

    /**
     * SHOW
     */

    /** @test */
    public function it_allows_users_to_show_bullets()
    {
        $bullet = factory(Bullet::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get($this->baseUrl . '/bullets/' . $bullet->id, [
            'Authorization' => 'Bearer ' . $this->user->apiKey
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'bullet' => $bullet->bullet
            ]
        ]);
    }

    /** @test */
    public function it_blocks_users_to_show_bullets_without_api_key()
    {
        $bullet = factory(Bullet::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get($this->baseUrl . '/bullets/' . $bullet->id, [
            'Authorization' => 'Bearer '
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function it_blocks_users_to_show_other_users_bullets()
    {
        $secondUser = factory(User::class)->create();

        $bullet = factory(Bullet::class)->create([
            'user_id' => $secondUser->id
        ]);

        $response = $this->get($this->baseUrl . '/bullets/' . $bullet->id,
            [
                'Authorization' => 'Bearer ' . $this->user->apiKey
            ]
        );

        $response->assertStatus(400);
    }

    /**
     * CREATE
     */

    /** @test */
    public function it_allows_users_to_create_bullets()
    {
        $response = $this->post($this->baseUrl . '/bullets',
            [
                'bullet' => 'Today, I learned how to write tests.'
            ],
            [
                'Authorization' => 'Bearer ' . $this->user->apiKey
            ]
        );

        $response->assertStatus(200);
    }

    /** @test */
    public function it_validates_bullets_on_user_creation()
    {
        $response = $this->post($this->baseUrl . '/bullets',
            [
                'bullet' => ''
            ],
            [
                'Authorization' => 'Bearer ' . $this->user->apiKey
            ]
        );

        $response->assertStatus(400);

        $response->assertJson([
            'data' => [
                'bullet' => [
                    'The bullet field is required.'
                ]
            ]
        ]);
    }

    /** @test */
    public function it_blocks_users_to_create_bullets_without_api_key()
    {
        $response = $this->post($this->baseUrl . '/bullets',
            [
                'bullet' => 'Today, I learned how to write tests.'
            ],
            [
                'Authorization' => 'Bearer '
            ]
        );

        $response->assertStatus(401);
    }

    /**
     * UPDATE
     */

    /** @test */
    public function it_allows_users_to_update_bullets()
    {
        $bullet = factory(Bullet::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->patch($this->baseUrl . '/bullets/' . $bullet->id,
            [
                'bullet' => 'Today, I learned how to write tests decently.'
            ],
            [
                'Authorization' => 'Bearer ' . $this->user->apiKey
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'bullet' => 'Today, I learned how to write tests decently.'
            ]
        ]);
    }

    /** @test */
    public function it_validates_bullets_on_user_update()
    {
        $bullet = factory(Bullet::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->patch($this->baseUrl . '/bullets/' . $bullet->id,
            [
                'bullet' => ''
            ],
            [
                'Authorization' => 'Bearer ' . $this->user->apiKey
            ]
        );

        $response->assertStatus(400);

        $response->assertJson([
            'data' => [
                'bullet' => [
                    'The bullet field is required.'
                ]
            ]
        ]);
    }


    /** @test */
    public function it_blocks_users_to_update_bullets_without_api_key()
    {
        $bullet = factory(Bullet::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->patch($this->baseUrl . '/bullets/' . $bullet->id,
            [
                'bullet' => 'Today, I learned how to write tests.'
            ],
            [
                'Authorization' => 'Bearer '
            ]
        );

        $response->assertStatus(401);
    }

    /** @test */
    public function it_blocks_users_to_update_other_users_bullets()
    {
        $secondUser = factory(User::class)->create();

        $bullet = factory(Bullet::class)->create([
            'user_id' => $secondUser->id
        ]);

        $response = $this->patch($this->baseUrl . '/bullets/' . $bullet->id,
            [
                'bullet' => 'Today, I learned how to write tests decently.'
            ],
            [
                'Authorization' => 'Bearer ' . $this->user->apiKey
            ]
        );

        $response->assertStatus(400);
    }

    /**
     * DELETE
     */

    /** @test */
    public function it_allows_users_to_delete_bullets()
    {
        $bullet = factory(Bullet::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->delete($this->baseUrl . '/bullets/' . $bullet->id,
            [],
            [
                'Authorization' => 'Bearer ' . $this->user->apiKey
            ]
        );

        $response->assertStatus(200);
    }


    /** @test */
    public function it_blocks_users_to_delete_bullets_without_api_key()
    {
        $bullet = factory(Bullet::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->delete($this->baseUrl . '/bullets/' . $bullet->id,
            [
            ],
            [
                'Authorization' => 'Bearer '
            ]
        );

        $response->assertStatus(401);
    }

    /** @test */
    public function it_blocks_users_to_delete_other_users_bullets()
    {
        $secondUser = factory(User::class)->create();

        $bullet = factory(Bullet::class)->create([
            'user_id' => $secondUser->id
        ]);

        $response = $this->delete($this->baseUrl . '/bullets/' . $bullet->id,
            [
            ],
            [
                'Authorization' => 'Bearer ' . $this->user->apiKey
            ]
        );

        $response->assertStatus(400);
    }
}
