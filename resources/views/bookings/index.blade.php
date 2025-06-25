<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Reservas') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8 dark:bg-gray-900 dark:text-white">
        <h1 class="text-3xl font-bold mb-6">Mis Reservas</h1>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Listado de Reservas</h2>

            @forelse(Auth::user()->bookings as $booking)
                <div class="border-b border-gray-200 dark:border-gray-700 py-4">
                    <h3 class="text-xl font-semibold mb-1">Paquete a: {{ $booking->package->destination }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Reservado el: {{ $booking->booking_date->format('d/m/Y') }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Estado: {{ ucfirst($booking->status) }}</p>
                    <a href="{{ route('packages.show', $booking->package) }}" class="text-blue-600 dark:text-blue-400 hover:underline mt-2 inline-block">Ver Detalles del Paquete</a>
                </div>
            @empty
                <p>No tienes ninguna reserva todavía.</p>
            @endforelse

        </div>
    </div>

    @include('components.dark-mode-toggle')
</x-app-layout>

