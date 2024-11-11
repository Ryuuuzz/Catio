@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300..900&display=swap" rel="stylesheet">
</head>

<div class="text-center py-4">
    <h1 class="text-2xl md:text-3xl font-bold" style="font-family:'Rubik', sans-serif;">Tipe-tipe kucing</h1>
</div>
<br>

@if(session('message'))
    <div id="alert" class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('message') }}
    </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 mx-4 transition">
    @foreach($galleries as $gallery)
        <div class="bg-white border shadow-md rounded-lg overflow-hidden hover:shadow-lg duration-300">
            <a href="{{ route('gallery.show', Crypt::encrypt($gallery->id)) }}" class="block">
                <div class="relative w-full h-48 bg-gray-100 overflow-hidden">
                    <img 
                        src="{{ asset('storage/' . $gallery->image) }}" 
                        class="object-cover w-full h-full transition-transform duration-300 hover:scale-110"
                        alt="Gallery Image"
                    >
                </div>

                <div class="p-4">
                    <h2 class="text-lg font-bold" style="font-family: 'Rubik', sans-serif;">{{ $gallery->title }}</h2>
                </div>
            </a>

            <div class="p-4 border-t border-gray-200 flex justify-between">
                <form action="{{ route('favorite.toggle', ['type' => 'gallery', 'id' => $gallery->id]) }}" method="POST" class="flex items-center">
                    @csrf
                    <button type="submit" class="text-blue-500 hover:underline">
                        <i class="fas fa-heart {{ Auth::user()->favorites->contains('favoritable_id', $gallery->id) ? 'text-red-500' : 'text-gray-400' }}"></i>
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

<div class="flex justify-center mt-6">
    {{ $galleries->links() }}
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            const alert = document.getElementById('alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    });
</script>
