@extends('layouts.app')

@section('title', 'HorarioIA - Planificador Escolar con IA')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-16 pb-20 lg:pt-24 lg:pb-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="flex flex-col gap-6 max-w-2xl">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/30 text-primary text-xs font-semibold w-fit border border-blue-100 dark:border-blue-800">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        Nuevo Algoritmo IA v2.0
                    </div>
                    <h1
                        class="text-4xl lg:text-6xl font-black tracking-tight text-text-primary dark:text-white leading-[1.1]">
                        Genera horarios escolares <span class="text-primary">sin conflictos</span>
                    </h1>
                    <p class="text-lg text-text-secondary dark:text-gray-400 leading-relaxed max-w-lg">
                        Automatiza tu planificación académica con precisión IA. Gestiona profesores, grupos y
                        sesiones
                        sin esfuerzo para crear el plan semestral perfecto.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="{{ url('/sesiones') }}"
                            class="flex items-center justify-center px-6 py-3.5 text-base font-bold text-white bg-primary rounded-xl shadow-lg shadow-blue-500/20 hover:bg-primary-hover hover:-translate-y-0.5 transition-all duration-200">
                            Empezar
                        </a>
                        <button
                            class="flex items-center justify-center px-6 py-3.5 text-base font-bold text-text-primary bg-white dark:bg-surface-dark dark:text-white border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-200">
                            <span class="material-symbols-outlined mr-2 text-primary">play_circle</span>
                            Ver Demo
                        </button>
                    </div>
                </div>
                <!-- Visual -->
                <div class="relative lg:h-[480px] w-full flex items-center justify-center">
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-blue-100 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-3xl transform rotate-3 scale-95 opacity-60">
                    </div>
                    <div
                        class="relative w-full h-full bg-surface-light dark:bg-surface-dark rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col">
                        <!-- Fake Window Header -->
                        <div
                            class="h-10 border-b border-gray-100 dark:border-gray-700 flex items-center px-4 gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <!-- Mock Timetable -->
                        <div class="p-6 flex-1 overflow-hidden">
                            <div class="grid grid-cols-6 gap-4 h-full">
                                <div class="col-span-1 flex flex-col gap-4 text-xs font-medium text-gray-400 py-2">
                                    <div>08:00</div>
                                    <div>09:00</div>
                                    <div>10:00</div>
                                    <div>11:00</div>
                                    <div>12:00</div>
                                </div>
                                <div class="col-span-5 grid grid-cols-5 gap-2">
                                    <!-- Header Days -->
                                    <div class="text-xs font-semibold text-center text-gray-500">Lun</div>
                                    <div class="text-xs font-semibold text-center text-gray-500">Mar</div>
                                    <div class="text-xs font-semibold text-center text-gray-500">Mié</div>
                                    <div class="text-xs font-semibold text-center text-gray-500">Jue</div>
                                    <div class="text-xs font-semibold text-center text-gray-500">Vie</div>
                                    <!-- Mock Blocks -->
                                    <div
                                        class="bg-blue-100 dark:bg-blue-900/40 rounded p-2 text-[10px] text-blue-700 dark:text-blue-300 font-medium row-span-2">
                                        Servidor<br /><span class="opacity-70">Aula 101</span></div>
                                    <div
                                        class="bg-purple-100 dark:bg-purple-900/40 rounded p-2 text-[10px] text-purple-700 dark:text-purple-300 font-medium">
                                        Cliente<br /><span class="opacity-70">Aula 102</span></div>
                                    <div
                                        class="bg-green-100 dark:bg-green-900/40 rounded p-2 text-[10px] text-green-700 dark:text-green-300 font-medium row-span-2">
                                        Diseño<br /><span class="opacity-70">Lab 1</span></div>
                                    <div
                                        class="bg-red-100 dark:bg-red-900/40 rounded p-2 text-[10px] text-red-700 dark:text-red-300 font-medium row-span-1">
                                        Ciberseguridad<br /><span class="opacity-70">Lab 2</span></div>
                                    <!-- Replaced Empty with Ciberseguridad -->
                                    <div
                                        class="bg-orange-100 dark:bg-orange-900/40 rounded p-2 text-[10px] text-orange-700 dark:text-orange-300 font-medium">
                                        Despliegue<br /><span class="opacity-70">Aula 103</span></div>
                                    <div
                                        class="bg-gray-50 dark:bg-gray-800 rounded p-2 border border-dashed border-gray-300 dark:border-gray-700 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-gray-300 text-[16px]">add</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section -->
    <section class="py-12 bg-white dark:bg-surface-dark border-y border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-text-primary dark:text-white">Cómo funciona</h2>
                <p class="text-text-secondary dark:text-gray-400 mt-2">Sigue nuestro flujo de trabajo de 4 pasos
                    para obtener tu horario perfecto.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div
                    class="group p-6 bg-background-light dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-700 transition-all hover:border-blue-200 dark:hover:border-blue-900 hover:shadow-soft">
                    <div
                        class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">person_add</span>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary dark:text-white mb-2">1. Añadir Profesores</h3>
                    <p class="text-sm text-text-secondary dark:text-gray-400">Introduce los detalles de los
                        profesores, asignaturas y restricciones de disponibilidad.</p>
                </div>
                <!-- Step 2 -->
                <div
                    class="group p-6 bg-background-light dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-700 transition-all hover:border-purple-200 dark:hover:border-purple-900 hover:shadow-soft">
                    <div
                        class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary dark:text-white mb-2">2. Crear Grupos</h3>
                    <p class="text-sm text-text-secondary dark:text-gray-400">Define grupos de estudiantes, años
                        académicos y límites de tamaño.</p>
                </div>
                <!-- Step 3 -->
                <div
                    class="group p-6 bg-background-light dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-700 transition-all hover:border-green-200 dark:hover:border-green-900 hover:shadow-soft">
                    <div
                        class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">calendar_month</span>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary dark:text-white mb-2">3. Definir Sesiones</h3>
                    <p class="text-sm text-text-secondary dark:text-gray-400">Configura sesiones de clase,
                        asignación de materias y duraciones.</p>
                </div>
                <!-- Step 4 -->
                <div
                    class="group p-6 bg-background-light dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-700 transition-all hover:border-amber-200 dark:hover:border-amber-900 hover:shadow-soft">
                    <div
                        class="w-12 h-12 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">auto_awesome</span>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary dark:text-white mb-2">4. Generación con IA</h3>
                    <p class="text-sm text-text-secondary dark:text-gray-400">Deja que nuestra IA genere el horario
                        perfecto libre de conflictos.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- System Status KPIs -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-text-primary dark:text-white">Estado del Sistema</h2>
                    <p class="text-text-secondary dark:text-gray-400 mt-1">Datos actuales en tu configuración del
                        año académico.</p>
                </div>
                <button class="text-primary text-sm font-medium hover:underline">Ver Todos los Datos</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- KPI Card 1: Teachers -->
                <div
                    class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col justify-between h-32 relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-10 text-primary">
                        <span class="material-symbols-outlined text-6xl">school</span>
                    </div>
                    <div class="text-sm font-medium text-text-secondary dark:text-gray-400">Total Profesores</div>
                    <div class="flex items-end gap-2">
                        <div class="text-4xl font-black text-text-primary dark:text-white">12</div>
                        <div class="text-green-500 text-xs font-bold mb-1.5 flex items-center">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 2
                        </div>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 h-1.5 rounded-full mt-2">
                        <div class="bg-primary h-1.5 rounded-full" style="width: 40%"></div>
                    </div>
                </div>
                <!-- KPI Card 2: Groups (Alert State) -->
                <div
                    class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-red-100 dark:border-red-900/30 shadow-sm flex flex-col justify-between h-32 relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-10 text-red-500">
                        <span class="material-symbols-outlined text-6xl">group_off</span>
                    </div>
                    <div class="text-sm font-medium text-text-secondary dark:text-gray-400">Grupos de Estudiantes
                    </div>
                    <div class="flex items-end gap-2">
                        <div class="text-4xl font-black text-text-primary dark:text-white">0</div>
                        <div
                            class="text-red-500 text-xs font-bold mb-1.5 bg-red-50 dark:bg-red-900/20 px-1.5 py-0.5 rounded">
                            Acción Requerida
                        </div>
                    </div>
                    <div
                        class="mt-2 text-xs text-red-500 hover:text-red-600 cursor-pointer font-medium flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">add_circle</span> Añadir tu primer grupo
                    </div>
                </div>
                <!-- KPI Card 3: Classrooms -->
                <div
                    class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col justify-between h-32 relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-10 text-primary">
                        <span class="material-symbols-outlined text-6xl">meeting_room</span>
                    </div>
                    <div class="text-sm font-medium text-text-secondary dark:text-gray-400">Aulas</div>
                    <div class="flex items-end gap-2">
                        <div class="text-4xl font-black text-text-primary dark:text-white">8</div>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 h-1.5 rounded-full mt-2">
                        <div class="bg-purple-500 h-1.5 rounded-full" style="width: 80%"></div>
                    </div>
                </div>
                <!-- KPI Card 4: Sessions -->
                <div
                    class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col justify-between h-32 relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-10 text-primary">
                        <span class="material-symbols-outlined text-6xl">schedule</span>
                    </div>
                    <div class="text-sm font-medium text-text-secondary dark:text-gray-400">Sesiones Definidas</div>
                    <div class="flex items-end gap-2">
                        <div class="text-4xl font-black text-text-primary dark:text-white">142</div>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 h-1.5 rounded-full mt-2">
                        <div class="bg-green-500 h-1.5 rounded-full" style="width: 65%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="mt-8 mb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/20 rounded-2xl p-10 lg:p-16 text-center border border-blue-100 dark:border-blue-800 shadow-sm">
                <h2 class="text-3xl font-bold text-text-primary dark:text-white mb-4">¿Listo para organizar el
                    semestre?</h2>
                <p class="text-lg text-text-secondary dark:text-gray-300 max-w-2xl mx-auto mb-8">
                    Deja de perder horas en planificaciones manuales. Permite que nuestra IA maneje las
                    restricciones complejas y te entregue un horario libre de conflictos en segundos.
                </p>
                <button
                    class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-hover text-white text-lg font-bold px-8 py-4 rounded-xl shadow-lg shadow-blue-500/25 transition-all hover:scale-105">
                    <span class="material-symbols-outlined">auto_fix_high</span>
                    Generar Horario con IA
                </button>
                <p class="mt-4 text-sm text-text-secondary dark:text-gray-400">
                    No se requiere tarjeta de crédito para la demo.
                </p>
            </div>
        </div>
    </section>
@endsection
