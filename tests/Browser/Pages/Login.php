<?php

namespace Tests\Browser\Pages;

use App\User;
use Laravel\Dusk\Browser;

class Login extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            //
        ];
    }

    public function autoLogin(Browser $browser)
    {
        $user = factory(User::class)->create();

        $browser->type('email', $user->email)
                ->type('password','password')
                ->press('Login');
    }
}
