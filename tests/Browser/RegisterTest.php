<?php

namespace Tests\Browser;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();

        parent::setUp();
    }

    public function test_user_cannot_register_without_password_confirmation()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password'
        ];

        $this->browse(function (Browser $browser) use ($data) {
            $browser->visit('/register')
                ->assertSee('Register')
                ->type('name', $data['name'])
                ->type('email', $data['email'])
                ->type('password', $data['password'])
                ->type('password_confirmation', 'another-password')
                ->press('Register')
                ->assertPathIs('/register')
                ->assertSee('The password confirmation does not match.');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password'
        ];

        $this->browse(function (Browser $browser) use($data) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', $data['name'])
                    ->type('email', $data['email'])
                    ->type('password', $data['password'])
                    ->type('password_confirmation', $data['password'])
                    ->press('Register')
                    ->assertPathIs('/home')
                    ->assertSee('You are logged in!');
        });
    }

    public function test_append_and_clear()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->check('ready')
                    ->type('name', 'Choudhary ')
                    ->append('name', 'Maja')
                    ->pause(1000)
                    ->clear('name')
                    ->type('name', 'Ali Dhillon')
                    ->uncheck('ready');

            $this->assertEquals($browser->value('input#name'), 'Ali Dhillon');

        });
    }
}
