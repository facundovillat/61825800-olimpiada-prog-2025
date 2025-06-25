<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Publicar Paquete - TurisApp</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            dark: {
                                'bg-primary': '#1a1a1a',
                                'bg-secondary': '#2d2d2d',
                                'text-primary': '#ffffff',
                                'text-secondary': '#a0aec0'
                            }
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="antialiased bg-gray-50 dark:bg-dark-bg-primary transition-colors duration-200">
        <div class="relative min-h-screen flex flex-col">
            <!-- Botón de modo oscuro -->
            <button id="theme-toggle" class="fixed bottom-4 right-4 p-3 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 z-50">
                <svg id="sun-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <svg id="moon-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
            </button>

            <!-- Header -->
            <header class="bg-white dark:bg-dark-bg-secondary shadow-sm">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="/" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">TurisApp</a>
                        </div>
                        <div class="flex items-center space-x-6">
                            <a href="/paquetes" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Buscar Paquetes</a>
                            @auth
                                @if(Auth::user()->role === 'jefe de ventas')
                                    <a href="{{ route('sales_manager.orders.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Acceder al Panel</a>
                                @endif
                            @endauth
                            <a href="/como-funciona" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Cómo funciona</a>
                            @guest
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Ingresar
                                </a>
                            @else
                                <a href="/perfil" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Mi Perfil
                                </a>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                        Salir
                                    </button>
                                </form>
                            @endguest
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Contenido principal -->
            <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl w-full space-y-8">
                    <div>
                        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                            Publica un nuevo paquete turístico
                        </h2>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">¡Ups! Ha habido un problema al publicar el paquete:</strong>
                            <ul class="mt-3 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">¡Éxito!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form class="mt-8 space-y-6" action="{{ route('packages.store') }}" method="POST">
                        @csrf
                        <div class="rounded-md shadow-sm space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título del Paquete</label>
                                <input id="title" name="title" type="text" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-dark-bg-secondary dark:text-white dark:placeholder-gray-400 dark:border-gray-600" placeholder="Ej: Paquete a Cancún 7 días / 6 noches" value="{{ old('title') }}">
                            </div>
                            <div>
                                <label for="destination" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Destino</label>
                                <input id="destination" name="destination" type="text" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-dark-bg-secondary dark:text-white dark:placeholder-gray-400 dark:border-gray-600" placeholder="Ej: Cancún, México" value="{{ old('destination') }}">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                                <textarea id="description" name="description" rows="6" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-dark-bg-secondary dark:text-white dark:placeholder-gray-400 dark:border-gray-600" placeholder="Describe los detalles del paquete, qué incluye, el itinerario, etc.">{{ old('description') }}</textarea>
                            </div>
                             <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Duración</label>
                                    <input id="duration" name="duration" type="text" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-dark-bg-secondary dark:text-white dark:placeholder-gray-400 dark:border-gray-600" placeholder="Ej: 7 días / 6 noches" value="{{ old('duration') }}">
                                </div>
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lugar de Origen</label>
                                    <input id="location" name="location" type="text" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-dark-bg-secondary dark:text-white dark:placeholder-gray-400 dark:border-gray-600" placeholder="Ej: Buenos Aires, Argentina" value="{{ old('location') }}">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                                    <select id="category_id" name="category_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-dark-bg-secondary dark:text-white dark:border-gray-600">
                                        <option value="">Selecciona una categoría</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio (USD)</label>
                                    <input id="price" name="price" type="number" step="0.01" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-dark-bg-secondary dark:text-white dark:placeholder-gray-400 dark:border-gray-600" placeholder="Ej: 1500.00" value="{{ old('price') }}">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                             <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="includes_flights" name="includes_flights" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded dark:bg-dark-bg-secondary dark:border-gray-600" value="1" {{ old('includes_flights') ? 'checked' : '' }}>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="includes_flights" class="font-medium text-gray-700 dark:text-gray-300">¿Incluye Vuelos?</label>
                                </div>
                            </div>
                             <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="includes_hotel" name="includes_hotel" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded dark:bg-dark-bg-secondary dark:border-gray-600" value="1" {{ old('includes_hotel') ? 'checked' : '' }}>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="includes_hotel" class="font-medium text-gray-700 dark:text-gray-300">¿Incluye Hotel?</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Publicar Paquete
                            </button>
                        </div>
                    </form>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-dark-bg-secondary mt-12">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Acerca</h4>
                            <ul class="space-y-2">
                                <li><a href="/sobre-nosotros" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">¿Quiénes somos?</a></li>
                                <li><a href="/contacto" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">Contacto</a></li>
                                <li><a href="/terminos" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">Términos y condiciones</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Para Viajeros</h4>
                            <ul class="space-y-2">
                                <li><a href="/como-funciona" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">Cómo funciona</a></li>
                                <li><a href="/paquetes" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">Buscar Paquetes</a></li>
                                <li><a href="/perfil" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">Mi perfil</a></li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Síguenos</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                    <span class="sr-only">Twitter</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                    <span class="sr-only">Instagram</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-center text-gray-500 dark:text-gray-400">
                            &copy; 2025 TurisApp. Todos los derechos reservados.
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            // Función para manejar el cambio de tema
            function toggleTheme() {
                const html = document.documentElement;
                const sunIcon = document.getElementById('sun-icon');
                const moonIcon = document.getElementById('moon-icon');

                if (html.classList.contains('dark')) {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                }
            }

            // Inicializar el tema
            document.addEventListener('DOMContentLoaded', () => {
                const theme = localStorage.getItem('theme') || 'dark';
                const html = document.documentElement;
                const sunIcon = document.getElementById('sun-icon');
                const moonIcon = document.getElementById('moon-icon');

                if (theme === 'dark') {
                    html.classList.add('dark');
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                } else {
                    html.classList.remove('dark');
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                }

                // Agregar evento al botón
                document.getElementById('theme-toggle').addEventListener('click', toggleTheme);
            });
        </script>
    </body>
</html> 