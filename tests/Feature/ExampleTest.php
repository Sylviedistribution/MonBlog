<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        // Follow the redirect and then check the final status
        $response->assertStatus(302); // Check for redirect
        $response = $this->followingRedirects()->get('/'); // Follow the redirect and check final status
        $response->assertStatus(200);    }
}
