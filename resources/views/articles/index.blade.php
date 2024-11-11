@extends('layouts.app')

@section('content')
<div class="container py-8 flex justify-center">
    <h1 class="text-xl font-bold px-2 py-1 rounded-md" style="font-family: 'Rubik';">Artikel</h1>
</div>


@if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif


@if($articles->isEmpty())
    <p class="text-gray-500 text-center">No articles available yet.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($articles as $article)
    <div class="bg-white border p-4 rounded-lg shadow-md transition transform hover:scale-105 hover:shadow-xl">
        <h2 class="text-xl font-bold text-black mb-2">{{ $article->title }}</h2>
        <p class="text-gray-700 mb-3">{{ Str::limit($article->body, 100) }}</p>
        <a href="{{ route('articles.show', ['encryptedId' => encrypt($article->id)]) }}" 
            class="text-blue-500 hover:underline">
            Read more
        </a>
    </div>
@endforeach

    </div>



@endif

<!-- Tombol buat artikel -->
<!-- @auth
    @if (auth()->user()->usertype === 'admin')
        <div class="flex justify-center mt-8">
            <a href="{{ route('articles.create') }}" 
               class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg shadow 
                      transition transform hover:scale-105 hover:shadow-xl">
               Buat artikel baru
            </a>
        </div>
    @endif
@endauth -->
@endsection
