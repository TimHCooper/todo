@props(['task'])

@php
    /** @var \App\Models\Task $task */
    $expandable = !empty($task->description) | $task->startDate | $task->endDate;
@endphp

<div wire:key="{{ $task->id }}">
    @if ($expandable)
        <div class="p-2 not-last:border-b not-last:border-b-gray-200 dark:not-last:border-b-zinc-800 hover:bg-gray-100 dark:hover:bg-zinc-600 cursor-pointer last:rounded-b-lg first:rounded-t-lg transition"
             x-data="{ task_{{ $task->id }}_open: false }"
             x-on:click="task_{{ $task->id }}_open = ! task_{{ $task->id }}_open"
        >
            <flux:icon.chevron-down class="inline text-gray-600 dark:text-zinc-400 size-5" x-show="!task_{{ $task->id }}_open" />
            <flux:icon.chevron-up class="inline text-gray-600 dark:text-zinc-400 size-5" x-show="task_{{ $task->id }}_open" x-cloak />

            @if ($task->completed)
                <span class="text-gray-600 dark:text-zinc-400 line-through">
                    {{ $task->title }}
                </span>
                <flux:checkbox @click.stop="$wire.setCompleted({{ $task->id }}, $el.checked)" checked class="float-right top-0.5 relative" />
            @else
                @if ($task->end_date?->isToday())
                    <span class="text-yellow-600 dark:text-yellow-400">
                        {{ $task->title }}
                    </span>
                @else
                    {{ $task->title }}
                @endif
                <flux:checkbox @click.stop="$wire.setCompleted({{ $task->id }}, $el.checked)" class="float-right top-0.5 relative" />
            @endif

            <div class="md:grid md:grid-cols-2 text-sm mt-2 space-y-3 text-gray-600 dark:text-zinc-300" x-cloak x-show="task_{{ $task->id }}_open" x-collapse>
                <div>
                    <div class="text-white text-base">
                        {{ __("Description") }}
                    </div>
                    {{ $task->description }}
                </div>
                <div>
                    <div class="text-white text-base">
                        {{ __("Start Date") }}
                    </div>
                    {{ $task->start_date }}

                    <div class="text-white text-base mt-3">
                        {{ __("End Date") }}
                    </div>
                    {{ $task->end_date }}
                </div>
            </div>
        </div>
    @else
        <div class="p-2 not-last:border-b not-last:border-b-gray-200 dark:not-last:border-b-zinc-800">
            <flux:icon.chevron-down class="inline size-5 invisible" />
            @if ($task->completed)
                <span class="text-gray-600 dark:text-zinc-400 line-through">
                    {{ $task->title }}
                </span>
                <flux:checkbox @click.stop="$wire.setCompleted({{ $task->id }}, $el.checked)" checked class="float-right top-0.5 relative" />
            @else
                {{ $task->title }}
                <flux:checkbox @click.stop="$wire.setCompleted({{ $task->id }}, $el.checked)" class="float-right top-0.5 relative" />
            @endif
        </div>
    @endif
</div>
