@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-900">Détails de la Catégorie</h1>

        <div class="mt-6 bg-white p-6 shadow-md rounded-lg">
            <p><strong>Nom :</strong> {{ $category->name }}</p>
            <div class="mt-4">
                <a href="{{ route('categories.index') }}" class="bg-cyan-600 text-white px-4 py-2 rounded">Retour</a>
            </div>
        </div>
    </div>
@endsection
