<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required|string|min:2|max:1000',
        ]);

        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'is_moderated' => false,
            'is_approved' => false,
        ]);

        return redirect()->back()->with('success', 'Ваш комментарий отправлен на модерацию');
    }
}