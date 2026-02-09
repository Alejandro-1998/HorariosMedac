<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'HorarioIA - Planificador Escolar con IA')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#2463eb",
                        "primary-hover": "#1d4ed8",
                        "secondary-blue": "#93C5FD",
                        "background-light": "#F3F4F6",
                        "background-dark": "#111827",
                        "surface-light": "#FFFFFF",
                        "surface-dark": "#1F2937",
                        "text-primary": "#111827",
                        "text-secondary": "#4B5563",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                        sans: ["Inter", "sans-serif"],
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                    }
                },
            },
        }
    </script>
    @stack('styles')
</head>

<body
    class="font-display bg-background-light dark:bg-background-dark text-text-primary antialiased min-h-screen flex flex-col">
    <!-- Top Navigation -->
    <header
        class="sticky top-0 z-50 w-full bg-white/90 dark:bg-gray-900/90 backdrop-blur border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a class="flex items-center gap-2" href="{{ url('/') }}">
                    <div class="p-1.5 bg-blue-600/10 rounded-lg text-blue-600">
                        <span class="material-symbols-outlined">grid_view</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">HorarioIA</span>
                </a>
                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-2">
                    <a class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->is('profesores*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600 dark:text-gray-300 dark:hover:bg-gray-800/50 dark:hover:text-white' }}"
                        href="{{ url('/profesores') }}">Profesores</a>
                    <a class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->is('grupos*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600 dark:text-gray-300 dark:hover:bg-gray-800/50 dark:hover:text-white' }}"
                        href="{{ url('/grupos') }}">Grupos</a>
                    <a class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->is('sesiones*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600 dark:text-gray-300 dark:hover:bg-gray-800/50 dark:hover:text-white' }}"
                        href="{{ url('/sesiones') }}">Sesiones</a>
                    <a class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->is('horario') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600 dark:text-gray-300 dark:hover:bg-gray-800/50 dark:hover:text-white' }}"
                        href="{{ url('/horario') }}">Horario</a>
                    <a class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->is('horario-ia*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600 dark:text-gray-300 dark:hover:bg-gray-800/50 dark:hover:text-white' }}"
                        href="{{ url('/horario-ia') }}">Horario IA</a>
                </nav>
                <!-- CTA -->
                <div class="flex items-center gap-4">
                    <a href="{{ url('/horario') }}"
                        class="hidden sm:flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                        <span class="material-symbols-outlined text-[20px]">bolt</span>
                        Generar horario
                    </a>
                    <!-- Mobile menu button -->
                    <button class="md:hidden p-2 text-gray-600 hover:text-blue-600">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="grow">
        @yield('content')
    </main>

    <!-- Simple Footer -->
    <footer class="bg-surface-light dark:bg-surface-dark border-t border-gray-200 dark:border-gray-800 py-8">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-sm text-text-secondary dark:text-gray-500">
                © {{ date('Y') }} HorarioIA Inc. Todos los derechos reservados.
            </div>
            <div class="flex gap-6">
                <a class="text-sm text-text-secondary dark:text-gray-500 hover:text-primary dark:hover:text-white"
                    href="#">Política de Privacidad</a>
                <a class="text-sm text-text-secondary dark:text-gray-500 hover:text-primary dark:hover:text-white"
                    href="#">Términos de Servicio</a>
                <a class="text-sm text-text-secondary dark:text-gray-500 hover:text-primary dark:hover:text-white"
                    href="#">Soporte</a>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>

</html>