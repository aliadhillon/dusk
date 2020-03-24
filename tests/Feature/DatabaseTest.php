<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_test_database_has()
    {
        factory(User::class)->create(['email' => 'ali@example.com']);

        $this->assertDatabaseHas('users', [
            'email' => 'ali@example.com'
        ]);
    }
}
