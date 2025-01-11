<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all(); // Fetch and return all posts
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return metadata or default values for creating a post
        return response()->json([
            'default_values' => [
                'title' => '',
                'body' => '',
                'tags' => [],
                'reactions' => ['likes' => 0, 'dislikes' => 0],
                'views' => 0,
                'user_id' => null,
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'tags' => 'nullable|array',
            'reactions' => 'nullable|array',
            'views' => 'nullable|integer',
            'user_id' => 'required|integer',
        ]);

        $post = Post::create($data);

        return response()->json($post, 201); // Return the created post with a 201 status code
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json($post); // Laravel automatically handles Route Model Binding
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // Return the existing post data for editing
        return response()->json([
            'post' => $post,
            'editable_fields' => [
                'title',
                'body',
                'tags',
                'reactions',
                'views',
                'user_id',
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'sometimes|string',
            'body' => 'sometimes|string',
            'tags' => 'nullable|array',
            'reactions' => 'nullable|array',
            'views' => 'nullable|integer',
            'user_id' => 'sometimes|integer',
        ]);

        $post->update($data);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
