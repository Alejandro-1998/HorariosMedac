@extends('layouts.app')

@section('title', 'HorarioIA - Horario Semanal')

@push('styles')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet" />
    
    <!-- Horario IA Theme Config -->
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
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom pattern for empty slots */
        .pattern-diagonal-lines {
            background-color: transparent;
            background-image: repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(0, 0, 0, 0.03) 5px, rgba(0, 0, 0, 0.03) 10px);
        }

        .dark .pattern-diagonal-lines {
            background-image: repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(255, 255, 255, 0.03) 5px, rgba(255, 255, 255, 0.03) 10px);
        }
    </style>
@endpush

@section('content')
    <!-- Main Content -->
    <main class="flex-1 w-full max-w-[1440px] mx-auto px-4 sm:px-6 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-2 text-sm text-text-secondary dark:text-slate-400">
                    <span class="material-symbols-outlined text-[18px]">home</span>
                    <span>/</span>
                    <span>Horarios</span>
                    <span>/</span>
                    <span class="text-primary font-medium">Vista Semanal</span>
                </div>
                <h2 class="text-3xl font-bold text-text-primary dark:text-white tracking-tight">Horario Semanal</h2>
                <p class="text-text-secondary dark:text-slate-400 mt-1">Gestiona los horarios de clase para el semestre de Primavera 2024.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <button class="flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg text-sm font-semibold text-text-secondary dark:text-slate-200 hover:bg-background-light dark:hover:bg-slate-700 transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">refresh</span>
                    Regenerar
                </button>
                <button class="flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg text-sm font-semibold text-text-secondary dark:text-slate-200 hover:bg-background-light dark:hover:bg-slate-700 transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span>
                    Exportar PDF
                </button>
                <a href="{{ url('/horario') }}" class="flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary-hover text-white rounded-lg text-sm font-bold shadow-md shadow-blue-500/20 transition-all transform hover:scale-[1.02]">
                    <span class="material-symbols-outlined text-[20px]">auto_awesome</span>
                    Generar Horario
                </a>
            </div>
        </div>

        <!-- Filters Toolbar -->
        <div class="bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-200 dark:border-slate-800 p-4 mb-6 shadow-sm flex flex-col md:flex-row items-center gap-4 justify-between">
            <div class="flex flex-wrap items-center gap-4 w-full md:w-auto">
                <div class="relative group min-w-[200px] w-full md:w-auto">
                    <label class="block text-xs font-medium text-text-secondary dark:text-slate-400 mb-1 ml-1">Grupo</label>
                    <div class="relative">
                        <select class="w-full appearance-none bg-background-light dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 text-text-primary dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5 pr-8 cursor-pointer">
                            <option>1 DAW</option>
                            <option>2 DAW</option>
                            <option>1 Marketing</option>
                            <option>2 Marketing</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-text-secondary">
                            <span class="material-symbols-outlined text-[20px]">expand_more</span>
                        </div>
                    </div>
                </div>
                <div class="relative group min-w-[200px] w-full md:w-auto">
                    <label class="block text-xs font-medium text-text-secondary dark:text-slate-400 mb-1 ml-1">Profesor</label>
                    <div class="relative">
                        <select class="w-full appearance-none bg-background-light dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 text-text-primary dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5 pr-8 cursor-pointer">
                            <option>Todos los Profesores</option>
                            <option>Javi</option>
                            <option>Dani</option>
                            <option>Virginia</option>
                            <option>Marisa</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-text-secondary">
                            <span class="material-symbols-outlined text-[20px]">expand_more</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                <div class="flex items-center gap-2 mr-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input class="sr-only peer" type="checkbox" value="" />
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary/20 dark:peer-focus:ring-primary/30 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-slate-600 peer-checked:bg-primary"></div>
                        <span class="ml-2 text-sm font-medium text-text-secondary dark:text-slate-300">Vista compacta</span>
                    </label>
                </div>
                <button class="flex items-center gap-2 px-4 py-2.5 bg-background-light dark:bg-slate-800 text-text-secondary dark:text-slate-200 rounded-lg text-sm font-semibold hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                    Mostrar horario completo
                </button>
            </div>
        </div>

        <!-- Timetable Grid -->
        <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-lg border border-gray-200 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <div class="min-w-[1000px] grid grid-cols-[100px_repeat(5,1fr)] divide-x divide-gray-200 dark:divide-slate-800 border-b border-gray-200 dark:border-slate-800">
                    <!-- Header Row -->
                    <div class="p-4 bg-background-light dark:bg-slate-800/50 flex items-center justify-center">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Hora</span>
                    </div>
                    @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $day)
                        <div class="p-4 bg-background-light dark:bg-slate-800/50 text-center">
                            <span class="text-sm font-bold text-text-secondary dark:text-slate-200 uppercase tracking-wide">{{ $day }}</span>
                        </div>
                    @endforeach

                    @php
                        $hours = [
                            ['time' => '15:00 - 16:00', 'slots' => [
                                ['subject' => 'Servidor', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'blue'],
                                ['subject' => 'Cliente', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'teal'],
                                ['subject' => 'Despliegue', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'emerald'],
                                ['subject' => 'Diseño', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'amber'],
                                ['subject' => 'Empresas', 'prof' => 'Virginia', 'room' => 'Aula 3', 'color' => 'indigo'],
                            ]],
                            ['time' => '16:00 - 17:00', 'slots' => [
                                ['subject' => 'Cliente', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'teal'],
                                ['subject' => 'Servidor', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'blue'],
                                ['subject' => 'Inglés', 'prof' => 'Marisa', 'room' => 'Aula 4', 'color' => 'purple'],
                                ['subject' => 'Despliegue', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'emerald'],
                                ['subject' => 'Diseño', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'amber'],
                            ]],
                            ['time' => '17:00 - 18:00', 'slots' => [
                                ['subject' => 'Empresas', 'prof' => 'Virginia', 'room' => 'Aula 3', 'color' => 'indigo'],
                                ['subject' => 'Inglés', 'prof' => 'Marisa', 'room' => 'Aula 4', 'color' => 'purple'],
                                ['subject' => 'Cliente', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'teal'],
                                ['subject' => 'Servidor', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'blue'],
                                ['subject' => 'Despliegue', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'emerald'],
                            ]],
                        ];

                        $break = ['time' => '18:00 - 18:30', 'label' => 'Descanso de la Mañana'];

                        $afterBreak = [
                            ['time' => '18:30 - 19:30', 'slots' => [
                                ['subject' => 'Diseño', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'amber'],
                                ['subject' => 'Despliegue', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'emerald'],
                                ['subject' => 'Empresas', 'prof' => 'Virginia', 'room' => 'Aula 3', 'color' => 'indigo'],
                                ['subject' => 'Inglés', 'prof' => 'Marisa', 'room' => 'Aula 4', 'color' => 'purple'],
                                ['subject' => 'Cliente', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'teal'],
                            ]],
                            ['time' => '19:30 - 20:30', 'slots' => [
                                ['subject' => 'Servidor', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'blue'],
                                ['subject' => 'Cliente', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'teal'],
                                ['subject' => 'Despliegue', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'emerald'],
                                ['subject' => 'Diseño', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'amber'],
                                ['subject' => 'Empresas', 'prof' => 'Virginia', 'room' => 'Aula 3', 'color' => 'indigo'],
                            ]],
                            ['time' => '20:30 - 21:30', 'slots' => [
                                ['subject' => 'Inglés', 'prof' => 'Marisa', 'room' => 'Aula 4', 'color' => 'purple'],
                                ['subject' => 'Empresas', 'prof' => 'Virginia', 'room' => 'Aula 3', 'color' => 'indigo'],
                                ['subject' => 'Servidor', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'blue'],
                                ['subject' => 'Cliente', 'prof' => 'Javi', 'room' => 'Aula 1', 'color' => 'teal'],
                                ['subject' => 'Despliegue', 'prof' => 'Dani', 'room' => 'Aula 2', 'color' => 'emerald'],
                            ]],
                        ];
                    @endphp

                    @foreach ($hours as $row)
                        @include('partials.timetable-row', ['row' => $row])
                    @endforeach

                    <!-- Break Row -->
                    <div class="p-2 flex flex-col items-center justify-center text-xs font-medium text-gray-400 bg-background-light dark:bg-slate-800/30 border-b border-gray-100 dark:border-slate-800/50">
                        {{ $break['time'] }}
                    </div>
                    <div class="col-span-5 p-2 bg-background-light dark:bg-slate-800/30 border-b border-gray-100 dark:border-slate-800/50 flex items-center justify-center">
                        <span class="text-xs font-semibold uppercase tracking-widest text-gray-400">{{ $break['label'] }}</span>
                    </div>

                    @foreach ($afterBreak as $row)
                        @include('partials.timetable-row', ['row' => $row])
                    @endforeach
                </div>
            </div>

            <!-- Legend Footer -->
            <div class="px-6 py-4 bg-background-light dark:bg-slate-800/50 border-t border-gray-200 dark:border-slate-800 flex flex-wrap items-center gap-6 text-sm">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Asignaturas:</span>
                @php
                    $legend = [
                        ['name' => 'Servidor', 'color' => 'bg-blue-500'],
                        ['name' => 'Cliente', 'color' => 'bg-teal-500'],
                        ['name' => 'Despliegue', 'color' => 'bg-emerald-500'],
                        ['name' => 'Diseño', 'color' => 'bg-amber-500'],
                        ['name' => 'Empresas', 'color' => 'bg-indigo-500'],
                        ['name' => 'Inglés', 'color' => 'bg-purple-500'],
                    ];
                @endphp
                @foreach ($legend as $item)
                    <div class="flex items-center gap-2">
                        <span class="size-3 rounded-full {{ $item['color'] }}"></span>
                        <span class="text-slate-600 dark:text-slate-300">{{ $item['name'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
