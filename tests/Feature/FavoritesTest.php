<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function guests_can_not_favorite_any_reply()
    {
        $this->withExceptionHandling()
            ->post(route('reply.favorite', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply');
        
        $this->post(route('reply.favorite', $reply->id));
        
        $this->assertCount(1, $reply->favorites);
    }


    /** @test */
    public function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->withExceptionHandling()->signIn();

        $reply = create('App\Reply');

        try {
            $this->post(route('reply.favorite', $reply->id));
            $this->post(route('reply.favorite', $reply->id));
        } catch(\Exception $e) {
            $this->fail('Tried to insert same record for favorite more than once');
        }

        $this->assertCount(1, $reply->favorites);
    }
}
