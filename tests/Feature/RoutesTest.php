<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function test_about_page(): void
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }

    public function test_greeting_page(): void
    {
        $response = $this->get('/greeting');
        $response->assertStatus(200);
    }

    public function test_color_page(): void
    {
        $response = $this->get('/color');
        $response->assertStatus(200);
    }

    public function test_result_page(): void
    {
        $response = $this->get('/result');
        $response->assertStatus(200);
    }

    public function test_demo_page(): void
    {
        $response = $this->get('/demo/5/Ramiru');
        $response->assertStatus(200)
                 ->assertSee('Ramiru');
    }

    public function test_movies_page(): void
    {
        $response = $this->get('/movies');
        $response->assertStatus(200)
                 ->assertSee('Inception');
    }
}
