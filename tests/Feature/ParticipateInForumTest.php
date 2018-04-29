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
        $this->post($thread->path() . '/replies', [])
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);
        
        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }
    
    /** @test */
    public function an_unauthenticated_user_cannot_delete_a_reply()
    {
        $this->withExceptionHandling();

        $reply = create('App\Reply');

        $this->delete('/replies/{$reply->id}')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_delete_their_own_reply()
    {
        $this->signIn();
        
        $reply = create('App\Reply', ['user_id' => auth()->user()->id]);

        $this->delete("/replies/{$reply->id}");

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /** @test */
    public function an_authenticated_user_can_not_delete_others_reply()
    {
        $this->withExceptionHandling();
        
        $this->signIn();
        
        $reply = create('App\Reply');

        $this->delete("/replies/{$reply->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_can_update_reply()
    {
        $this->withExceptionHandling();
        
        $this->signIn();
        
        $reply = create('App\Reply', ['user_id' => auth()->id()]);

        $other_reply = make('App\Reply');

        $this->patch("/replies/{$reply->id}", ['body' => $other_reply->body]);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $other_reply->body]);
    }

    /** @test */
    public function an_authenticated_user_can_not_update_others_reply()
    {
        $this->withExceptionHandling();
        
        $this->signIn();
        
        $reply = create('App\Reply');

        $other_reply = make('App\Reply');

        $this->patch("/replies/{$reply->id}", ['body' => $other_reply->body])
            ->assertStatus(403);
    }
}
