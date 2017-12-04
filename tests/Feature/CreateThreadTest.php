<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_can_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->get(route('threads.create'))
            ->assertRedirect(route('login'));
        
        $this->post(route('threads.store'), [])
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_create_threads()
    {
        $this->signIn();

        $thread = make('App\Thread');

        $response = $this->post(route('threads.store'), $thread->toArray());

        $this->get($response->headers->get('location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel_id()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 123])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 234])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        
        $thread = make('App\Thread', $overrides);

        return $this->post(route('threads.store'), $thread->toArray());
    }
}
