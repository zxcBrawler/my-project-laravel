<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Mail\NewArticleMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Jobs\SendNewArticleNotificationJob;

class ArticleAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        Gate::authorize('access-admin');
        
        $search = $request->get('search', '');
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        $allowedSortFields = ['id', 'title', 'category', 'views', 'is_published', 'created_at', 'published_date'];
        
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        
        $articles = Article::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('short_description', 'like', "%{$search}%")
                             ->orWhere('category', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortDirection)
            ->paginate(15)
            ->appends(['search' => $search, 'sort' => $sortField, 'direction' => $sortDirection]);
        
        return view('admin.articles.index', compact('articles', 'sortField', 'sortDirection', 'search'));
    }

    public function create()
    {
        Gate::authorize('access-admin');
        return view('admin.articles.create');
    }

    public function store(ArticleCreateRequest $request)
    {
        Gate::authorize('access-admin');
        
        $validated = $request->validated();
        
        if (!isset($validated['published_date'])) {
            $validated['published_date'] = now();
        }
        
        $validated['is_published'] = $request->has('is_published');
        
        $article = Article::create($validated);
        
        $this->sendNewArticleNotification($article);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Новость успешно создана!');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        Gate::authorize('access-admin');
        return view('admin.articles.edit', compact('article'));
    }

    public function update(ArticleUpdateRequest $request, Article $article)
    {
        Gate::authorize('access-admin');
        
        $validated = $request->validated();
        $validated['is_published'] = $request->has('is_published');
        $article->update($validated);
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Новость успешно обновлена!');
    }

    public function destroy(Article $article)
    {
        Gate::authorize('access-admin');
        
        $article->delete();
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Новость успешно удалена!');
    }

    private function sendNewArticleNotification($article)
    {
        $moderators = User::whereHas('role', function ($query) {
            $query->where('slug', 'moderator');
        })->get();

        if ($moderators->isNotEmpty()) {
            foreach ($moderators as $moderator) {
                SendNewArticleNotificationJob::dispatch($article, $moderator->email);
            }
        } else {
            SendNewArticleNotificationJob::dispatch($article, config('mail.from.address'));
        }
    }
}