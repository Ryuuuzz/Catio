<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $galleries = Gallery::with('favorites')->paginate(6);
        return view('gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');
        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->route('gallery.index')->with('message', 'Gallery berhasil dibuat.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'image' => 'nullable|image|max:2048',
        ]);

        $gallery->title = $request->title;
        $gallery->description = $request->description;

        if ($request->hasFile('image')) {
            Storage::delete($gallery->image);
            $gallery->image = $request->file('image')->store('images', 'public');
        }

        $gallery->save();

        return redirect()->route('dashboard.index')->with('message', 'Gallery berhasil di update.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        Storage::delete($gallery->image); 
        $gallery->delete();

        return redirect()->route('dashboard.index')->with('message', 'Gallery berhasil di hapus.');
    }

    public function show($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $gallery = Gallery::findOrFail($id);
            return view('gallery.show', compact('gallery'));
        } catch (DecryptException $e) {
            return abort(404, 'Gambar tidak di temukan.');
        }
    }

    public function trashed()
    {
        $trashedGalleries = Gallery::onlyTrashed()->paginate(6);
        return view('gallery.trashed', compact('trashedGalleries'));
    }

    public function restore($id)
    {
        $gallery = Gallery::withTrashed()->findOrFail($id);
        $gallery->restore();

        return redirect()->route('dashboard.index')->with('message', 'Gallery berhasil di kembalikan.');
    }

    public function forceDelete($id)
    {
        $gallery = Gallery::withTrashed()->findOrFail($id);
        Storage::delete($gallery->image);
        $gallery->forceDelete();

        return redirect()->route('gallery.index')->with('message', 'Gallery di hapus permanen.');
    }
}
