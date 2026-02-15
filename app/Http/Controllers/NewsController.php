<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display all news items.
     */
    public function index()
    {
        $news = News::with('category')->latest()->get();
        return response()->json($news, 200);
    }

    /**
     * Store a new news item.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:100',
            'image_url' => 'nullable|url',
            'source' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $news = News::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'image_url' => $request->image_url,
            'source' => $request->source,
            'published_at' => $request->published_at,
        ]);

        return response()->json($news, 201);
    }

    /**
     * Show a single news item.
     */
    public function show($id)
    {
        $news = News::with('category')->find($id);
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }
        return response()->json($news, 200);
    }

    /**
     * Update an existing news item.
     */
    public function update(Request $request, $id)
    {
        $news = News::find($id);
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:100',
            'image_url' => 'nullable|url',
            'source' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'image_url' => $request->image_url,
            'source' => $request->source,
            'published_at' => $request->published_at,
        ]);

        return response()->json($news, 200);
    }

    /**
     * Delete a news item.
     */
    public function destroy($id)
    {
        $news = News::find($id);
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $news->delete();
        return response()->json(['message' => 'News deleted successfully'], 200);
    }
}
