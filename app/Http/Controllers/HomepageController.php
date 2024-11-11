<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Gallery;
class HomepageController extends Controller
{
    public function index(Request $request)
{

    $articles = Article::latest()->get();
    
    
    $galleryItems = Gallery::paginate(3);

    return view('home.index', compact('articles', 'galleryItems'));

    
}

}
