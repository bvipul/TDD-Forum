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
        $this->withoutExceptionHandling()
            ->post(route('threads.store'), []);
    }

    /** @test */
    public function guest_can_not_see_the_create_page()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->withoutExceptionHandling()
            ->get(route('threads.create'))
            ->assertRedirect(route('login'));
    }
    /** @test */
    public function an_authenticated_user_can_create_threads()
    {
        $this->signIn();

        $thread = make('App\Thread');

        $this->post(route('threads.store'), $thread->toArray());
        
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
