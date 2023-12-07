<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->titre = "Fabrice";
        $post->description = 'Bonjour tout le monde';
        $post->save();
        return response([$post], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $id)
    {
        $post = Post::find($id);
        if ($post) {
            return response()->json(['message' => 'Post updated'], 200);
        }
        return response()->json(['message' => 'Post not found.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully'], 200);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }
}
