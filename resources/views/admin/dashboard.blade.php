@extends('layouts.app')

@section('content')


<div class="container mx-auto p-4 md:p-8 flex flex-col md:flex-row space-x-0 md:space-x-8">
    <div class="flex-1">
        <h1 class="text-3xl font-bold mb-6" style="font-family:'rubik';">List user</h1>
        <a href="{{ route('users.create') }}" 
            class="bg-blue-500 hover:bg-blue-700 text-white transition transform hover:scale-105 font-bold py-2 px-4 rounded mb-6 inline-block" 
            style="font-family:'rubik';">
            Tambah user
        </a>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-blue-200 border border-blue-200 rounded-lg shadow-md" style="font-family:'rubik';">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Nama</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Ubah</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-2 text-gray-900 text-sm">{{ $user->id }}</td>
                        <td class="px-4 py-2 text-sm">{{ $user->name }}</td>
                        <td class="px-4 py-2 text-sm">{{ $user->email }}</td>
                        <td class="px-4 py-2 flex items-center space-x-1">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" 
                                    onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 transition transform hover:scale-105 text-white font-bold py-1 px-2 rounded text-xs">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- user baru -->
    <div class="w-full md:w-1/4 bg-blue-200 p-4 rounded-sm shadow-lg mt-8 md:mt-0 hide-scrollbar">
        <h2 class="text-2xl font-bold mb-4" style="font-family:'rubik';">User baru</h2>
        <div class="overflow-y-auto max-h-96"> 
            <ul class="divide-y divide-white">
                @forelse($newUsers as $newUser)
                    <li class="py-2">
                        <p class="text-lg font-medium">{{ $newUser->name }}</p>
                        <p class="text-sm text-gray-600">Email: {{ $newUser->email }}</p>
                        <p class="text-xs text-gray-500">Bergabung pada: {{ $newUser->created_at->format('d M Y') }}</p>
                    </li>
                @empty
                    <li class="py-2 text-gray-500">No new users found.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
