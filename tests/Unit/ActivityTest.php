<?php

namespace Tests\Unit;

use App\Activity;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_activity_is_recorded_when_creating_a_thread()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->assertDatabaseHas('activities', [
            'user_id' => auth()->id(),
            'type' => 'created_thread',
            'subject_id' => $thread->id,
            'subject_type' => "App\Thread",
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function an_activity_is_recorded_when_creating_a_reply()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $this->assertCount(2, Activity::all());

        $replyActivity = Activity::latest()->first();

        $this->assertEquals($replyActivity->subject->id, $reply->id);
    }

    /** @test */
    public function it_fetches_feed_for_user()
    {
        $this->signIn();

        create('App\Thread', ['user_id' => auth()->id()], 2);

        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);

        $feed = Activity::feed(auth()->user());
        
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('d-m-Y'))
        );

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('d-m-Y'))
        );
    }

    /** @test */
    public function it_gets_deleted_when_thread_is_deleted()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id() ]);

        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $this->delete($thread->path());

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertDatabaseMissing('activities', ['subject_id' => $thread->id]);
    }
}
