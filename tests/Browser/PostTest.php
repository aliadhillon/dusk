<?php

namespace Tests\Browser;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use UsersTableSeeder;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_posts_index()
    {
        $user = factory(User::class)->create();

        $posts = $user->posts()->createMany(factory(Post::class, 10)->make()->toArray());

        $this->browse(function (Browser $browser) use($user, $posts) {
            $browser->loginAs($user)
                    ->visit('/posts')
                    ->assertSee('Posts');

            foreach($posts as $post){
                $browser->assertSeeIn('@posts', $post->title);
            }
        });
    }
}
