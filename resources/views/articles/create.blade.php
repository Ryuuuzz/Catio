@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">Buat artikel baru</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-black">Judul artikel</label>
            <input type="text" id="title" name="title" class="w-full p-2 bg-gray-100 text-black rounded" value="{{ old('title') }}" aria-label="Judul artikel">
        </div>

        <div class="mb-4">
            <label for="body" class="block text-black">Artikel</label>
            <textarea id="body" name="body" class="w-full p-2 bg-gray-100 text-black rounded" oninput="updatePreview()" aria-label="Artikel">{{ old('body') }}</textarea>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-bold mb-2">Preview</h2>
            <div id="preview" class="p-2 border rounded bg-gray-100">{{ old('body') }}</div>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-black">Upload Gambar</label>
            <input type="file" id="image" name="image" class="w-full p-2 bg-gray-100 text-black rounded" accept="image/*" onchange="previewImage(event)" aria-label="Upload Gambar">
            <img id="imagePreview" class="mt-4 rounded" style="max-width: 300px; display:none;">
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </form>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.style.display = 'block';
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
