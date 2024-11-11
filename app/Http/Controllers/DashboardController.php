<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index(Request $request)
{

    $articles = Article::latest()->get();
    
    
    $galleryItems = Gallery::latest()->get();

    return view('dashboard.index', compact('articles', 'galleryItems'));
}

}
