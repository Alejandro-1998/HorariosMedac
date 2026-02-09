@extends('layouts.app')

@section('title', 'HorarioIA - Gestión de Profesores')

@push('styles')
    <!-- Custom Fonts for Professors -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet" />
    
    <!-- Professors Theme Config -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2667f2",
                        "primary-dark": "#1a4bbd",
                        "background-light": "#f3f4f6",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.375rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
@endpush

@section('content')
    <div class="flex flex-col h-[calc(100vh-64px)] w-full relative"> {{-- Adjusted height for navbar --}}
        <!-- Main Layout -->
        <main class="flex-1 flex overflow-hidden relative z-0">
            <!-- Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
                <div class="max-w-7xl w-full mx-auto px-6 py-8">
                    <!-- Page Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Profesores</h1>
                            <p class="text-slate-500 dark:text-slate-400 mt-1">Gestiona tu personal académico y sus asignaturas.</p>
                        </div>
                        <button id="addProfessorBtn"
                            class="flex items-center justify-center rounded-lg h-10 px-5 bg-primary hover:bg-primary-dark text-white text-sm font-semibold shadow-sm shadow-blue-500/30 transition-all active:scale-95">
                            <span class="material-symbols-outlined text-xl mr-1.5">add</span>
                            Añadir profesor
                        </button>
                    </div>

                    <!-- Filters / Search Bar -->
                    <div class="flex gap-3 mb-6">
                        <div class="relative flex-1 max-w-md">
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">search</span>
                            <input
                                class="w-full pl-10 pr-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 text-slate-900 dark:text-white shadow-sm"
                                placeholder="Buscar por nombre o asignatura..." type="text" />
                        </div>
                        <button
                            class="px-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 flex items-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-lg">filter_list</span>
                            Filtrar
                        </button>
                    </div>

                    <!-- Main Data Table -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50/50 dark:bg-slate-800/50 border-b border-gray-200 dark:border-gray-700">
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-1/4">Nombre del Profesor</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-1/3">Asignaturas Impartidas</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-1/4">Sesiones Asignadas</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @php
                                        $professors = [
                                            ['name' => 'Javi', 'init' => 'JA', 'type' => 'Tiempo completo', 'subjects' => [['name' => 'Servidor', 'class' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300'], ['name' => 'Cliente', 'class' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300']], 'sessions' => '16/20', 'percent' => '80%', 'color' => 'bg-green-500', 'avatar_bg' => 'bg-blue-100', 'avatar_text' => 'text-blue-600'],
                                            ['name' => 'Dani', 'init' => 'DA', 'type' => 'Tiempo completo', 'subjects' => [['name' => 'Despliegue', 'class' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300'], ['name' => 'Diseño', 'class' => 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-300']], 'sessions' => '18/20', 'percent' => '90%', 'color' => 'bg-amber-500', 'avatar_bg' => 'bg-purple-100', 'avatar_text' => 'text-purple-600'],
                                            ['name' => 'Virginia', 'init' => 'VI', 'type' => 'Tiempo completo', 'subjects' => [['name' => 'Empresas', 'class' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300']], 'sessions' => '10/20', 'percent' => '50%', 'color' => 'bg-green-500', 'avatar_bg' => 'bg-teal-100', 'avatar_text' => 'text-teal-600'],
                                            ['name' => 'Marisa', 'init' => 'MA', 'type' => 'Tiempo parcial', 'subjects' => [['name' => 'Inglés', 'class' => 'bg-gray-100 text-gray-800 dark:bg-slate-600 dark:text-slate-200']], 'sessions' => '8/20', 'percent' => '40%', 'color' => 'bg-green-500', 'avatar_bg' => 'bg-indigo-100', 'avatar_text' => 'text-indigo-600'],
                                        ];
                                    @endphp

                                    @foreach ($professors as $prof)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors group">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-10 w-10 rounded-full {{ $prof['avatar_bg'] }} flex items-center justify-center {{ $prof['avatar_text'] }} font-bold text-sm">
                                                        {{ $prof['init'] }}
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-slate-900 dark:text-white">{{ $prof['name'] }}</p>
                                                        <p class="text-xs text-slate-500">{{ $prof['type'] }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ($prof['subjects'] as $subject)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $subject['class'] }}">
                                                            {{ $subject['name'] }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="flex-1 h-2 bg-gray-100 dark:bg-slate-700 rounded-full overflow-hidden max-w-[120px]">
                                                        <div class="h-full {{ $prof['color'] }} rounded-full" style="width: {{ $prof['percent'] }}"></div>
                                                    </div>
                                                    <span class="text-sm text-slate-600 dark:text-slate-300 font-medium">{{ $prof['sessions'] }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button class="text-slate-400 hover:text-primary transition-colors p-1 rounded-md hover:bg-blue-50 dark:hover:bg-slate-700">
                                                    <span class="material-symbols-outlined text-xl">edit</span>
                                                </button>
                                                <button class="text-slate-400 hover:text-red-500 transition-colors p-1 rounded-md hover:bg-red-50 dark:hover:bg-slate-700 ml-1">
                                                    <span class="material-symbols-outlined text-xl">delete</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Table Footer / Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between bg-gray-50 dark:bg-slate-800/50">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Mostrando {{ count($professors) }} de {{ count($professors) }} profesores</span>
                            <div class="flex gap-2">
                                <button disabled class="px-3 py-1 text-sm border border-gray-200 dark:border-gray-700 rounded bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 disabled:opacity-50">Anterior</button>
                                <button disabled class="px-3 py-1 text-sm border border-gray-200 dark:border-gray-700 rounded bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 disabled:opacity-50">Siguiente</button>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Info Section -->
                    <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-6 p-6 bg-blue-50 dark:bg-blue-900/10 rounded-xl border border-blue-100 dark:border-blue-900/30">
                        <div class="flex gap-4">
                            <div class="flex-none p-2 bg-blue-100 dark:bg-blue-800 rounded-full text-primary dark:text-blue-200 h-fit">
                                <span class="material-symbols-outlined">info</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900 dark:text-white">Validación de Horarios con IA</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1 max-w-2xl">
                                    La IA requiere al menos 1 asignatura asignada por profesor para generar horarios válidos. 
                                    Los profesores con 0 asignaturas serán excluidos del proceso de generación.
                                </p>
                            </div>
                        </div>
                        <a href="{{ url('/grupos') }}"
                            class="flex-none whitespace-nowrap px-6 py-3 bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary text-slate-900 dark:text-white font-medium rounded-lg shadow-sm transition-all flex items-center gap-2 group">
                            Continuar a Grupos
                            <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Side Panel (Drawer) Overlay Backdrop -->
            <div id="panelOverlay" class="absolute inset-0 bg-slate-900/20 backdrop-blur-sm z-30 transition-opacity opacity-0 hidden"></div>

            <!-- Side Panel (Drawer) -->
            <div id="sidePanel" class="absolute inset-y-0 right-0 max-w-md w-full bg-white dark:bg-slate-900 shadow-2xl z-40 transform transition-transform border-l border-gray-200 dark:border-gray-800 flex flex-col translate-x-full duration-300 ease-in-out">
                <!-- Panel Header -->
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between bg-gray-50 dark:bg-slate-900">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Añadir Nuevo Profesor</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Introduce los detalles y asigna asignaturas.</p>
                    </div>
                    <button id="closePanelBtn" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <!-- Panel Content -->
                <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-6">
                    <!-- Avatar Upload -->
                    <div class="flex flex-col items-center gap-3 py-4">
                        <div class="h-20 w-20 rounded-full bg-gray-100 dark:bg-slate-800 border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center text-slate-400 cursor-pointer hover:border-primary hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-3xl">add_a_photo</span>
                        </div>
                        <span class="text-xs font-medium text-primary cursor-pointer">Subir Foto</span>
                    </div>

                    <!-- Inputs -->
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nombre Completo</label>
                            <input class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder:text-slate-400" placeholder="e.g. John Doe" type="text" />
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Correo Electrónico</label>
                            <input class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder:text-slate-400" placeholder="profesor@escuela.edu" type="email" />
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Asignaturas</label>
                            <div class="relative group">
                                <div class="w-full min-h-[50px] px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800 focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary transition-all flex flex-wrap gap-2 items-center cursor-text">
                                    <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800 text-primary dark:text-blue-300 px-2 py-1 rounded text-sm font-medium flex items-center gap-1">
                                        Geometría
                                        <button class="hover:bg-blue-200 dark:hover:bg-blue-800 rounded-full h-4 w-4 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[10px]">close</span>
                                        </button>
                                    </div>
                                    <input class="flex-1 bg-transparent border-none outline-none text-slate-900 dark:text-white placeholder:text-slate-400 min-w-[100px]" placeholder="Escribe para buscar..." type="text" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tipo de Contrato</label>
                            <select class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                <option>Tiempo completo</option>
                                <option>Tiempo parcial</option>
                                <option>Contratista</option>
                            </select>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Máximo de Sesiones Semanales</label>
                            <div class="flex items-center gap-4">
                                <input class="w-full h-2 bg-gray-200 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer accent-primary" max="40" min="1" type="range" value="20" />
                                <span class="text-sm font-bold text-slate-900 dark:text-white min-w-[2rem] text-right">20</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panel Footer -->
                <div class="p-6 border-t border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-slate-900 flex gap-3">
                    <button id="cancelPanelBtn" class="flex-1 px-4 py-2.5 bg-white dark:bg-slate-800 border border-gray-300 dark:border-gray-600 text-slate-700 dark:text-slate-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">Cancelar</button>
                    <button class="flex-1 px-4 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors shadow-md shadow-blue-500/20">Guardar Profesor</button>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    <script>
        const addProfessorBtn = document.getElementById('addProfessorBtn');
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

        addProfessorBtn.addEventListener('click', openPanel);
        closePanelBtn.addEventListener('click', closePanel);
        cancelPanelBtn.addEventListener('click', closePanel);
        panelOverlay.addEventListener('click', closePanel);
    </script>
@endpush
