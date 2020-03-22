<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AvailableAssertionsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_assertions()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertPathBeginsWith('/');
        });
    }
}
