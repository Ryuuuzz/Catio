@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">🐾 Ras Kucing Baru</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-black">Ras Kucing:</label>
            <input type="text" id="title" name="title" class="w-full p-2 bg-gray-100 text-black rounded" required placeholder="Apa nama galeri Anda?" value="{{ old('title') }}" aria-label="Ras Kucing">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-black">Deskripsi:</label>
            <textarea id="description" name="description" class="w-full p-2 bg-gray-100 text-black rounded" required placeholder="Bagikan cerita teman berbulu Anda!" oninput="updateDescriptionPreview()">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-black">Unggah Gambar Kucing Imut:</label>
            <input type="file" id="image" name="image" class="w-full p-2 bg-gray-100 text-black rounded" accept="image/*" required onchange="previewImage(event)" aria-label="Unggah Gambar">
            <img id="imagePreview" class="mt-4 rounded" style="max-width: 300px; display:none;" alt="Preview Gambar Kucing">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buat Galeri Kucing Saya</button>
    </form>

    <!-- Preview -->
    <div class="mt-8 border-t pt-4">
        <h2 class="text-2xl font-semibold">Preview</h2>
        <p id="descriptionPreview" class="text-gray-700 mt-2">{{ old('description') }}</p>
    </div>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.style.display = 'block';
    }

    function updateDescriptionPreview() {
        const description = document.getElementById('description').value;
        document.getElementById('descriptionPreview').innerText = description || "Pratinjau akan muncul di sini."; // Provide a default message
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateDescriptionPreview();
    });
</script>
@endsection
