<?php

namespace App\Livewire;

use App\Models\Task;
use Carbon\Carbon;
use Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Todo extends Component
{
    public Collection $tasks;
    public Collection $completed;

    #[Validate('required')]
    public string $name;

    public string $description;
    public ?Carbon $startDate = null;
    public ?Carbon $endDate = null;

    private function getTasks(): Collection
    {
        return Task::where('completed', false)
            ->orderByRaw('end_date is null')
            ->orderBy('end_date')
            ->orderBy('title')
            ->get();
    }

    private function getCompletedTasks(): Collection
    {
        return Task::where('completed', true)
            ->orderByRaw('end_date is null')
            ->orderBy('end_date')
            ->orderBy('title')
            ->get();
    }

    public function save()
    {
        $this->validate();

        Task::create([
            'title' => $this->name,
            'description' => $this->description,
            'completed' => false,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ]);

        $this->resetFormData();
        Flux::modal('new-task')->close();
    }

    public function setCompleted(Task $task, bool $status): void
    {
        $task->completed = $status;

        $task->save();
    }

    private function resetFormData(): void
    {
        $this->name = '';
        $this->description = '';
        $this->startDate = null;
        $this->endDate = null;
    }

    public function mount(): void
    {
        $this->resetFormData();
    }

    public function render()
    {
        $this->tasks = $this->getTasks();
        $this->completed = $this->getCompletedTasks();

        return view('livewire.todo');
    }
}
