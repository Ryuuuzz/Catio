<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{    
    public function toggle($type, $id)
    {
        $user = Auth::user();
        $model = $this->getModelClass($type);

        $favorite = Favorite::where('user_id', $user->id)
            ->where('favoritable_id', $id)
            ->where('favoritable_type', $model)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('message', 'Removed from favorites.');
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'favoritable_id' => $id,
                'favoritable_type' => $model,
            ]);
            return back()->with('message', 'Added to favorites!');
        }
    }

    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->with(['favoritable'])->get();

        return view('favorites.index', compact('favorites'));
    }

    private function getModelClass($type)
    {
        return $type === 'gallery' ? 'App\Models\Gallery' : 'App\Models\Article';
    }
}
