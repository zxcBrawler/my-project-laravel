<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        Gate::authorize('access-admin');
        
        $query = ActivityLog::with('user');

                if ($request->filled('quick_filter')) {
            switch ($request->quick_filter) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at', today()->subDay());
                    break;
                case 'week':
                    $query->where('created_at', '>=', now()->subDays(7));
                    break;
                case 'month':
                    $query->where('created_at', '>=', now()->subMonth());
                    break;
            }
        }
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        
        if ($request->filled('model_type')) {
            $query->where('model_type', $request->model_type);
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->quick_filter == 'today') {
            $query->whereDate('created_at', today());
        }
        
        if ($request->quick_filter == 'yesterday') {
            $query->whereDate('created_at', today()->subDay());
        }
        
        if ($request->quick_filter == 'week') {
            $query->where('created_at', '>=', now()->subDays(7));
        }
        
        if ($request->quick_filter == 'month') {
            $query->where('created_at', '>=', now()->subMonth());
        }
        
        $logs = $query->orderBy('created_at', 'desc')->paginate(20);
        
        $logs->appends($request->all());
        
        return view('admin.logs.index', compact('logs'));
    }

    public function show(ActivityLog $log)
    {
        Gate::authorize('access-admin');
        
        return view('admin.logs.show', compact('log'));
    }
}