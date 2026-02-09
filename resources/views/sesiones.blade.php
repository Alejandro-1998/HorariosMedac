@extends('layouts.app')

@section('title', 'HorarioIA - Gestión de Sesiones')

@push('styles')
    <!-- Custom Fonts for Sessions -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&amp;family=Noto+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    
    <!-- Purple Theme Config -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#6324eb",
                        "primary-dark": "#4c1aa3",
                        "primary-light": "#8b5cf6",
                        "background-light": "#f6f6f8",
                        "background-dark": "#161121",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e1a2e",
                        "text-main": "#120e1b",
                        "text-secondary": "#654d99",
                        "border-light": "#ebe7f3",
                        "border-dark": "#2d2a3b",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "0.75rem", "xl": "1rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Lexend', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { height: 8px; width: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #d1d5db; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #9ca3af; }
    </style>
@endpush

@section('content')
    <main class="flex-1 w-full max-w-[1440px] mx-auto p-6 md:p-8 lg:px-12 flex flex-col gap-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="flex flex-col gap-2 max-w-2xl">
                <div class="flex items-center gap-2 text-sm text-text-secondary dark:text-gray-400 font-medium">
                    <span class="material-symbols-outlined text-lg">school</span>
                    <span>Curso Académico 2024-2025</span>
                    <span class="mx-1">•</span>
                    <span class="text-primary dark:text-primary-light">Trimestre 1</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-text-main dark:text-white">Sesiones por Programar</h2>
                <p class="text-text-secondary dark:text-gray-400 text-base md:text-lg leading-relaxed">
                    Gestiona y verifica todas las sesiones lectivas antes de generar el horario final con IA.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="h-11 px-5 rounded-lg border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark text-text-main dark:text-white font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors flex items-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">upload_file</span>
                    <span>Importar CSV</span>
                </button>
                <button
                    class="h-11 px-6 rounded-lg bg-primary hover:bg-primary-dark text-white font-semibold shadow-lg shadow-primary/25 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    <span>Añadir sesión</span>
                </button>
            </div>
        </div>
        
        <!-- Main Content Area -->
        <div class="grid lg:grid-cols-[1fr_320px] gap-8 items-start">
            <!-- Left Column: Data Table -->
            <div class="flex flex-col gap-6 w-full min-w-0">
                <!-- Filters & Search -->
                <div class="bg-surface-light dark:bg-surface-dark p-4 rounded-xl border border-border-light dark:border-border-dark flex flex-wrap gap-4 items-center justify-between shadow-sm">
                    <div class="relative flex-1 min-w-[240px] max-w-md">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                        <input
                            class="w-full pl-10 pr-4 h-10 bg-background-light dark:bg-background-dark border-transparent focus:border-primary focus:ring-primary rounded-lg text-sm text-text-main dark:text-white placeholder-gray-400 transition-all"
                            placeholder="Buscar sesiones por grupo, asignatura o profesor..." type="text" />
                    </div>
                    <div class="flex items-center gap-3">
                        <select class="h-10 pl-3 pr-8 bg-background-light dark:bg-background-dark border-transparent rounded-lg text-sm font-medium text-text-main dark:text-white focus:ring-primary cursor-pointer">
                            <option>Todos los Departamentos</option>
                            <option>Ciencias</option>
                            <option>Humanidades</option>
                            <option>Artes</option>
                        </select>
                        <button class="size-10 flex items-center justify-center rounded-lg bg-background-light dark:bg-background-dark hover:bg-gray-200 dark:hover:bg-gray-700 text-text-secondary dark:text-gray-400 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">filter_list</span>
                        </button>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-xl shadow-sm overflow-hidden flex flex-col">
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full min-w-[800px] text-left border-collapse">
                            <thead>
                                <tr class="bg-background-light/50 dark:bg-surface-dark border-b border-border-light dark:border-border-dark">
                                    <th class="p-4 pl-6 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider w-[120px]">Grupo</th>
                                    <th class="p-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Asignatura</th>
                                    <th class="p-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Profesor</th>
                                    <th class="p-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider w-[120px]">Horas/Sem</th>
                                    <th class="p-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aula Preferida</th>
                                    <th class="p-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider text-center w-[100px]">Estado</th>
                                    <th class="p-4 pr-6 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider text-right w-[120px]">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-light dark:divide-border-dark text-sm">
                                @php
                                    $rows = [
                                        ['grupo' => 'Grupo A', 'asignatura' => 'Servidor', 'color' => 'bg-blue-500', 'prof' => 'Dr. Smith', 'horas' => '4h', 'aula' => 'Lab 1', 'aulaIcon' => 'science', 'aulaColor' => 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300'],
                                        ['grupo' => 'Grupo B', 'asignatura' => 'Cliente', 'color' => 'bg-amber-500', 'prof' => 'Prof. Doe', 'horas' => '3h', 'aula' => 'Aula 101', 'aulaIcon' => 'meeting_room', 'aulaColor' => 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300'],
                                        ['grupo' => 'Grupo A', 'asignatura' => 'Diseño', 'color' => 'bg-blue-500', 'prof' => 'Dr. Albert', 'horas' => '4h', 'aula' => 'Lab 2', 'aulaIcon' => 'science', 'aulaColor' => 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300', 'status' => 'warning'],
                                        ['grupo' => 'Grupo C', 'asignatura' => 'Despliegue', 'color' => 'bg-pink-500', 'prof' => 'Prof. Curie', 'horas' => '3h', 'aula' => 'Lab 3', 'aulaIcon' => 'science', 'aulaColor' => 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300'],
                                        ['grupo' => 'Grupo B', 'asignatura' => 'Ciberseguridad', 'color' => 'bg-amber-500', 'prof' => 'Prof. Shakespeare', 'horas' => '3h', 'aula' => 'Aula 102', 'aulaIcon' => 'meeting_room', 'aulaColor' => 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300'],
                                        ['grupo' => 'Grupo A', 'asignatura' => 'Empresas', 'color' => 'bg-purple-500', 'prof' => 'Prof. Business', 'horas' => '3h', 'aula' => 'Aula 103', 'aulaIcon' => 'meeting_room', 'aulaColor' => 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300'],
                                        ['grupo' => 'Grupo B', 'asignatura' => 'Inglés', 'color' => 'bg-indigo-500', 'prof' => 'Prof. Shakespeare', 'horas' => '2h', 'aula' => 'Aula 104', 'aulaIcon' => 'meeting_room', 'aulaColor' => 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300'],
                                    ];
                                @endphp

                                @foreach ($rows as $row)
                                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                        <td class="p-4 pl-6 font-semibold text-text-main dark:text-white">{{ $row['grupo'] }}</td>
                                        <td class="p-4 font-medium text-text-main dark:text-gray-200">
                                            <div class="flex items-center gap-2">
                                                <div class="size-2 rounded-full {{ $row['color'] }}"></div>
                                                {{ $row['asignatura'] }}
                                            </div>
                                        </td>
                                        <td class="p-4 text-text-secondary dark:text-gray-400">{{ $row['prof'] }}</td>
                                        <td class="p-4 font-medium text-text-main dark:text-white">{{ $row['horas'] }}</td>
                                        <td class="p-4">
                                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md {{ $row['aulaColor'] }} text-xs font-medium border border-purple-100 dark:border-purple-800">
                                                <span class="material-symbols-outlined text-[14px]">{{ $row['aulaIcon'] }}</span>
                                                {{ $row['aula'] }}
                                            </div>
                                        </td>
                                        <td class="p-4 text-center">
                                            @if ($row['status'] ?? '' === 'warning')
                                                <span class="inline-flex items-center justify-center size-6 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400" title="Advertencia de carga docente">
                                                    <span class="material-symbols-outlined text-[16px]">warning</span>
                                                </span>
                                            @else
                                                <span class="inline-flex items-center justify-center size-6 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400" title="Validado">
                                                    <span class="material-symbols-outlined text-[16px]">check</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4 pr-6 text-right">
                                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button class="p-1.5 text-gray-400 hover:text-primary transition-colors rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                                </button>
                                                <button class="p-1.5 text-gray-400 hover:text-red-500 transition-colors rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="flex items-center justify-between p-4 border-t border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark">
                        <span class="text-sm text-text-secondary dark:text-gray-400">Mostrando 1 a 7 de 24 entradas</span>
                        <div class="flex items-center gap-1">
                            <button class="size-8 flex items-center justify-center rounded-md border border-border-light dark:border-border-dark text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 disabled:opacity-50" disabled="">
                                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                            </button>
                            <button class="size-8 flex items-center justify-center rounded-md bg-primary text-white text-sm font-medium">1</button>
                            <button class="size-8 flex items-center justify-center rounded-md border border-border-light dark:border-border-dark text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 text-sm font-medium">2</button>
                            <button class="size-8 flex items-center justify-center rounded-md border border-border-light dark:border-border-dark text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 text-sm font-medium">3</button>
                            <button class="size-8 flex items-center justify-center rounded-md border border-border-light dark:border-border-dark text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800">
                                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Validation Rules (Moved below table for better mobile flow) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex gap-4 p-5 rounded-xl border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark shadow-sm">
                        <div class="size-12 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h3 class="text-text-main dark:text-white font-bold text-base">Carga Docente</h3>
                            <p class="text-text-secondary dark:text-gray-400 text-sm leading-relaxed">Los profesores no pueden exceder 20 horas semanales. La IA marcará cualquier sobreasignación.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-5 rounded-xl border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark shadow-sm">
                        <div class="size-12 rounded-full bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                            <span class="material-symbols-outlined">meeting_room</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h3 class="text-text-main dark:text-white font-bold text-base">Capacidad del Aula</h3>
                            <p class="text-text-secondary dark:text-gray-400 text-sm leading-relaxed">Las clases de más de 30 estudiantes se asignan automáticamente a aulas grandes.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Add Session Sidebar -->
            <aside class="sticky top-24 w-full lg:w-[320px] bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-xl shadow-lg flex flex-col overflow-hidden">
                <div class="p-5 border-b border-border-light dark:border-border-dark bg-gray-50/50 dark:bg-gray-800/30">
                    <h3 class="text-lg font-bold text-text-main dark:text-white">Añadir Sesión Rápida</h3>
                    <p class="text-xs text-text-secondary dark:text-gray-400 mt-1">Añade manualmente una entrada de sesión.</p>
                </div>
                <div class="p-5 flex flex-col gap-5">
                    <!-- Form Field: Group -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-semibold text-text-main dark:text-gray-200">Grupo</label>
                        <div class="relative">
                            <select class="w-full h-10 pl-3 pr-8 rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none appearance-none">
                                <option>Selecciona un grupo...</option>
                                <option>Grupo A</option>
                                <option>Grupo B</option>
                                <option>Grupo C</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    <!-- Form Field: Subject -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-semibold text-text-main dark:text-gray-200">Asignatura</label>
                        <input class="w-full h-10 px-3 rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none" placeholder="e.g. Empresas" type="text" />
                    </div>
                    <!-- Form Field: Teacher -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-semibold text-text-main dark:text-gray-200">Profesor</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                            <input class="w-full h-10 pl-9 pr-3 rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none" placeholder="Buscar profesor..." type="text" />
                        </div>
                    </div>
                    <!-- Form Field: Hours & Room -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main dark:text-gray-200">Horas/Sem</label>
                            <input class="w-full h-10 px-3 rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none" max="10" min="1" type="number" value="2" />
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main dark:text-gray-200">Tipo de Aula</label>
                            <div class="relative">
                                <select class="w-full h-10 pl-2 pr-6 rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none appearance-none">
                                    <option>Estándar</option>
                                    <option>Laboratorio</option>
                                    <option>Conferencia</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 text-[18px] pointer-events-none">expand_more</span>
                            </div>
                        </div>
                    </div>
                    <div class="h-px w-full bg-border-light dark:bg-border-dark my-1"></div>
                    <button class="w-full h-10 rounded-lg bg-text-main dark:bg-white text-surface-light dark:text-text-main font-bold text-sm hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        Añadir a la lista
                    </button>
                </div>
            </aside>
        </div>
    </main>

    <!-- Bottom Action Bar -->
    <div class="sticky bottom-6 z-30 w-full max-w-[1440px] mx-auto px-6 md:px-12 pointer-events-none">
        <div class="pointer-events-auto bg-text-main dark:bg-surface-dark text-white rounded-xl shadow-2xl shadow-black/20 p-4 flex flex-col sm:flex-row items-center justify-between gap-4 border border-border-dark/20 backdrop-blur-md">
            <div class="flex items-center gap-4 pl-2">
                <div class="size-10 rounded-full bg-green-500/20 flex items-center justify-center text-green-400">
                    <span class="material-symbols-outlined">auto_awesome</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm sm:text-base">Listo para generar</span>
                    <span class="text-xs sm:text-sm text-gray-400">24 sesiones verificadas • 0 errores críticos</span>
                </div>
            </div>
            <a href="{{ url('/profesores') }}"
                class="w-full sm:w-auto px-6 h-12 rounded-lg bg-primary hover:bg-primary-light text-white font-bold text-base tracking-wide shadow-lg shadow-primary/30 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                <span>Continuar a Profesores</span>
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </div>
    <!-- Spacer for scrolling -->
    <div class="h-20"></div>
@endsection
