@php
    $times = explode(' - ', $row['time']);
@endphp
<div class="h-32 p-3 flex flex-col items-center justify-center text-xs font-medium text-text-secondary dark:text-slate-400 border-b border-gray-100 dark:border-slate-800/50">
    <span>{{ $times[0] }}</span>
    <span class="text-[10px] text-gray-400">-</span>
    <span>{{ $times[1] }}</span>
</div>

@foreach ($row['slots'] as $slot)
    <div class="h-32 p-1.5 border-b border-gray-100 dark:border-slate-800/50">
        <div class="h-full w-full rounded-lg bg-{{ $slot['color'] }}-50 dark:bg-{{ $slot['color'] }}-900/20 border-l-4 border-{{ $slot['color'] }}-500 p-3 hover:shadow-md transition-shadow cursor-pointer flex flex-col justify-between group">
            <div>
                <h4 class="font-bold text-slate-800 dark:text-slate-100 text-sm group-hover:text-{{ $slot['color'] }}-600 transition-colors">
                    {{ $slot['subject'] }}
                </h4>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">{{ $slot['prof'] }}</p>
            </div>
            <div class="flex items-center gap-1 text-[11px] font-medium text-slate-500 dark:text-slate-400 bg-white/50 dark:bg-black/20 rounded px-1.5 py-0.5 w-fit">
                <span class="material-symbols-outlined text-[12px]">meeting_room</span>
                {{ $slot['room'] }}
            </div>
        </div>
    </div>
@endforeach
