<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    use RefreshDatabase;

    /** @test */
    public function it_can_view_categories()
    {
        // Create some sample categories
        $categories = Category::factory()->count(5)->create();

        // Make a GET request to the viewCategory route
        $response = $this->get(route('viewCategory'));

        // Assert that the response is successful (HTTP status code 200)
        $response->assertStatus(200);

        // Assert that the response contains the category list
        foreach ($categories as $category) {
            $response->assertSee($category->category_name);
        }
    }
}
