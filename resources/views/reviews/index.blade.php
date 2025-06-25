<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reseñas') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8 dark:bg-gray-900 dark:text-white">
        <h1 class="text-3xl font-bold mb-6">Reseñas de Paquetes</h1>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Listado de Reseñas</h2>

            @forelse($reviews as $review)
                <div class="border-b border-gray-200 dark:border-gray-700 py-4 last:border-b-0">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-semibold">{{ $review->user->name }}</h3>
                        <span class="text-gray-600 dark:text-gray-400 text-sm">Calificación: {{ $review->rating }} / 5</span>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Paquete:</strong> <a href="{{ route('packages.show', $review->package) }}" class="text-blue-600 hover:underline">{{ $review->package->destination }}</a></p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">{{ $review->comment }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $review->created_at->format('d/m/Y') }}</p>
                </div>
            @empty
                <p>Todavía no hay reseñas.</p>
            @endforelse

        </div>
    </div>

    @include('components.dark-mode-toggle')
</x-app-layout>

@include('components.footer') 