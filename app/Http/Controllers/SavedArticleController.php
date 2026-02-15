<?php

namespace App\Http\Controllers;

use App\Models\SavedArticle;
use Illuminate\Http\Request;

class SavedArticleController extends Controller
{
    /**
     * Display all saved articles for the authenticated user.
     */
    public function index(Request $request)
    {
        // Get authenticated user
        $user = $request->user(); 

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $savedArticles = SavedArticle::where('user_id', $user->id)
            ->with('news')
            ->get();

        return response()->json($savedArticles, 200);
    }

    /**
     * Store a new saved article.
     */
    public function store(Request $request)
    {
        $user = $request->user(); 

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $request->validate([
            'news_id' => 'required|exists:news,id',
        ]);

        // Prevent duplicate
        $exists = SavedArticle::where('user_id', $user->id)
            ->where('news_id', $request->news_id)
            ->first();

        if ($exists) {
            return response()->json(['message' => 'Article already saved'], 409);
        }

        $saved = SavedArticle::create([
            'user_id' => $user->id,
            'news_id' => $request->news_id,
        ]);

        return response()->json($saved, 201);
    }

    /**
     * Delete a saved article.
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user(); 

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $saved = SavedArticle::where('user_id', $user->id)->find($id);

        if (!$saved) {
            return response()->json(['message' => 'Saved article not found'], 404);
        }

        $saved->delete();

        return response()->json(['message' => 'Saved article deleted successfully'], 200);
    }
}
