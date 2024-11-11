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
    <main class="flex-grow container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

            <!-- Artikel -->
            <div class="md:col-span-2 bg-white p-6 flex flex-col rounded-lg shadow-md border">
                <h2 class="text-xl md:text-2xl font-bold text-center transition transform hover:scale-105" style="font-family: 'Rubik';">
                    <a href="{{ route('articles.index') }}" class="hover:text-blue-900">Artikel</a>
                </h2>
        <!-- artikel baru -->
                @if (auth()->user()->usertype === 'admin')
        <div class="flex justify-between mt-8">
            <a href="{{ route('articles.create') }}" 
                class="bg-purple-600 hover:bg-purple-700 text-white font-bold mt-2 py-2 px-3 rounded-lg shadow 
                        transition transform hover:scale-105 hover:shadow-xl">
                Buat artikel baru
            </a>
            <a href="{{ route('articles.trashed') }}" 
        class="bg-red-600 hover:bg-red-700 font-bold text-white mt-4 p-2 rounded-lg transition transform hover:scale-105 hover:shadow-xl" 
        style="font-family:'Rubik'">
        <i class="fa-solid fa-trash"></i> 
    </a>
        </div>
    @endif
    <br>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Title</th>
                            <th class="text-left">Waktu</th>
                            <th class="text-left">Edit/delete</th>
                        </tr>
                    </thead>
                    <tbody class="scrollable">
                        @if($articles->count())
                            @foreach($articles as $article)
                                <tr class="bg-gray-100 shadow-lg rounded-lg overflow-hidden transition transform hover:scale-105">
                                    <td>
                                        <a href="{{ route('articles.show', encrypt($article->id)) }}" class="block px-4 py-2 text-blue-600 hover:underline">
                                            {{ $article->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <div>Di buat: {{ $article->created_at->format('Y-m-d H:i:s') }}</div>
                                        <hr>
                                        <div>Di ubah: {{ $article->updated_at->format('Y-m-d H:i:s') }}</div>
                                    </td>
                                    <td>
                                        @if (auth()->user()->usertype == 'admin')
                                            <a href="{{ route('articles.edit', $article->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center text-gray-500">No articles available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Gallery -->
            <div class="md:col-span-3 bg-white p-6 rounded-lg shadow-md border">
                <div class="text-center mb-6">
                    <h2 class="text-xl md:text-2xl font-bold transition transform hover:scale-105" style="font-family: 'Rubik';">
                        <a href="{{ route('gallery.index') }}" class="hover:text-blue-900">Tipe-tipe Kucing</a>
                    </h2>
                </div>

                <!-- Gambar baru dan bank sampah -->
                @if (auth()->user()->usertype == 'admin')
                <div class="flex justify-between mb-4">
    <a href="{{ route('gallery.create') }}" 
        class="bg-purple-600 hover:bg-purple-700 font-bold text-white px-3 py-3 rounded-lg transition transform hover:scale-105 hover:shadow-xl" 
        style="font-family:'Rubik'">
        Buat gambar baru
    </a>
    <a href="{{ route('gallery.trashed') }}" 
        class="bg-red-600 hover:bg-red-700 font-bold text-white mt-4 p-2 rounded-lg transition transform hover:scale-105 hover:shadow-xl" 
        style="font-family:'Rubik'">
        <i class="fa-solid fa-trash"></i> 
    </a>
</div>

                @endif
                
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Gambar</th>
                            <th class="text-left">Judul</th>
                            <th class="text-left">Deskripsi</th>
                            <th class="text-left">Waktu</th>
                            <th class="text-left">Edit/delete</th>
                        </tr>
                    </thead>
                    <tbody class="scrollable">
                        @foreach ($galleryItems as $item)
                            <tr class="bg-gray-100 shadow-lg rounded-lg overflow-hidden transition transform hover:scale-105">
                                <td>
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-20 h-20 object-cover">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ Str::limit($item->description, 50) }}</td>
                                <td>
                                    <div>Di buat: {{ $item->created_at->format('Y-m-d H:i:s') }}</div>
                                    <hr>
                                    <div>Di ubah: {{ $item->updated_at->format('Y-m-d H:i:s') }}</div>
                                </td>
                                <td>
                                    @if (auth()->user()->usertype == 'admin')
                                        <a href="{{ route('gallery.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('gallery.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</body>
@endsection


<!-- font aw -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
