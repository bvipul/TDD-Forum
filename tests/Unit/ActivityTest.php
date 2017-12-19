<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Activity;

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
}
