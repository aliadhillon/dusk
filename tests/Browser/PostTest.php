<?php

namespace Tests\Browser;

use App\Post;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use UsersTableSeeder;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();

        parent::setUp();
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_posts_index()
    {
        $user = factory(User::class)->create();

        $posts = $user->posts()->saveMany(factory(Post::class, 10)->make());

        $this->browse(function (Browser $browser) use($user, $posts) {
            $browser->loginAs($user)
                    ->visit('/posts')
                    ->assertSee('Posts');

            foreach($posts as $post){
                $this->assertDatabaseHas('posts', $post->toArray());
                $browser->assertSeeIn('@posts', $post->title);
            }
        });
    }

    public function test_posts_create()
    {
        $user = factory(User::class)->create();

        $data = [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraphs(5, true)
        ];

        $this->browse(function (Browser $browser) use($user, $data) {
            $browser->loginAs($user)
                    ->visit('/posts/create')
                    ->assertSee('Create New Post')
                    ->type('title', $data['title'])
                    ->type('body', $data['body'])
                    ->press('Create')
                    ->assertUrlIs(route('posts.show', ['post' => 1]))
                    ->assertSee('Post created successfully')
                    ->assertSeeIn('h2#post-title', $data['title']);

            $this->assertNotNull(Post::find(1));
        });
    }

    public function test_post_edit()
    {
        $user = factory(User::class)->create();

        $post = $user->posts()->create(factory(Post::class)->make()->toArray());

        $title = $this->faker->sentence;

        $this->browse(function (Browser $browser) use ($user, $post, $title) {
            $browser->loginAs($user)
                ->visitRoute('posts.show', ['post' => $post])
                ->assertSee($post->title)
                ->press('@edit-post')
                ->assertRouteIs('posts.edit', ['post' => $post])
                ->assertSee('Edit')
                ->clear('title')
                ->type('title', $title)
                ->press('Update')
                ->assertRouteIs('posts.show', ['post' => $post])
                ->assertSee('Post has been updated')
                ->assertSeeIn('h2#post-title', $title);
        });
    }

    public function test_post_delete()
    {
        $user = factory(User::class)->create();
        $post = $user->posts()->create(factory(Post::class)->make()->toArray());

        $this->browse(function (Browser $browser) use($user, $post) {
            $browser->loginAs($user)
                    ->visitRoute('posts.show', ['post' => $post])
                    ->assertSeeIn('h2#post-title', $post->title)
                    ->press('@delete-post')
                    ->acceptDialog()
                    ->assertRouteIs('posts.index')
                    ->assertSee("Post with the title {$post->title} has been deleted.");
            
            // $this->assertNull($post->fresh());
            $this->assertDeleted($post);
        });
    }
}
