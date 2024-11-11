@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg p-6 relative">
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    </head>
    <!-- X -->
    <button onclick="window.history.back()" class="absolute top-4 right-4 text-gray-400 hover:text-black rounded-sm px-3 py-1 items-center justify-center transition duration-300 ease-in-out z-10">
        <i class="fas fa-times text-xl"></i> 
    </button>
    <!-- /X -->
    
    <div class="text-center mb-6">
    <h1 class="text-4xl font-bold whitespace-pre-wrap" style="font-family: 'Poppins', sans-serif;">{{ $gallery->title }}</h1>
    </div>

    <div class="flex justify-center mb-6">
        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="object-contain max-h-96 max-w-full">
    </div>

    <div class="prose max-w-4xl mx-auto">
        <p class="text-gray-600 whitespace-pre-wrap" style="font-family: 'Poppins', sans-serif;" >{{ $gallery->description }}</p>
    </div>
</div>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
