<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_can_list_posts()
    {
        Post::factory()->count(10)->create();

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200)
            ->assertJsonCount(10);
    }

    public function test_can_create_post()
    {
        $postData = [
            'title' => 'Test Post',
            'body' => 'This is a test post body.',
            'tags' => ['test', 'laravel'],
            'reactions' => ['likes' => 10, 'dislikes' => 1],
            'views' => 50,
            'user_id' => 1,
        ];

        $response = $this->postJson('/api/posts', $postData);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Test Post']);
    }

    public function test_can_show_post()
    {
        $post = Post::factory()->create();

        $response = $this->getJson("/api/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $post->id]);
    }

    public function test_can_update_post()
    {
        $post = Post::factory()->create();

        $updateData = ['title' => 'Updated Title'];

        $response = $this->putJson("/api/posts/{$post->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Updated Title']);
    }

    public function test_can_delete_post()
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Post deleted successfully']);
    }
}
