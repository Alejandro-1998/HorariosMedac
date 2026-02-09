@extends('layouts.app')

@section('title', 'HorarioIA - Gestión de Grupos')

@push('styles')
    <!-- Custom Fonts for Groups -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    
    <!-- Groups Theme Config -->
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
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>

    <style>
        /* Custom scrollbar for side panel */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #4b5563;
        }
    </style>
@endpush

@section('content')
    <div class="flex flex-col h-[calc(100vh-64px)] w-full relative overflow-hidden">
        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto custom-scrollbar p-6 lg:p-10 pb-32">
            <div class="max-w-[1200px] mx-auto w-full flex flex-col gap-8">
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2 text-text-secondary text-sm font-medium">
                            <span class="material-symbols-outlined text-[18px]">school</span>
                            <span>Curso Académico 2023-2024</span>
                        </div>
                        <h1 class="text-text-primary dark:text-white tracking-tight text-3xl font-bold">Grupos / Cursos</h1>
                        <p class="text-text-secondary dark:text-gray-400 text-base max-w-2xl">Gestiona tus grupos académicos, asigna sesiones y define restricciones de profesores.</p>
                    </div>
                    <button id="addGroupBtn"
                        class="flex shrink-0 items-center justify-center gap-2 rounded-lg h-10 px-5 bg-surface-light dark:bg-surface-dark border border-gray-200 dark:border-gray-700 text-text-secondary dark:text-gray-200 hover:border-primary hover:text-primary dark:hover:border-primary dark:hover:text-primary transition-all shadow-sm font-semibold text-sm">
                        <span class="material-symbols-outlined text-[20px]">add</span>
                        <span>Añadir grupo</span>
                    </button>
                </div>

                <!-- Filters & Search -->
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-between bg-surface-light dark:bg-surface-dark p-2 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="relative w-full sm:w-96 group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 group-focus-within:text-primary transition-colors">search</span>
                        </div>
                        <input class="block w-full pl-10 pr-3 py-2 border-none rounded-md leading-5 bg-transparent text-text-primary dark:text-white placeholder-gray-400 focus:outline-none focus:ring-0 sm:text-sm" placeholder="Buscar grupos, asignaturas..." type="text" />
                    </div>
                    <div class="flex items-center gap-2 px-2 w-full sm:w-auto">
                        <span class="text-sm text-text-secondary font-medium whitespace-nowrap">Ordenar por:</span>
                        <select class="bg-transparent border-none text-sm font-semibold text-text-secondary dark:text-gray-300 focus:ring-0 cursor-pointer pr-8 py-1">
                            <option>Nombre (A-Z)</option>
                            <option>Sesiones</option>
                            <option>Profesores</option>
                        </select>
                    </div>
                </div>

                <!-- Groups Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @php
                        $groups = [
                            ['num' => '1', 'name' => '1 DAW', 'desc' => 'Desarrollo Aplicaciones Web', 'full_desc' => 'Primer curso del ciclo superior de Desarrollo de Aplicaciones Web.', 'sessions' => '30', 'status' => 'Completo', 'status_class' => 'bg-green-50 text-green-700 border-green-100 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800', 'status_icon' => 'check_circle', 'progress' => '100%', 'progress_color' => 'bg-green-500', 'bg_icon' => 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400'],
                            ['num' => '2', 'name' => '2 DAW', 'desc' => 'Desarrollo Aplicaciones Web', 'full_desc' => 'Segundo curso del ciclo superior de Desarrollo de Aplicaciones Web.', 'sessions' => '25', 'status' => 'En Progreso', 'status_class' => 'bg-blue-50 text-blue-700 border-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800', 'status_icon' => 'pending', 'progress' => '75%', 'progress_color' => 'bg-blue-500', 'bg_icon' => 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400'],
                            ['num' => '1', 'name' => '1 Marketing', 'desc' => 'Marketing y Publicidad', 'full_desc' => 'Primer curso del ciclo superior de Marketing y Publicidad.', 'sessions' => '20', 'status' => 'Pendiente', 'status_class' => 'bg-yellow-50 text-yellow-700 border-yellow-100 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-800', 'status_icon' => 'pending', 'progress' => '40%', 'progress_color' => 'bg-yellow-500', 'bg_icon' => 'bg-orange-50 text-orange-600 dark:bg-orange-900/20 dark:text-orange-400'],
                            ['num' => '2', 'name' => '2 Marketing', 'desc' => 'Marketing y Publicidad', 'full_desc' => 'Segundo curso del ciclo superior de Marketing y Publicidad.', 'sessions' => '15', 'status' => 'Incompleto', 'status_class' => 'bg-red-50 text-red-700 border-red-100 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800', 'status_icon' => 'warning', 'progress' => '20%', 'progress_color' => 'bg-red-500', 'bg_icon' => 'bg-teal-50 text-teal-600 dark:bg-teal-900/20 dark:text-teal-400'],
                        ];
                    @endphp

                    @foreach ($groups as $group)
                        <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] dark:shadow-none border border-gray-200 dark:border-gray-800 hover:border-primary/50 dark:hover:border-primary/50 transition-all duration-300 group cursor-pointer flex flex-col h-full">
                            <div class="p-6 flex flex-col gap-4 flex-1">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-lg {{ $group['bg_icon'] }} flex items-center justify-center font-bold text-lg">
                                            {{ $group['num'] }}
                                        </div>
                                        <div>
                                            <h3 class="text-text-primary dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">
                                                {{ $group['name'] }}
                                            </h3>
                                            <p class="text-text-secondary dark:text-gray-400 text-xs font-medium uppercase tracking-wider mt-0.5">
                                                {{ $group['desc'] }}
                                            </p>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                        <span class="material-symbols-outlined">more_vert</span>
                                    </button>
                                </div>
                                <p class="text-text-secondary dark:text-gray-300 text-sm leading-relaxed line-clamp-2">
                                    {{ $group['full_desc'] }}
                                </p>
                                <div class="mt-auto pt-4 flex flex-wrap gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-semibold">
                                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                                        {{ $group['sessions'] }} Sesiones
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md {{ $group['status_class'] }} text-xs font-semibold border">
                                        <span class="material-symbols-outlined text-[16px]">{{ $group['status_icon'] }}</span>
                                        {{ $group['status'] }}
                                    </span>
                                </div>
                            </div>
                            <div class="h-1.5 w-full bg-gray-100 dark:bg-gray-800 mt-auto rounded-b-xl overflow-hidden">
                                <div class="h-full {{ $group['progress_color'] }}" style="width: {{ $group['progress'] }}"></div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Add New Card -->
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-dashed border-gray-300 dark:border-gray-700 hover:border-primary hover:bg-gray-100 dark:hover:bg-gray-800/80 transition-all duration-300 group cursor-pointer flex flex-col items-center justify-center h-full min-h-[220px]"
                        onclick="openPanel()">
                        <div class="size-14 rounded-full bg-surface-light dark:bg-surface-dark shadow-sm flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">add</span>
                        </div>
                        <h3 class="text-text-primary dark:text-white text-lg font-bold">Añadir Nuevo Grupo</h3>
                        <p class="text-text-secondary dark:text-gray-400 text-sm mt-1">Crear una nueva clase o curso</p>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-800 rounded-lg p-4 flex gap-4 items-start">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 mt-0.5">info</span>
                    <div>
                        <h4 class="text-blue-900 dark:text-blue-100 font-semibold text-sm mb-1">Restricciones de Programación</h4>
                        <p class="text-blue-700 dark:text-blue-300 text-sm leading-relaxed">Asegúrate de que todos los grupos tengan un tutor válido asignado antes de generar el horario final. Los grupos marcados como "Vacío" serán excluidos del proceso de generación automática.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Slide-over / Side Panel -->
        <aside id="sidePanel" class="absolute inset-y-0 right-0 z-40 w-full sm:w-[450px] bg-surface-light dark:bg-surface-dark shadow-2xl border-l border-gray-200 dark:border-gray-800 transform transition-transform duration-300 ease-in-out translate-x-full flex flex-col">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                <h2 class="text-lg font-bold text-text-primary dark:text-white">Añadir Grupo</h2>
                <button id="closePanelBtn" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 rounded-full p-1 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <!-- Modal Content -->
            <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-6">
                <!-- Illustration -->
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-6 flex justify-center items-center">
                    <img alt="Abstract clean workspace illustration" class="w-full h-32 object-cover rounded-md opacity-80 mix-blend-overlay" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCbAXCkgs3VW7uy2WcOhtRz1gG1lPeahzvO1UFSsWNkF39rYZNpgjE9p4_yFMG8oT0JIrJ8T1OQjH8OgVBZ-z2KsdhgHNef2WNh6DevvYVXAMeKmDxN-c8m9Bty76nHB2v0zOJUADxq2b3le-dbVjs_VcGENRS89q_2Te7keWEwdn1U8AK9k-Sle5pfjiFE60yfxJ5zruO2o3A6aCeRpX6UHliL92VG0_2O_TBNgy5j70_zxhLfkj6RB9hfIFFsCsr7LplYjUa0YpMj" />
                </div>
                <!-- Form Fields -->
                <div class="flex flex-col gap-5">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-text-secondary dark:text-gray-300" for="group-name">Nombre del Grupo</label>
                        <input class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-surface-light dark:bg-surface-dark text-text-primary dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5" id="group-name" placeholder="e.g. 1º DAW" type="text" />
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-text-secondary dark:text-gray-300" for="group-code">Código Corto / Abreviatura</label>
                        <input class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-surface-light dark:bg-surface-dark text-text-primary dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5" id="group-code" placeholder="e.g. DAW1" type="text" />
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-text-secondary dark:text-gray-300" for="description">Descripción</label>
                        <textarea class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-surface-light dark:bg-surface-dark text-text-primary dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5 resize-none" id="description" placeholder="Introduce los detalles del curso..." rows="3"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-text-secondary dark:text-gray-300" for="shift">Turno</label>
                            <select class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-surface-light dark:bg-surface-dark text-text-primary dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5" id="shift">
                                <option>Mañana</option>
                                <option>Tarde</option>
                                <option>Noche</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-text-secondary dark:text-gray-300" for="year">Año Académico</label>
                            <select class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-surface-light dark:bg-surface-dark text-text-primary dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5" id="year">
                                <option>2023-2024</option>
                                <option>2024-2025</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 flex justify-end gap-3 bg-gray-50 dark:bg-gray-900/30">
                <button id="cancelPanelBtn" class="px-4 py-2 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">Cancelar</button>
                <button class="px-4 py-2 rounded-lg bg-primary hover:bg-primary/90 text-white text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    Guardar Grupo
                </button>
            </div>
        </aside>
        
        <!-- Overlay backdrop -->
        <div id="panelOverlay" class="fixed inset-0 bg-gray-900/20 backdrop-blur-sm z-30 transition-opacity opacity-0 hidden"></div>
    </div>

    <!-- Bottom Sticky Action Bar -->
    <div class="sticky bottom-0 z-20 w-full bg-surface-light dark:bg-surface-dark border-t border-gray-200 dark:border-gray-800 px-6 lg:px-10 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] flex items-center justify-between">
        <div class="flex items-center gap-2 text-sm text-text-secondary hidden sm:flex">
            <div class="flex -space-x-2">
                <div class="size-6 rounded-full bg-gray-200 border-2 border-white dark:border-surface-dark"></div>
                <div class="size-6 rounded-full bg-gray-300 border-2 border-white dark:border-surface-dark"></div>
                <div class="size-6 rounded-full bg-gray-400 border-2 border-white dark:border-surface-dark"></div>
            </div>
            <span class="ml-2">Estado del Sistema: <span class="text-green-600 font-medium">Listo</span></span>
        </div>
        <div class="flex gap-4 w-full sm:w-auto justify-end">
            <button class="px-6 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-text-secondary dark:text-gray-200 font-semibold text-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                Volver
            </button>
            <a href="{{ url('/aulas') }}" class="px-6 py-2.5 rounded-lg bg-primary hover:bg-primary/90 text-white font-bold text-sm shadow-md shadow-primary/20 flex items-center gap-2 transition-all hover:translate-y-[-1px]">
                Continuar a aulas
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const addGroupBtn = document.getElementById('addGroupBtn');
        const closePanelBtn = document.getElementById('closePanelBtn');
        const cancelPanelBtn = document.getElementById('cancelPanelBtn');
        const sidePanel = document.getElementById('sidePanel');
        const panelOverlay = document.getElementById('panelOverlay');

        function openPanel() {
            panelOverlay.classList.remove('hidden');
            void panelOverlay.offsetWidth;
            panelOverlay.classList.remove('opacity-0');
            sidePanel.classList.remove('translate-x-full');
        }

        function closePanel() {
            sidePanel.classList.add('translate-x-full');
            panelOverlay.classList.add('opacity-0');
            setTimeout(() => {
                panelOverlay.classList.add('hidden');
            }, 300);
        }

        if(addGroupBtn) addGroupBtn.addEventListener('click', openPanel);
        if(closePanelBtn) closePanelBtn.addEventListener('click', closePanel);
        if(cancelPanelBtn) cancelPanelBtn.addEventListener('click', closePanel);
        if(panelOverlay) panelOverlay.addEventListener('click', closePanel);
    </script>
@endpush
