<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test if user cannot login with wrong credentials
     *
     * @return void
     */
    public function test_a_user_cannot_login_with_wrong_credentials()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->visit('/login')
                ->assertSee('Login')
                ->type('email', $user->email)
                ->type('password', 'wrong-password')
                ->press('Login')
                ->assertPathIs('/login')
                ->assertSee('These credentials do not match our records.');
        });
    }    

    /**
     * Test if user can login with right credentials
     *
     * @return void
     */
    public function test_user_can_login_with_right_credentials()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use($user) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('button#login')
                    ->assertPathIs('/home');
        });
    }
}
