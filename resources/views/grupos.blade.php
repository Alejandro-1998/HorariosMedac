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
                
                <!-- Alerts -->
                @if(session('success'))
                    <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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
                    @foreach ($courses as $course)
                        <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] dark:shadow-none border border-gray-200 dark:border-gray-800 hover:border-primary/50 dark:hover:border-primary/50 transition-all duration-300 group cursor-pointer flex flex-col h-full">
                            <div class="p-6 flex flex-col gap-4 flex-1">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 flex items-center justify-center font-bold text-lg">
                                            {{ substr($course->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h3 class="text-text-primary dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">
                                                {{ $course->name }}
                                            </h3>
                                            <p class="text-text-secondary dark:text-gray-400 text-xs font-medium uppercase tracking-wider mt-0.5">
                                                {{ ucfirst($course->grade) }} - {{ $course->year }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex gap-1">
                                        <button onclick="editGroup({{ $course->id }}, '{{ $course->name }}', '{{ $course->grade }}', '{{ $course->year }}')" class="text-gray-400 hover:text-primary dark:hover:text-primary p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                            <span class="material-symbols-outlined">edit</span>
                                        </button>
                                        <form action="{{ route('grupos.destroy', $course->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 dark:hover:text-red-500 p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <p class="text-text-secondary dark:text-gray-300 text-sm leading-relaxed line-clamp-2">
                                    Grupo de {{ $course->grade }} curso, año académico {{ $course->year }}.
                                </p>
                                <div class="mt-auto pt-4 flex flex-wrap gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-semibold">
                                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                                        Unknown Sesiones
                                    </span>
                                </div>
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
            </div>
        </main>

        <!-- Slide-over / Side Panel -->
        <aside id="sidePanel" class="absolute inset-y-0 right-0 z-40 w-full sm:w-[450px] bg-surface-light dark:bg-surface-dark shadow-2xl border-l border-gray-200 dark:border-gray-800 transform transition-transform duration-300 ease-in-out translate-x-full flex flex-col">
            <form id="groupForm" action="{{ route('grupos.store') }}" method="POST" class="flex-1 flex flex-col h-full">
                @csrf
                <div id="methodField"></div>
                
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-text-primary dark:text-white" id="panelTitle">Añadir Grupo</h2>
                    <button type="button" id="closePanelBtn" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 rounded-full p-1 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <!-- Modal Content -->
                <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-6">
                    <!-- Form Fields -->
                    <div class="flex flex-col gap-5">
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-text-secondary dark:text-gray-300" for="group-name">Nombre del Grupo</label>
                            <input name="name" id="nameInput" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-surface-light dark:bg-surface-dark text-text-primary dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5" placeholder="e.g. 1º DAW" type="text" />
                        </div>
                        
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-text-secondary dark:text-gray-300" for="grade">Grado/Curso</label>
                            <select name="grade" id="gradeInput" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-surface-light dark:bg-surface-dark text-text-primary dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5">
                                <option value="primero">Primero</option>
                                <option value="segundo">Segundo</option>
                            </select>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-text-secondary dark:text-gray-300" for="year">Año Académico</label>
                            <input name="year" id="yearInput" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-surface-light dark:bg-surface-dark text-text-primary dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5" placeholder="2023-2024" type="text" />
                            <p class="text-xs text-gray-500 mt-1">Formato: AAAA-AAAA</p>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 flex justify-end gap-3 bg-gray-50 dark:bg-gray-900/30">
                    <button type="button" id="cancelPanelBtn" class="px-4 py-2 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">Cancelar</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary/90 text-white text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check</span>
                        Guardar Grupo
                    </button>
                </div>
            </form>
        </aside>
        
        <!-- Overlay backdrop -->
        <div id="panelOverlay" class="fixed inset-0 bg-gray-900/20 backdrop-blur-sm z-30 transition-opacity opacity-0 hidden"></div>
    </div>
@endsection

@push('scripts')
    <script>
        const addGroupBtn = document.getElementById('addGroupBtn');
        const closePanelBtn = document.getElementById('closePanelBtn');
        const cancelPanelBtn = document.getElementById('cancelPanelBtn');
        const sidePanel = document.getElementById('sidePanel');
        const panelOverlay = document.getElementById('panelOverlay');
        const form = document.getElementById('groupForm');
        const methodField = document.getElementById('methodField');
        const panelTitle = document.getElementById('panelTitle');

        function openPanel(isEdit = false) {
            panelOverlay.classList.remove('hidden');
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
            form.action = "{{ route('grupos.store') }}";
            methodField.innerHTML = '';
            document.getElementById('nameInput').value = '';
            document.getElementById('gradeInput').value = 'primero';
            document.getElementById('yearInput').value = '2023-2024';
            panelTitle.innerText = 'Añadir Grupo';
        }

        function editGroup(id, name, grade, year) {
            form.action = "{{ route('grupos.index') }}/" + id;
            methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            
            document.getElementById('nameInput').value = name;
            document.getElementById('gradeInput').value = grade;
            document.getElementById('yearInput').value = year;
            
            panelTitle.innerText = 'Editar Grupo';
            openPanel(true);
        }

        if(addGroupBtn) addGroupBtn.addEventListener('click', () => openPanel(false));
        if(closePanelBtn) closePanelBtn.addEventListener('click', closePanel);
        if(cancelPanelBtn) cancelPanelBtn.addEventListener('click', closePanel);
        if(panelOverlay) panelOverlay.addEventListener('click', closePanel);
    </script>
@endpush
