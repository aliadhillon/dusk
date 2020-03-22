<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class GetValueTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_get_value_from_elements()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login');

            $browser->value('input#email', 'ali@test.com');

            dump($browser->value('input#email'));

            $browser->assertSee('Login');
        });
    }

    public function test_clik_link()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Register')
                    ->assertPathIs('/register');
        });
    }

    // public function test_get_text_of_element()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/');
            
    //         dd($browser->attribute('a#docs', 'href'));
    //     });
    // }

    public function test_set_values_using_keys()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('register')
                    ->keys('input#name', ['{SHIFT}', 'ali'], '{SPACE}', 'dhillon');
            
            $this->assertNotNull($browser->value('input#name'));
        });
    }
}
