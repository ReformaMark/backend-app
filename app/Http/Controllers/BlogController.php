<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $search = $request->get('search', "");        // default ""
        $perPage = $request->get('per_page', 6);        // default 6 rows per page
        $page = $request->get('page', 1);              // default page 1
        $sortBy = $request->get('sort_by', 'created_at'); // default sort column
        $sortDesc = $request->get('sort_desc', false);   // default descending
        
        $blogs = Blog::with('user')            
                ->withCount('comments')
                ->when($search, function ($query) use ($search) { 
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                        });
                })
                ->orderBy($sortBy, $sortDesc === true ? 'desc' : 'asc')
                ->paginate($perPage);         
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        $blog = Blog::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => $request->user()->id,
            'image' => $validated['image'],
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
        // Eager load the user relationship
        $blog->load('user');
        return response()->json($blog);
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
            'image' => 'nullable|string'
        ]);

        $blog->update([
            'title'=> $validated['title'],
            'content'=> $validated['content'],
            'image'=> $validated['image'],
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


    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            return response()->json(['url' => asset('storage/'.$path)]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
