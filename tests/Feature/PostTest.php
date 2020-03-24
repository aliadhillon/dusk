<?php

namespace Tests\Feature;

use App\Events\FullPostCreated;
use App\Events\PostCreated;
use App\Jobs\AnotherJob;
use App\Jobs\LogNewPost;
use App\Mail\AnotherMail;
use App\Mail\PostCreatedMail;
use App\Notifications\PostCreatedNotify;
use App\Post;
use App\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_post()
    {
        Queue::fake();

        $faker = Factory::create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                        ->post(route('posts.store'), [
                    'title' => $faker->sentence,
                    'body' => $faker->paragraphs(3, true),
                ]);

        $response->assertRedirect(route('posts.show', ['post' => 1]));

        $post = Post::find(1);
        $this->assertNotNull($post);

        Queue::assertNotPushed(LogNewPost::class);
    }

    public function test_fake_for()
    {
        Event::fakeFor(function() {
            $post = factory(User::class)->create()->posts()->save(factory(Post::class)->make());

            event(new PostCreated($post));
            event(new FullPostCreated($post));

            $this->assertDatabaseHas('posts', ['id' => $post->id]);

            Event::assertDispatched(PostCreated::class);
            Event::assertDispatched(FullPostCreated::class);
        }, [
            PostCreated::class,
            FullPostCreated::class,
        ]);
    }
}
