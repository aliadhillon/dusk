<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DirectLoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_direct_login()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/home')
                    ->assertSee('Welcome, ' . $user->name)
                    ->clickLink(config('app.name'))
                    ->assertPathIs('/')
                    ->pause(500)
                    ->click('@go-home')
                    ->assertPathIs('/home');
        });
    }
}
