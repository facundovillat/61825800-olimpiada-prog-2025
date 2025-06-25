<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Buscar Paquetes - TurisApp</title>
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
        <div class="relative min-h-screen">
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
            <header class="bg-white dark:bg-dark-bg-secondary shadow-sm relative">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
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
                            <!-- Icono de carrito -->
                            <button id="cart-btn" class="relative ml-4 p-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5-9V6a2 2 0 10-4 0v7m4 0H9" />
                                </svg>
                                <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-xs rounded-full px-1.5 py-0.5">0</span>
                            </button>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Contenido principal -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <!-- Filtros y búsqueda -->
                <div class="mb-8">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" placeholder="Buscar paquetes por destino, hotel o palabra clave" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-dark-bg-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div class="flex gap-4">
                            <select class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-dark-bg-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Categoría</option>
                                <option value="playa">Playa</option>
                                <option value="montana">Montaña</option>
                                <option value="ciudad">Ciudad</option>
                                <option value="aventura">Aventura</option>
                            </select>
                            <select class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-dark-bg-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Origen</option>
                                <option value="buenos-aires">Buenos Aires</option>
                                <option value="cordoba">Córdoba</option>
                                <option value="rosario">Rosario</option>
                                <option value="mendoza">Mendoza</option>
                            </select>
                            <button class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Listado de paquetes -->
                <div class="grid grid-cols-1 gap-6">
                    @forelse ($packages as $package)
                        <div class="bg-white dark:bg-dark-bg-secondary rounded-lg shadow-md p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $package->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ Str::limit($package->description, 150) }}</p>
                                    <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            Destino: {{ $package->destination }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            Duración: {{ $package->duration }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">${{ number_format($package->price, 2, ',', '.') }}</div>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    @if ($package->includes_flights)
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-sm">Vuelos Incluidos</span>
                                    @endif
                                     @if ($package->includes_hotel)
                                        <span class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm">Hotel Incluido</span>
                                    @endif
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 rounded-full text-sm">{{ $package->category->name ?? 'Categoría' }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('packages.show', $package->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Ver Paquete</a>
                                    <button class="add-to-cart-btn inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700" data-id="{{ $package->id }}" data-title="{{ $package->title }}" data-price="{{ $package->price }}">Agregar al carrito</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-dark-bg-secondary rounded-lg shadow-md p-6 text-center text-gray-600 dark:text-gray-400">
                            No se encontraron paquetes que coincidan con tu búsqueda.
                        </div>
                    @endforelse
                </div>

                <!-- Paginación -->
                <div class="mt-8 flex justify-center">
                    {{-- Aquí iría la paginación si usas ->paginate() en el controlador --}}
                    {{-- Ejemplo: {{ $packages->links() }} --}}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-dark-bg-secondary mt-12">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Institucional</h4>
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
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Para Agencias</h4>
                            <ul class="space-y-2">
                                @auth
                                    @if(auth()->user()->role === 'jefe de venta')
                                        <li><a href="/paquetes/crear" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">Publicar Paquete</a></li>
                                    @endif
                                @endauth
                                <li><a href="/precios" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">Planes y precios</a></li>
                                <li><a href="/ayuda" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">Centro de ayuda</a></li>
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
                            &copy; 2024 TurisApp. Todos los derechos reservados.
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Modal flotante del carrito -->
        <div id="cart-modal" class="fixed top-0 right-0 z-50 w-full h-full bg-black bg-opacity-40 flex items-start justify-end hidden">
            <div class="bg-white dark:bg-dark-bg-secondary w-full max-w-md h-full shadow-lg p-6 flex flex-col relative animate-slide-in">
                <button id="close-cart" class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl">&times;</button>
                <h3 class="text-2xl font-bold mb-4 text-indigo-600 dark:text-indigo-400">Tu Carrito</h3>
                <div id="cart-items" class="flex-1 overflow-y-auto mb-4"></div>
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-semibold text-lg">Total:</span>
                        <span id="cart-total" class="text-xl font-bold text-indigo-600 dark:text-indigo-400">$0.00</span>
                    </div>
                    @auth
                    <button id="checkout-btn" class="w-full py-3 rounded-md bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">Terminar de pagar</button>
                    @else
                    <button class="w-full py-3 rounded-md bg-gray-400 text-white font-semibold cursor-not-allowed" disabled>Inicia sesión para comprar</button>
                    <p class="text-red-500 text-center mt-2">Debes <a href='/login' class='underline'>iniciar sesión</a> o <a href='/registro' class='underline'>registrarte</a> para comprar.</p>
                    @endauth
                </div>
            </div>
        </div>
        <!-- Modal flotante de pago -->
        <div id="checkout-modal" class="fixed top-0 left-0 z-50 w-full h-full bg-black bg-opacity-40 flex items-center justify-center hidden">
            <div class="bg-white dark:bg-dark-bg-secondary w-full max-w-sm p-8 rounded-lg shadow-lg relative animate-fade-in">
                <button id="close-checkout" class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl">&times;</button>
                <h3 class="text-2xl font-bold mb-6 text-indigo-600 dark:text-indigo-400">Pago</h3>
                <form id="payment-form">
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 mb-2">Nombre en la tarjeta</label>
                        <input type="text" name="card_name" required class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-dark-bg-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 mb-2">Número de tarjeta</label>
                        <input type="text" name="card_number" maxlength="19" required class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-dark-bg-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="flex gap-4 mb-6">
                        <div class="flex-1">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">Expira</label>
                            <input type="text" name="card_expiry" maxlength="5" placeholder="MM/AA" required class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-dark-bg-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div class="flex-1">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">CVC</label>
                            <input type="text" name="card_cvc" maxlength="4" required class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-dark-bg-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                    <button type="submit" class="w-full py-3 rounded-md bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">Pagar</button>
                </form>
            </div>
        </div>
        <!-- Modal flotante de éxito -->
        <div id="success-modal" class="fixed top-0 left-0 z-50 w-full h-full bg-black bg-opacity-40 flex items-center justify-center hidden">
            <div class="bg-white dark:bg-dark-bg-secondary w-full max-w-sm p-8 rounded-lg shadow-lg relative animate-fade-in text-center">
                <h3 class="text-2xl font-bold mb-4 text-green-600 dark:text-green-400">¡Pago realizado!</h3>
                <p class="mb-6 text-gray-700 dark:text-gray-300">Tu compra fue exitosa. Pronto recibirás la confirmación de tu reserva.</p>
                <button id="close-success" class="w-full py-3 rounded-md bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">Cerrar</button>
            </div>
        </div>
        <style>
            .animate-slide-in { animation: slideIn 0.3s ease; }
            @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
            .animate-fade-in { animation: fadeIn 0.3s ease; }
            @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        </style>
        <script>
        // Carrito en localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const cartBtn = document.getElementById('cart-btn');
        const cartModal = document.getElementById('cart-modal');
        const cartCount = document.getElementById('cart-count');
        const cartItems = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');
        const closeCart = document.getElementById('close-cart');
        const checkoutBtn = document.getElementById('checkout-btn');
        const checkoutModal = document.getElementById('checkout-modal');
        const closeCheckout = document.getElementById('close-checkout');
        const paymentForm = document.getElementById('payment-form');
        const successModal = document.getElementById('success-modal');
        const closeSuccess = document.getElementById('close-success');

        function updateCartCount() {
            cartCount.textContent = cart.length;
        }
        function renderCart() {
            cartItems.innerHTML = '';
            let total = 0;
            if (cart.length === 0) {
                cartItems.innerHTML = '<p class="text-gray-500 dark:text-gray-400">Tu carrito está vacío.</p>';
            } else {
                cart.forEach((item, idx) => {
                    total += parseFloat(item.price);
                    cartItems.innerHTML += `
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-white">${item.title}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">$${parseFloat(item.price).toFixed(2)}</p>
                            </div>
                            <button onclick="removeFromCart(${idx})" class="text-red-500 hover:text-red-700">Eliminar</button>
                        </div>
                    `;
                });
            }
            cartTotal.textContent = `$${total.toFixed(2)}`;
        }
        function removeFromCart(idx) {
            cart.splice(idx, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            renderCart();
        }
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                const price = this.getAttribute('data-price');
                cart.push({id, title, price});
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
                renderCart();
                cartModal.classList.remove('hidden');
            });
        });
        cartBtn.addEventListener('click', () => {
            renderCart();
            cartModal.classList.remove('hidden');
        });
        closeCart.addEventListener('click', () => {
            cartModal.classList.add('hidden');
        });
        checkoutBtn.addEventListener('click', () => {
            cartModal.classList.add('hidden');
            checkoutModal.classList.remove('hidden');
        });
        closeCheckout.addEventListener('click', () => {
            checkoutModal.classList.add('hidden');
        });
        paymentForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            // Obtener datos de la tarjeta
            const cardName = paymentForm.querySelector('input[name="card_name"]').value;
            const cardNumber = paymentForm.querySelector('input[name="card_number"]').value;
            const cardExpiry = paymentForm.querySelector('input[name="card_expiry"]').value;
            const cardCvc = paymentForm.querySelector('input[name="card_cvc"]').value;
            // Preparar carrito para backend
            const cartForBackend = cart.map(item => ({
                package_id: item.id,
                quantity: 1 // Puedes ajustar si tienes cantidad en el carrito
            }));
            // Enviar datos al backend
            const response = await fetch('/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    cart: cartForBackend,
                    card_name: cardName,
                    card_number: cardNumber,
                    card_expiry: cardExpiry,
                    card_cvc: cardCvc
                })
            });
            if (response.ok) {
                checkoutModal.classList.add('hidden');
                successModal.classList.remove('hidden');
                cart = [];
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
            } else {
                const error = await response.text();
                alert('Error al procesar el pago: ' + error);
            }
        });
        closeSuccess.addEventListener('click', () => {
            successModal.classList.add('hidden');
            renderCart();
        });
        // Inicializar
        updateCartCount();
        renderCart();
        </script>
    </body>
</html> 