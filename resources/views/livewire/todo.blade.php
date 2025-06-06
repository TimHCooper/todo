<div>
    <div class="flex mx-auto max-w-lg p-6">
        <div class="w-full block">
            <div>
                <span class="text-gray-600 dark:text-zinc-400">
                    {{ __("TO-DO") }}
                </span>
                @if ($tasks->isEmpty())
                    <div>
                        @if ($completed->isEmpty())
                            Add a task to get started.
                        @else
                            You have no more tasks remaining. Hooray!
                        @endif
                    </div>
                @else
                    <div class="mt-2 border border-gray-200 dark:border-zinc-800 rounded-lg">
                        @foreach($tasks as $task)
                            <x-task :task="$task"/>
                        @endforeach
                    </div>
                @endif
            </div>

            @if(!$completed->isEmpty())
                <div class="mt-3">
                    <span class="text-gray-600 dark:text-zinc-400">
                        {{ __("COMPLETED") }}
                    </span>
                    <div class="mt-2 border border-gray-200 dark:border-zinc-800 rounded-lg">
                        @foreach($completed as $task)
                            <x-task :task="$task"/>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="p-6 border-t border-t-gray-200 dark:border-t-zinc-800">
        <flux:field>
            <flux:label class="text-lg">{{ __("New Task") }}</flux:label>

            <flux:input.group>
                <flux:input placeholder="{{ __('Task Name') }}" wire:model="name"/>
                <flux:button icon="plus" wire:click="save">{{ __("Add") }}</flux:button>
            </flux:input.group>

            <flux:error name="name"/>
        </flux:field>

        <div class="mt-3 text-right">
            <flux:modal.trigger name="new-task">
                <flux:button variant="filled" size="xs">{{ __("More Options...") }}</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <flux:modal name="new-task" class="md:w-96">
        <form wire:submit="save" class="space-y-6">
            <flux:heading size="lg">New Task</flux:heading>

            <flux:field>
                <flux:label class="text-lg">{{ __("Name") }} *</flux:label>
                <flux:input wire:model="name"/>
                <flux:error name="name"/>
            </flux:field>

            <flux:textarea label="Description" wire:model="description"/>

            {{-- Change to flux:datetime with flux pro --}}
            <flux:input type="datetime-local" label="Start Date" wire:model="startDate"/>
            <flux:input type="datetime-local" label="End Date" wire:model="endDate"/>

            <div class="flex">
                <flux:spacer/>
                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
