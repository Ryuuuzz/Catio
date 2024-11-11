@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">Tempat sampah artikel</h1>

    @if ($trashedArticles->isEmpty())
        <p class="text-gray-600">Tidak menemukan artikel yang di hapus.</p>
    @else
        <div class="overflow-hidden shadow rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Di hapus pada</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kembalikan/Hapus permanen</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($trashedArticles as $article)
                        <tr>
                            <td class="py-4 px-4 text-sm text-gray-800">{{ $article->title }}</td>
                            <td class="py-4 px-4 text-sm text-gray-600">{{ $article->deleted_at->format('F j, Y, g:i a') }}</td>
                            <td class="py-4 px-4 text-sm font-medium">
                                <form action="{{ route('articles.restore', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="text-white bg-green-400 hover:bg-green-600 p-1 rounded transition duration-150">Kembalikan</button>
                                </form>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" bg-red-500 hover:bg-red-600 text-white p-1 rounded transition duration-150">Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $trashedArticles->links() }} 
        </div>
    @endif
</div>
@endsection
