<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WaitingTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_waiter_text()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->waitForText('Waiter')
                    ->pause(2000)
                    ->assertSee('Waiter');
        });
    }
}
