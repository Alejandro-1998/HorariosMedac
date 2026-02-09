@extends('layouts.app')

@section('title', 'HorarioIA - Centro de Generación de Horarios')

@push('styles')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet" />
    
    <!-- Schedule Theme Config -->
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
    </style>
@endpush

@section('content')
    <!-- Main Layout -->
    <div class="flex-1 w-full max-w-7xl mx-auto px-4 md:px-8 py-8 flex flex-col gap-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-2">
                <h2 class="text-3xl md:text-4xl font-black text-text-primary dark:text-white tracking-tight">Generar horario con IA</h2>
                <p class="text-text-secondary dark:text-slate-400 max-w-2xl text-base">
                    Revisa el estado de tus datos a continuación antes de iniciar el proceso de generación con IA para garantizar un horario sin conflictos. Nuestro motor valida más de 40 restricciones académicas distintas.
                </p>
            </div>
            <div class="flex items-center gap-2 text-sm text-text-secondary dark:text-slate-400 bg-surface-light dark:bg-surface-dark px-3 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 shadow-sm">
                <span class="material-symbols-outlined text-base">info</span>
                <span>Última actualización: Justo ahora</span>
            </div>
        </div>

        <!-- Data Health Dashboard Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $stats = [
                    ['label' => 'Profesores', 'value' => '42 Activos', 'icon' => 'school', 'color' => 'emerald', 'status' => 'Listo', 'status_icon' => 'check_circle'],
                    ['label' => 'Grupos de Estudiantes', 'value' => '12 Cohortes', 'icon' => 'groups', 'color' => 'blue', 'status' => 'Listo', 'status_icon' => 'check_circle'],
                    ['label' => 'Aulas', 'value' => '15 Salas', 'icon' => 'meeting_room', 'color' => 'amber', 'status' => 'Advertencia', 'status_icon' => 'warning', 'info' => 'Capacidad faltante para Sala 102'],
                    ['label' => 'Sesiones Totales', 'value' => '120 Semanales', 'icon' => 'schedule', 'color' => 'purple', 'status' => 'Listo', 'status_icon' => 'check_circle'],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="group relative flex flex-col gap-3 rounded-xl p-6 bg-surface-light dark:bg-surface-dark border @if($stat['color'] == 'amber') border-amber-200 dark:border-amber-900/50 ring-1 ring-amber-500/10 dark:ring-amber-500/20 @else border-gray-200 dark:border-gray-700 @endif shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="p-2 bg-{{ $stat['color'] }}-100 dark:bg-{{ $stat['color'] }}-900/30 text-{{ $stat['color'] }}-600 dark:text-{{ $stat['color'] }}-400 rounded-lg">
                            <span class="material-symbols-outlined">{{ $stat['icon'] }}</span>
                        </div>
                        <span class="flex items-center gap-1 text-xs font-semibold uppercase tracking-wider text-{{ $stat['color'] }}-600 dark:text-{{ $stat['color'] }}-400 bg-{{ $stat['color'] }}-50 dark:bg-{{ $stat['color'] }}-900/20 px-2 py-1 rounded-full">
                            <span class="material-symbols-outlined text-sm">{{ $stat['status_icon'] }}</span> {{ $stat['status'] }}
                        </span>
                    </div>
                    <div>
                        <p class="text-text-secondary dark:text-slate-400 text-sm font-medium">{{ $stat['label'] }}</p>
                        <p class="text-text-primary dark:text-white text-2xl font-bold">{{ $stat['value'] }}</p>
                        @isset($stat['info'])
                            <p class="text-xs text-amber-600 dark:text-amber-400 mt-1">{{ $stat['info'] }}</p>
                        @endisset
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Main Action & Status Area -->
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- LEFT COLUMN: Action Panel -->
            <div class="lg:col-span-2 flex flex-col gap-6">
                <!-- Action Card -->
                <div class="bg-surface-light dark:bg-surface-dark border border-gray-200 dark:border-gray-700 rounded-xl p-8 shadow-sm flex flex-col items-center justify-center text-center gap-6 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-transparent pointer-events-none"></div>
                    <div class="z-10 max-w-lg space-y-2">
                        <h3 class="text-xl font-bold text-text-primary dark:text-white">¿Listo para sincronizar?</h3>
                        <p class="text-text-secondary dark:text-slate-400">
                            La IA intentará resolver el horario para el <span class="font-semibold text-text-primary dark:text-white">Semestre de Otoño 2024</span>. Tiempo estimado: 2-5 minutos.
                        </p>
                    </div>
                    <div class="z-10 flex flex-col items-center gap-4 w-full max-w-sm">
                        <a href="{{ url('/horarioIA') }}"
                            class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary-hover text-white text-lg font-bold py-4 px-8 rounded-xl shadow-lg shadow-blue-500/20 transition-all transform hover:scale-[1.02] focus:ring-4 focus:ring-blue-500/30">
                            <span class="material-symbols-outlined">auto_awesome</span>
                            Generar Horario
                        </a>
                        <label class="flex items-center gap-2 text-sm text-text-secondary dark:text-slate-300 cursor-pointer select-none">
                            <input class="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4" type="checkbox" />
                            Permitir violaciones de restricciones suaves si es necesario
                        </label>
                    </div>
                </div>

                <!-- AI Constraints Footer -->
                <div class="bg-surface-light dark:bg-surface-dark border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                    <h4 class="text-sm font-semibold text-text-primary dark:text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">fact_check</span>
                        Restricciones Activas
                    </h4>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-slate-400">person_off</span>
                            <div class="text-sm">
                                <p class="font-medium text-text-primary dark:text-white">Disponibilidad del Profesor</p>
                                <p class="text-text-secondary dark:text-slate-400 text-xs">Respeta días libres y franjas preferidas.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-slate-400">chair_alt</span>
                            <div class="text-sm">
                                <p class="font-medium text-text-primary dark:text-white">Capacidad del Aula</p>
                                <p class="text-text-secondary dark:text-slate-400 text-xs">Asegura que los grupos quepan en las salas asignadas.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-slate-400">hourglass_empty</span>
                            <div class="text-sm">
                                <p class="font-medium text-text-primary dark:text-white">Minimización de Huecos</p>
                                <p class="text-text-secondary dark:text-slate-400 text-xs">Reduce horas libres entre clases.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-slate-400">repeat</span>
                            <div class="text-sm">
                                <p class="font-medium text-text-primary dark:text-white">Distribución de Asignaturas</p>
                                <p class="text-text-secondary dark:text-slate-400 text-xs">Distribuye asignaturas difíciles uniformemente.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: State Visualizations -->
            <div class="flex flex-col gap-4">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-[-8px]">Vista Previa del Estado del Sistema</p>
                
                <!-- State 1: Processing -->
                <div class="rounded-xl border border-blue-200 bg-blue-50 dark:bg-blue-900/10 dark:border-blue-800 p-5 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <h4 class="font-semibold text-text-primary dark:text-white text-sm">Procesando Solicitud</h4>
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                        </span>
                    </div>
                    <div class="flex flex-col items-center py-4">
                        <div class="w-12 h-12 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin mb-3"></div>
                        <p class="text-sm text-blue-700 dark:text-blue-300 font-medium animate-pulse">Analizando restricciones...</p>
                        <p class="text-xs text-blue-500 dark:text-blue-400 mt-1">Paso 2 de 5: Asignación de Salas</p>
                    </div>
                </div>

                <!-- State 2: Success -->
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 dark:bg-emerald-900/10 dark:border-emerald-800 p-5 flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-100 dark:bg-emerald-900/50 p-1.5 rounded-full text-emerald-600 dark:text-emerald-400">
                            <span class="material-symbols-outlined text-lg">check</span>
                        </div>
                        <h4 class="font-semibold text-emerald-900 dark:text-emerald-100 text-sm">Generación Completa</h4>
                    </div>
                    <p class="text-xs text-emerald-700 dark:text-emerald-300 leading-relaxed">
                        ¡Éxito! Se generaron 120 sesiones con 0 conflictos.
                    </p>
                    <button class="mt-1 w-full text-xs font-bold bg-white dark:bg-emerald-900 border border-emerald-200 dark:border-emerald-700 text-emerald-700 dark:text-emerald-300 py-2 rounded-lg hover:bg-emerald-50 dark:hover:bg-emerald-800 transition-colors">
                        Ver Horario
                    </button>
                </div>

                <!-- State 3: Error -->
                <div class="rounded-xl border border-rose-200 bg-rose-50 dark:bg-rose-900/10 dark:border-rose-800 p-5 flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <div class="bg-rose-100 dark:bg-rose-900/50 p-1.5 rounded-full text-rose-600 dark:text-rose-400">
                            <span class="material-symbols-outlined text-lg">error</span>
                        </div>
                        <h4 class="font-semibold text-rose-900 dark:text-rose-100 text-sm">Acción Requerida</h4>
                    </div>
                    <ul class="text-xs text-rose-700 dark:text-rose-300 space-y-1 list-disc pl-4">
                        <li>Capacidad de la sala 102 no definida.</li>
                        <li>El profesor 'Smith' no tiene asignaturas asignadas.</li>
                    </ul>
                    <button class="mt-1 w-full text-xs font-bold bg-white dark:bg-rose-900 border border-rose-200 dark:border-rose-700 text-rose-700 dark:text-rose-300 py-2 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-800 transition-colors">
                        Corregir Problemas de Datos
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
