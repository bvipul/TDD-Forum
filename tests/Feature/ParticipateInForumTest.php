<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_authenticated_user_can_reply_to_a_thread()
    {
        //login
        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->create(['thread_id' => $thread->id]);

        //post to route
        $this->post($thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function an_unauthenticated_user_cannot_reply_to_a_thread()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        //post to route
        $this->post('threads/1/replies', []);

    }


}
