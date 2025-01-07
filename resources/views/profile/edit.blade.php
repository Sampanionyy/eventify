@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">
    <h1 class="text-4xl font-bold text-gray-900 mt-6 mb-4">Modifier votre profil</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('POST')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name', $user->name) }}" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm @error('name') border-red-500 @enderror"
            >
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email', $user->email) }}" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm @error('email') border-red-500 @enderror"
            >
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm @error('password') border-red-500 @enderror"
            >
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm"
            >
        </div>

        <div class="mt-6">
            <button 
                type="submit" 
                class="w-full bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-700"
            >
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection
