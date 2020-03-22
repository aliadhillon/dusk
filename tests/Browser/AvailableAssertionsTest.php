<?php

namespace Tests\Browser;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AvailableAssertionsTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_assertions()
    {
        $user = factory(User::class)->create();
        $user->posts()->save(factory(Post::class)->make());

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/posts/1?name=Ali')
                    ->assertQueryStringHas('name', 'Ali');
        });
    }

    public function test_missing()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertFragmentIs('anchor');
        });
    }
}
