<?php

namespace Tests\Browser\Components;

use Faker\Factory;
use Faker\Generator;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class Register extends BaseComponent
{

    /**
     * Get the root selector for the component.
     *
     * @return string
     */
    public function selector()
    {
        return 'form#register-form';
    }

    /**
     * Assert that the browser page contains the component.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertVisible($this->selector());
    }

    /**
     * Get the element shortcuts for the component.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@name' => 'input#name',
            '@email' => 'input#email',
            '@pass' => 'input#password',
            '@confirm' => 'input#password-confirm'
        ];
    }

    public function enterData(Browser $browser)
    {
        $faker = Factory::create();
        
        $browser->type('@name', $faker->name)
                ->type('@email', $faker->email)
                ->type('@pass', 'password')
                ->type('@confirm', 'password');
    }
}
