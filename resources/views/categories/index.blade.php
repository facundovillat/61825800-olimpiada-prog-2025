<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorías de Paquetes') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8 dark:bg-gray-900 dark:text-white">
        <h1 class="text-3xl font-bold mb-6">Categorías de Paquetes</h1>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Listado de Categorías</h2>

            @forelse($categories as $category)
                <div class="border-b border-gray-200 dark:border-gray-700 py-4 last:border-b-0">
                    <h3 class="text-xl font-semibold mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">{{ $category->packages->count() }} paquetes en esta categoría</p>
                    <a href="{{ route('packages.index', ['category' => $category->id]) }}" class="text-blue-600 dark:text-blue-400 hover:underline mt-2 inline-block">Ver Paquetes en esta Categoría</a>
                </div>
            @empty
                <p>No hay categorías disponibles en este momento.</p>
            @endforelse

        </div>
    </div>

    @include('components.dark-mode-toggle')
</x-app-layout>

@include('components.footer') 