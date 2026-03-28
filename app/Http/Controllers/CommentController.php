<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Blog $blog)
    {
        // Paginate all comments (including deleted ones)
        $comments = $blog->comments()
            ->with('user')
            ->paginate(5);

        // Count only non-deleted comments for pagination total
        $activeCount = $blog->comments()
            ->where('deleted', false)
            ->count();

        // Replace the total in the paginator
        $comments->total($activeCount);

        return response()->json($comments);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'blog_id' => 'required|exists:blogs,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create the comment
        $comment = Comment::create([
            'content' => $validated['content'],
            'blog_id' => $validated['blog_id'],
            'user_id' => $validated['user_id'],
        ]);
        $comment->load('user');
        // Return JSON response
        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => $comment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog, Comment $comment)
    {
        
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->update([
            'content' => $validated['content'],
        ]);

        $comment->load('user');

        return response()->json([
            'message' => 'Blog updated successfully',
            'comment'=> $comment,
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->update(['deleted' => true]);

        return response()->json([
            'message' => "Comment deleted successfully",
            'comment' => $comment
        ], 200);
    }
}
