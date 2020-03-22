<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MouseTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_mouse_click()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee(config('app.name'))
                    ->click('a#register')
                    ->assertUrlIs(route('register'));
        });
    }

    public function test_drag()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->dragDown('a#register', 50);
        });
    }

    public function test_js_alert()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('button#click')
                    ->waitForDialog(2)
                    ->assertDialogOpened('What is your name?')
                    ->typeInDialog('Ali Dhillon')
                    ->pause(3000)
                    ->acceptDialog();
                    
        });
    }
}
