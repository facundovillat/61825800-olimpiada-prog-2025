<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Paquete') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <!-- Botón de regreso -->
        <div class="mb-6">
            <a href="{{ route('packages.index') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a la lista de paquetes
            </a>
        </div>

        <!-- Información principal del paquete -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mb-8">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $package->title }}</h1>
                        <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Destino: {{ $package->destination }}
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Publicado {{ $package->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">${{ number_format($package->price, 2, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Etiquetas -->
                <div class="flex flex-wrap gap-2 mb-6">
                    @if ($package->includes_flights)
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-sm font-medium">
                            Vuelos Incluidos
                        </span>
                    @endif
                    @if ($package->includes_hotel)
                        <span class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm font-medium">
                            Hotel Incluido
                        </span>
                    @endif
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 rounded-full text-sm font-medium">
                        {{ $package->category->name }}
                    </span>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full text-sm font-medium">
                        {{ ucfirst($package->status) }}
                    </span>
                </div>

                <!-- Descripción -->
                <div class="prose dark:prose-invert max-w-none mb-8">
                    <h2 class="text-xl font-semibold mb-4">Descripción del Paquete</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ $package->description }}</p>
                </div>

                <!-- Información detallada -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="text-lg font-semibold mb-4">Detalles del Paquete</h3>
                        <dl class="space-y-3">
                            <div class="flex justify-between">
                                <dt class="text-gray-600 dark:text-gray-400">Origen</dt>
                                <dd class="text-gray-900 dark:text-white font-medium">{{ $package->location }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600 dark:text-gray-400">Duración</dt>
                                <dd class="text-gray-900 dark:text-white font-medium">{{ $package->duration }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600 dark:text-gray-400">Fecha de publicación</dt>
                                <dd class="text-gray-900 dark:text-white font-medium">{{ $package->created_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="text-lg font-semibold mb-4">Información de la Agencia</h3>
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center">
                                <span class="text-xl font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ substr($package->user->name, 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $package->user->name }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Miembro desde {{ $package->user->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <dl class="space-y-3">
                            <div class="flex justify-between">
                                <dt class="text-gray-600 dark:text-gray-400">Paquetes publicados</dt>
                                <dd class="text-gray-900 dark:text-white font-medium">{{ $package->user->packages()->count() }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600 dark:text-gray-400">Calificación promedio</dt>
                                <dd class="text-gray-900 dark:text-white font-medium">
                                    {{-- Assuming you have a rating system on user profile --}}
                                    {{-- number_format($package->user->profile->rating ?? 0, 1) }} / 5.0 --}}
                                    N/A
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end space-x-4">
                    @if(auth()->check() && auth()->id() !== $package->user_id)
                        <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Reservar este paquete
                        </a>
                    @elseif(!auth()->check())
                        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Inicia sesión para reservar
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 