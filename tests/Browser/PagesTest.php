<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Login;
use Tests\DuskTestCase;

class PagesTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Login')
                    ->on(new Login)
                    ->assertPresent('@login-card')
                    ->assertSeeIn('@login-card', 'Login')
                    ->autoLogin()
                    ->assertRouteIs('home')
                    ->assertSee('Dashboard');
        });
    }
}
