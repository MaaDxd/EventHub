@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold">Dashboard</h1>
    <p>Bienvenido, {{ auth()->user()->name }}!</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Logout</button>
    </form>
</div>
@endsection

@include('layouts.footer')