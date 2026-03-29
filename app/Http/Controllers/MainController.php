<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        $jsonPath = public_path('articles.json');
        
        if (File::exists($jsonPath)) {
            $jsonContent = File::get($jsonPath);
            $articles = json_decode($jsonContent, true);
        } else {
            $articles = [];
        }
        
        return view('home', compact('articles'));
    }
    
    public function gallery($slug)
    {
        $jsonPath = public_path('articles.json');
        $jsonContent = file_get_contents($jsonPath);
        $articles = json_decode($jsonContent, true);
        
        foreach ($articles as $article) {
            $articleSlug = Str::slug($article['name']);
            if ($articleSlug == $slug) {
                return view('gallery', compact('article'));
            }
        }
        
        abort(404);
    }
}
