<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ScopeTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_element_scope()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->with('div#links', function ($links) {
                        $links->assertSee(strtoupper('news'));
                    });
        });
    }

    public function test_see_news()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->pause(10000)
                    ->assertSee('NEWS');
        });
    }
}
