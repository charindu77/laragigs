<?php

namespace Tests\Feature;

<<<<<<< HEAD
use Illuminate\Foundation\Testing\RefreshDatabase;
=======
// use Illuminate\Foundation\Testing\RefreshDatabase;
>>>>>>> parent of f11c52d (Refactor user actions)
use Tests\TestCase;

class ExampleTest extends TestCase
{
<<<<<<< HEAD
    use RefreshDatabase;

=======
>>>>>>> parent of f11c52d (Refactor user actions)
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
