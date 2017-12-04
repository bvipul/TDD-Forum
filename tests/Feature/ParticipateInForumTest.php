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
        $this->signIn();

        $thread = create('App\Thread');

        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        //post to route
        $this->post($thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function an_unauthenticated_user_cannot_reply_to_a_thread()
    {
        $thread = create('App\Thread');
        $this->expectException('Illuminate\Auth\AuthenticationException');

        //post to route
        $this->withoutExceptionHandling()
            ->post($thread->path() . '/replies', $thread->toArray())
            ->assertRedirect(route('login'));
    }
}
