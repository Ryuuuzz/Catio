@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">Edit Galeri Kucing</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('gallery.update', $gallery->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-black">Judul Galeri:</label>
            <input type="text" id="title" name="title" class="w-full p-2 bg-gray-100 text-black rounded" value="{{ $gallery->title }}" required aria-label="Judul Galeri">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-black">Deskripsi:</label>
            <textarea id="description" name="description" class="w-full p-2 bg-gray-100 text-black rounded" oninput="updatePreview()" required aria-label="Deskripsi">{{ $gallery->description }}</textarea>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-bold mb-2">Preview:</h2>
            <div id="preview" class="p-2 border rounded bg-gray-100">{{ nl2br(e($gallery->description)) }}</div>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-black">Unggah Gambar:</label>
            <input type="file" id="image" name="image" class="w-full p-2 bg-gray-100 text-black rounded" accept="image/*" onchange="previewImage(event)" aria-label="Unggah Gambar">
            <img id="imagePreview" src="{{ asset('storage/' . $gallery->image) }}" class="mt-4 rounded" style="max-width: 300px;" alt="Gallery Image">
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Perbarui</button>
    </form>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.style.display = 'block';
    }

    function updatePreview() {
        const description = document.getElementById('description').value;
        const preview = document.getElementById('preview');
        preview.innerHTML = description.replace(/\n/g, "<br>") || "Preview will appear here."; // Provide a default message
    }

    document.addEventListener('DOMContentLoaded', function() {
        updatePreview();
    });
</script>
@endsection
