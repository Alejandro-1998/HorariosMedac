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
                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
                                    @foreach ($professors as $prof)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors group">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">
                                                        {{ substr($prof->name, 0, 2) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-slate-900 dark:text-white">{{ $prof->name }}</p>
                                                        <p class="text-xs text-slate-500">{{ $prof->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ($prof->subjects as $subject)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                                            {{ $subject->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="flex-1 h-2 bg-gray-100 dark:bg-slate-700 rounded-full overflow-hidden max-w-[120px]">
                                                        @php
                                                            $percent = ($prof->subjects->sum('weekly_hours') / $prof->max_weekly_sessions) * 100;
                                                        @endphp
                                                        <div class="h-full bg-blue-500 rounded-full" style="width: {{ $percent }}%"></div>
                                                    </div>
                                                    <span class="text-sm text-slate-600 dark:text-slate-300 font-medium">{{ $prof->subjects->sum('weekly_hours') }}/{{ $prof->max_weekly_sessions }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button onclick="editProfessor({{ $prof->id }}, '{{ $prof->name }}', '{{ $prof->email }}', '{{ $prof->contract_type }}', {{ $prof->max_weekly_sessions }})" class="text-slate-400 hover:text-primary transition-colors p-1 rounded-md hover:bg-blue-50 dark:hover:bg-slate-700">
                                                    <span class="material-symbols-outlined text-xl">edit</span>
                                                </button>
                                                <form action="{{ route('profesores.destroy', $prof->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-1 rounded-md hover:bg-red-50 dark:hover:bg-slate-700 ml-1">
                                                        <span class="material-symbols-outlined text-xl">delete</span>
                                                    </button>
                                                </form>
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
                <form id="professorForm" action="{{ route('profesores.store') }}" method="POST" class="flex-1 flex flex-col h-full">
                    @csrf
                    <div id="methodField"></div>
                    
                    <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-6">
                        <!-- Inputs -->
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nombre Completo</label>
                                <input name="name" id="nameInput" required class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder:text-slate-400" placeholder="e.g. John Doe" type="text" />
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Correo Electrónico</label>
                                <input name="email" id="emailInput" required class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder:text-slate-400" placeholder="profesor@escuela.edu" type="email" />
                            </div>
                            
                            <!-- Subjects (Visual only for now, logic not implemented in controller yet) -->
                            <div class="space-y-2 opacity-50 pointer-events-none">
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Asignaturas (Gestión en detalle)</label>
                                <div class="relative group">
                                    <div class="w-full min-h-[50px] px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800 focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary transition-all flex flex-wrap gap-2 items-center cursor-text">
                                        <input class="flex-1 bg-transparent border-none outline-none text-slate-900 dark:text-white placeholder:text-slate-400 min-w-[100px]" placeholder="Opción deshabilitada temp." type="text" disabled />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Máximo de Sesiones Semanales</label>
                                <div class="flex items-center gap-4">
                                    <input name="max_weekly_sessions" id="sessionsInput" class="w-full h-2 bg-gray-200 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer accent-primary" max="40" min="1" type="range" value="20" oninput="document.getElementById('sessionsValue').innerText = this.value" />
                                    <span id="sessionsValue" class="text-sm font-bold text-slate-900 dark:text-white min-w-8 text-right">20</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel Footer -->
                    <div class="p-6 border-t border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-slate-900 flex gap-3">
                        <button type="button" id="cancelPanelBtn" class="flex-1 px-4 py-2.5 bg-white dark:bg-slate-800 border border-gray-300 dark:border-gray-600 text-slate-700 dark:text-slate-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">Cancelar</button>
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors shadow-md shadow-blue-500/20">Guardar Profesor</button>
                    </div>
                </form>
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
        const form = document.getElementById('professorForm');
        const methodField = document.getElementById('methodField');
        const panelTitle = document.querySelector('#sidePanel h3');

        function openPanel(isEdit = false) {
            panelOverlay.classList.remove('hidden');
            // Trigger reflow
            void panelOverlay.offsetWidth;
            panelOverlay.classList.remove('opacity-0');
            sidePanel.classList.remove('translate-x-full');
            
            if (!isEdit) {
                resetForm();
            }
        }

        function closePanel() {
            sidePanel.classList.add('translate-x-full');
            panelOverlay.classList.add('opacity-0');
            setTimeout(() => {
                panelOverlay.classList.add('hidden');
            }, 300);
        }

        function resetForm() {
            form.action = "{{ route('profesores.store') }}";
            methodField.innerHTML = '';
            document.getElementById('nameInput').value = '';
            document.getElementById('emailInput').value = '';
            document.getElementById('contractInput').value = 'Tiempo completo';
            document.getElementById('sessionsInput').value = 20;
            document.getElementById('sessionsValue').innerText = 20;
            panelTitle.innerText = 'Añadir Nuevo Profesor';
        }

        function editProfessor(id, name, email, contractType, maxSessions) {
            form.action = "{{ route('profesores.index') }}/" + id;
            methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            
            document.getElementById('nameInput').value = name;
            document.getElementById('emailInput').value = email;
            document.getElementById('sessionsInput').value = maxSessions;
            document.getElementById('sessionsValue').innerText = maxSessions;
            
            panelTitle.innerText = 'Editar Profesor';
            openPanel(true);
        }

        addProfessorBtn.addEventListener('click', () => openPanel(false));
        closePanelBtn.addEventListener('click', closePanel);
        cancelPanelBtn.addEventListener('click', closePanel);
        panelOverlay.addEventListener('click', closePanel);
    </script>
@endpush
