@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">Edit Artikel</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-black">Judul Artikel:</label>
            <input type="text" id="title" name="title" class="w-full p-2 bg-gray-100 text-black rounded" value="{{ $article->title }}" required aria-label="Judul Artikel">
        </div>

        <div class="mb-4">
            <label for="body" class="block text-black">Artikel:</label>
            <textarea id="body" name="body" class="w-full p-2 bg-gray-100 text-black rounded" oninput="updatePreview()" required aria-label="Artikel">{{ $article->body }}</textarea>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-bold mb-2">Preview:</h2>
            <div id="preview" class="p-2 border rounded bg-gray-100">{{ nl2br(e($article->body)) }}</div>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-black">Ubah Gambar:</label>
            <input type="file" id="image" name="image" class="w-full p-2 bg-gray-100 text-black rounded" accept="image/*" onchange="previewImage(event)" aria-label="Ubah Gambar">
            <img id="imagePreview" src="{{ asset('storage/articles/' . $article->image) }}" class="mt-4 rounded" style="max-width: 300px;" alt="Article Image">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
    </form>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result; // Set the image source to the FileReader result
                imagePreview.style.display = 'block'; // Ensure the image is displayed
            }
            reader.readAsDataURL(file); // Read the file as a data URL
        } else {
            imagePreview.src = ''; // Reset if no file is selected
        }
    }

    function updatePreview() {
        const body = document.getElementById('body').value;
        const preview = document.getElementById('preview');
        preview.innerHTML = body.replace(/\n/g, "<br>") || "Preview will appear here."; // Provide a default message
    }

    document.addEventListener('DOMContentLoaded', function() {
        updatePreview();
    });
</script>
@endsection
