<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MultiBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $users = factory(User::class, 2)->create();

        $this->browse(function (Browser $first, Browser $second) use($users) {
            $first->loginAs($users[0])
                  ->visit('/home')
                  ->assertSee('You are logged in!');

            $second->loginAs($users[1])
                ->visit('/home')
                ->assertSee('You are logged in!');
        });
    }
}
