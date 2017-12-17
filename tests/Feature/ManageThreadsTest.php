<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageThreadsTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    public function setUp() {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_guest_can_not_delete_thread()
    {
        $this->withExceptionHandling()
            ->delete($this->thread->path())
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_delete_thread()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $this->delete($thread->path());

        $this->assertDatabaseMissing('threads', ['id' => $thread->id])
            ->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }
}
