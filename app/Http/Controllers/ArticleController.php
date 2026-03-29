<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->recent()
            ->get();
        
        return view('articles.index', compact('articles'));
    }
    
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->published()
            ->firstOrFail();
        
        $article->increment('views');
        
        $relatedArticles = Article::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->published()
            ->recent()
            ->limit(3)
            ->get();
        
        return view('articles.show', compact('article', 'relatedArticles'));
    }
    
    public function category($category)
    {
        $articles = Article::byCategory($category)
            ->published()
            ->recent()
            ->get();
        
        $currentCategory = $category;
        
        return view('articles.category', compact('articles', 'currentCategory'));
    }
}
