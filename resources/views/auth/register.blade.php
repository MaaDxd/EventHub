@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md mt-10">
    <h2 class="text-2xl font-bold mb-6">Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full border rounded px-3 py-2">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full border rounded px-3 py-2">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input id="password" type="password" name="password" required class="w-full border rounded px-3 py-2">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
    </form>
</div>
@endsection