@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Your Favorites</h1>

    @if($favorites->isEmpty())
        <p class="text-gray-600">No favorites found.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
           @foreach($favorites as $favorite)
    <div class="bg-white border rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
        @if($favorite->favoritable)
            @if($favorite->favoritable_type === 'App\Models\Gallery')
                <a href="{{ route('gallery.show', Crypt::encrypt($favorite->favoritable_id)) }}" class="flex">
                    <img src="{{ asset('storage/' . $favorite->favoritable->image) }}" alt="{{ $favorite->favoritable->title }}" class="w-32 h-32 object-cover">
                    <div class="p-4 flex-1">
                        <h2 class="text-lg font-semibold text-blue-600 hover:underline">
                            <i class="fas fa-image mr-2"></i>{{ $favorite->favoritable->title }}
                        </h2>
                    </div>
                </a>
            @else
                <a href="{{ route('articles.show', Crypt::encrypt($favorite->favoritable_id)) }}" class="flex">
                    <img src="{{ asset('storage/articles/' . $favorite->favoritable->image) }}" alt="{{ $favorite->favoritable->title }}" class="w-32 h-32 object-cover">
                    <div class="p-4 flex-1">
                        <h2 class="text-lg font-semibold text-green-600 hover:underline">
                            <i class="fas fa-file-alt mr-2"></i>{{ $favorite->favoritable->title }}
                        </h2>
                    </div>
                </a>
            @endif
        @else
            <p class="text-red-600">This item is no longer available.</p>
        @endif
    </div>
@endforeach

        </div>
    @endif
</div>
@endsection
    