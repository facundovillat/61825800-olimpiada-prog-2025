<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacto y Soporte - TurisApp</title>
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
        <!-- Header -->
        <header class="bg-white dark:bg-dark-bg-secondary shadow-sm">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">TurisApp</a>
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="/paquetes" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Buscar Paquetes</a>
                        <a href="/paquetes/crear" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Publicar Paquete</a>
                        <a href="/como-funciona" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Cómo funciona</a>
                        <a href="/perfil" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Mi Perfil</a>
                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">Salir</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Contenido principal -->
        <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <h1 class="text-3xl font-bold mb-6 text-center text-indigo-600 dark:text-indigo-400">Contacto y Soporte</h1>
                <p class="mb-6 text-gray-700 dark:text-gray-300 text-center">
                    ¿Tienes algún problema, duda o sugerencia? Completa el siguiente formulario y nuestro equipo de TurisApp te responderá lo antes posible.
                </p>
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('contacto.enviar') }}" class="bg-white dark:bg-dark-bg-secondary shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="nombre">Nombre</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-900 leading-tight focus:outline-none focus:shadow-outline" id="nombre" name="nombre" type="text" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="email">Correo electrónico</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-900 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="mensaje">Mensaje</label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-900 leading-tight focus:outline-none focus:shadow-outline" id="mensaje" name="mensaje" rows="4" required></textarea>
                    </div>
                    <div class="flex items-center justify-center">
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Enviar
                        </button>
                    </div>
                </form>
                <div class="text-center text-gray-500 dark:text-gray-400 mt-8">
                    También puedes escribirnos a <a href="mailto:soporte@turisapp.com" class="text-indigo-600 dark:text-indigo-400 underline">soporte@turisapp.com</a>
                </div>
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
</body>
</html> 