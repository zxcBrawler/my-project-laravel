<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;

class ArticleAdminController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $search = $request->get('search', '');
        
        $allowedSortFields = ['id', 'title', 'category', 'views', 'is_published', 'created_at', 'published_date'];
        
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        
        $articles = Article::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                            ->orWhere('short_description', 'like', "%{$search}%")
                            ->orWhere('category', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortDirection)
            ->paginate(15)
            ->appends(['sort' => $sortField, 'direction' => $sortDirection, 'search' => $search]);
        
        return view('admin.articles.index', compact('articles', 'sortField', 'sortDirection', 'search'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }
    public function store(ArticleCreateRequest $request)
    {
        $validated = $request->validated();
        
        if (!isset($validated['published_date'])) {
            $validated['published_date'] = now();
        }
        
        $validated['is_published'] = $request->has('is_published');
        
        Article::create($validated);
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Новость успешно создана!');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(ArticleUpdateRequest $request, Article $article)
    {
        
        $validated = $request->validated();
        
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;
        
        $article->update($validated);
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Новость успешно обновлена!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Новость успешно удалена!');
    }
}
