<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('user')
                    ->withCount('comments')
                    ->get();

        return response()->json($blogs);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        
        $blog = Blog::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => $request->user()->id,
        ]);

        // Reload with user relationship
        $blog->load('user');

        return response()->json([
            'message' => 'Blog created successfully',
            'blog' => $blog
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return response()->json($blog, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update([
            'title'=> $validated['title'],
            'content'=> $validated['content'],
        ]);

        return response()->json([
            'message' => 'Blog updated successfully',
            'blog'=> $blog,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response()->json([
            'message' => "Blog deleted successfully",
            'blog'=> $blog
        ], 200);
    }
}
