@extends('layouts.app')

@section('content')
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6"style="font-family:'rubik';">Users List</h1>
    <a href="{{ route('users.create') }}" 
       class="bg-blue-500 hover:bg-blue-700 text-white transition transform hover:scale-105 font-bold py-2 px-4 rounded mb-6 inline-block" style="font-family:'rubik';">
        Add New User
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md" style="font-family:'rubik';" >
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">ubah</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 text-gray-900">{{ $user->id }}</td>
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4 flex items-center space-x-2">
                        <a href="{{ route('users.edit', $user->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 transition transform hover:scale-105 text-white font-bold py-1 px-3 rounded">
                            Edit
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this user?');" 
                              class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 trasnsition transform hover:scale-105 text-white font-bold py-1 px-3 rounded">
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
@endsection
