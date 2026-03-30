<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CommentAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        Gate::authorize('access-admin');
        
        $comments = Comment::where('is_moderated', false)
            ->with(['user', 'article'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        Gate::authorize('access-admin');
        
        $comment->update([
            'is_moderated' => true,
            'is_approved' => true,
            'moderated_at' => now(),
            'moderated_by' => Auth::id()
        ]);
        
        return redirect()->back()->with('success', 'Комментарий одобрен');
    }

    public function reject(Comment $comment)
    {
        Gate::authorize('access-admin');
        
        $comment->update([
            'is_moderated' => true,
            'is_approved' => false,
            'moderated_at' => now(),
            'moderated_by' => Auth::id()
        ]);
        
        return redirect()->back()->with('success', 'Комментарий отклонен');
    }
}