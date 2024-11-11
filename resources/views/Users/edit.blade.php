@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 max-w-lg border rounded bg-white shadow-lg">
    <h1 class="text-3xl font-bold mb-6">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name', $user->name) }}"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <!-- <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" 
                   value="{{ old('email', $user->email) }}"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div> -->



        <!-- Submit -->
        <div class="flex justify-between items-center">
            <a href="{{ route('users.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded transition transform hover:scale-105">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded transition transform hover:scale-105">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
