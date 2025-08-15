@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Mi Perfil</h1>
    <p>Bienvenido, {{ Auth::user()->name }}.</p>
@endsection
