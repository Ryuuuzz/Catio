@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="website icon" href="/assets/Blackcat-Lilith.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.9.1/dist/cdn.min.js"></script>
    <style>
        .scrollable {
            max-height: 270px;
            overflow-y: auto;
            scrollbar-width: none; 
        }
        .scrollable::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">
    <div x-data="{ open: false }" x-init="@if(session('login_required')) open = true @endif">
        <!-- Popup Notification -->
        <div x-show="open" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white px-4 py-2 rounded shadow-lg mt-4">
            You need to be logged in to access this section.
            <button @click="open = false" class="ml-4 text-white font-bold">Close</button>
        </div>
        
        <main class="flex-grow container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="md:col-span-1 bg-white p-6 flex flex-col rounded-lg shadow-md border">
                    <h2 class="text-xl md:text-2xl font-bold mb-6 text-center transition transform hover:scale-105" 
                        style="font-family: 'Rubik';">
                        <a href="{{ route('articles.index') }}" class="hover:text-blue-900">Artikel</a>
                    </h2>

                    <div class="self-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" 
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-6m0 0l-4 4m4-4l4 4" />
                        </svg>
                    </div>

                    <ul class="space-y-4 scrollable">
                        @if($articles->count())
                            @foreach($articles as $article)
                                <li class="bg-gray-100 shadow-lg rounded-lg overflow-hidden transition transform hover:scale-105">
                                    <a href="{{ route('articles.show', Crypt::encrypt($article->id)) }}" class="block px-4 py-2 text-blue-600 hover:underline">
                                        {{ $article->title }}
                                    </a>
                                    <p class="px-2 py-1 text-gray-600">{{ Str::limit($article->content, 100) }}</p>
                                </li>
                            @endforeach
                        @else
                            <li class="text-center text-gray-500">No articles available.</li>
                        @endif
                    </ul>

                    <div class="self-center mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" 
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m0 0l-4-4m4 4l4-4" />
                        </svg>
                    </div>
                </div>

                <!-- Gallery Section -->
                <div class="md:col-span-3 bg-white p-6 rounded-lg shadow-md border">
                    <div class="text-center mb-6">
                        <h2 class="text-xl md:text-2xl font-bold transition transform hover:scale-105" 
                            style="font-family: 'Rubik';">
                            <a href="{{ route('gallery.index') }}" class="hover:text-blue-900">Tipe-tipe Kucing</a>
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($galleryItems as $item)
                            <div class="bg-gray-100 shadow-lg rounded-lg overflow-hidden transition transform hover:scale-105">
                                <a href="{{ route('gallery.show', Crypt::encrypt($item->id)) }}"> 
                                    <img src="{{ asset('storage/' . $item->image) }}" 
                                            alt="{{ $item->title }}" 
                                            class="w-full h-40 object-cover">
                                </a>
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg">{{ $item->title }}</h3>
                                    <p class="text-gray-600">{{ Str::limit($item->description, 50) }}</p>
                                    <div class="flex justify-between mt-4">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination for Gallery -->
                    <div class="flex justify-center mt-4">
                        {{ $galleryItems->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
@endsection
