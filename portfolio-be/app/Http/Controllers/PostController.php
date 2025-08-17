<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return response()->json([
            'success' => true,
            'data' => $posts,
        ], Response::HTTP_OK);
    }

    // Tạo bài viết mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($validated);

        return response()->json([
            'success' => true,
            'data' => $post,
        ], Response::HTTP_CREATED);
    }

    // Lấy chi tiết bài viết
    public function show(Post $post)
    {
        return response()->json([
            'success' => true,
            'data' => $post,
        ], Response::HTTP_OK);
    }

    // Cập nhật bài viết
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $post->update($validated);

        return response()->json([
            'success' => true,
            'data' => $post,
        ], Response::HTTP_OK);
    }

    // Xóa bài viết
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
        ], Response::HTTP_OK);
    }
}
