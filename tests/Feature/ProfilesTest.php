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
        $user = create('App\User');

        $threadOne = create('App\Thread', ['user_id' => $user->id]);
        $threadTwo = create('App\Thread', ['user_id' => $user->id]);

        $this->get(route('profile', $user->name))
            ->assertSee($user->name)
            ->assertSee($threadOne->title)
            ->assertSee($threadOne->body)
            ->assertSee($threadTwo->title)
            ->assertSee($threadTwo->body);

    }
}
