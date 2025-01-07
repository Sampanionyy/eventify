@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900">Liste des Catégories</h1>
        
        <a href="{{ route('categories.create') }}" class="bg-cyan-600 text-white px-6 py-3 rounded-lg mt-4 inline-block text-lg hover:bg-cyan-700 transition duration-300">
            <svg class="w-5 h-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Créer une Catégorie
        </a>

        <div class="overflow-x-auto mt-6 bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nom</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-cyan-600">
                                <a href="{{ route('categories.show', $category->id) }}" class="hover:text-cyan-700">
                                    <svg class="w-5 h-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Voir
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="ml-4 hover:text-cyan-700">
                                    <svg class="w-5 h-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 3l4 4-8 8H7v-4l8-8z" />
                                    </svg>
                                    Modifier
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 ml-4 hover:text-red-700">
                                        <svg class="w-5 h-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
