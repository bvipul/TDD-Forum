<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function a_user_has_a_profile()
    {
        $this->signIn();

        $threadOne = create('App\Thread', ['user_id' => auth()->id()]);
        $threadTwo = create('App\Thread', ['user_id' => auth()->id()]);

        $this->get(route('profile', auth()->user()->name))
            ->assertSee(auth()->user()->name)
            ->assertSee($threadOne->title)
            ->assertSee($threadOne->body)
            ->assertSee($threadTwo->title)
            ->assertSee($threadTwo->body);

    }
}
