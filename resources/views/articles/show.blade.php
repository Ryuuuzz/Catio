@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 relative">

    <!-- X -->
    <button onclick="window.history.back()" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 focus:outline-none">
        <i class="fa-solid fa-xmark fa-lg"></i>
    </button>

    <div class="text-center mb-6">
        <h1 class="text-4xl font-bold">{{ $article->title }}</h1>
        <p class="text-gray-600 mt-2"><span class="mx-1">|</span> {{ $article->created_at->format('F j, Y') }} <span class="mx-1">|</span> </p>
    </div>

    <div class="relative mb-8 flex justify-center">
        <div class="border border-gray-300 p-2 rounded-lg">
            <img src="{{ asset('storage/articles/' . $article->image) }}" alt="{{ $article->title }}" class="mx-auto object-contain w-128 h-64">
        </div>
    </div>

    <hr>

    <div class="prose max-w-4xl mx-auto my-3">
        <div class="text-black">{!! nl2br(e($article->body)) !!}</div>
    </div>

    <div class="flex justify-center mt-4">
        <form action="{{ route('favorite.toggle', ['type' => 'article', 'id' => $article->id]) }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center px-3 py-2 rounded
    {{ Auth::user()->favorites()->where('favoritable_id', $article->id)->where('favoritable_type', 'App\Models\Article')->exists() ? 'text-white bg-red-500 hover:bg-red-600' : 'text-gray-500 bg-white hover:bg-red-100' }}">
    <i class="fa fa-heart"></i>{{ Auth::user()->favorites()->where('favoritable_id', $article->id)->where('favoritable_type', 'App\Models\Article')->exists() ? '' : '' }}
</button>
        </form>
    </div>

</div>
@endsection

<!-- font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
