<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('favorites')->paginate(6);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = basename($imagePath);
        }

        Article::create($validated);
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil di buat');
    }

    public function show($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $article = Article::findOrFail($id);
            return view('articles.show', compact('article'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('articles.index')->with('error', 'Invalid article identifier.');
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($article->image && Storage::disk('public')->exists('articles/' . $article->image)) {
                Storage::disk('public')->delete('articles/' . $article->image);
            }

            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = basename($imagePath);
        }

        $article->update($validated);

        return redirect()->route('dashboard.index')->with('success', 'Artikel berhasil di update');
    }

    public function destroy(Article $article)
    {

        $article->delete();

        return redirect()->route('dashboard.index')->with('success', 'Artikel berhasil di hapus');
    }

    public function trashed()
    {
        $trashedArticles = Article::onlyTrashed()->paginate(6);
        return view('articles.trashed', compact('trashedArticles'));
    }

    public function restore($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->restore();

        return redirect()->route('articles.trashed')->with('success', 'Artikel berhasil di kembalikan');
    }

    public function forceDelete($id)
    {
        $article = Article::withTrashed()->findOrFail($id);

        if ($article->image && Storage::disk('public')->exists('articles/' . $article->image)) {
            Storage::disk('public')->delete('articles/' . $article->image);
        }

        $article->forceDelete();

        return redirect()->route('articles.trashed')->with('success', 'Artikel telah di delete secara permanen');
    }
}
