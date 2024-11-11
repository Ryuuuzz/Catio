@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Tempat sampah galleries</h1>

    @if ($trashedGalleries->isEmpty())
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Tidak ada sampah gallery.</strong>
        </div>
    @else
        <div class="overflow-hidden shadow sm:rounded-lg">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dihapus pada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kembalikan/Hapus secara permanen</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($trashedGalleries as $gallery)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $gallery->title }}</td>
                                <td class="py-4 px-4 text-sm text-gray-600">{{ $gallery->deleted_at->format('F j, Y, g:i a') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ Str::limit($gallery->description, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if ($gallery->image)
                                        <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" class="w-24 h-auto">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('gallery.restore', $gallery->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded">Kembalikan</button>
                                    </form>
                                    <form action="{{ route('gallery.forceDelete', $gallery->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Hapus secara permanen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{ $trashedGalleries->links() }} 
    @endif
</div>
@endsection
