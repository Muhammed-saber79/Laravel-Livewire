<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title, $editIsOpen = false, $deleteIsOpen, $task_id;

    protected $listeners = [
        'taskAdded' => '$refresh',
    ];

    // Start Of Task Update...
    public function edit ($id)
    {
        $task = auth()->user()->tasks()->find($id);
        if ($task->exists()) {
            $this->task_id = $id;
            $this->title = $task->title;
            $this->toggleEditModal();
        }
    }

    public function update()
    {
        $task = auth()->user()->tasks()->find($this->task_id);
        if ($task) {
            $task->update([
                'title' => $this->title,
            ]);

            $this->toggleEditModal();
            session()->flash('warning', 'Task deleted successfully.');
        } else {
            session()->flash('error', 'Error happens while removing this task...!');
        }
    }
    // End Of Task Update...

    // Start Of Task Delete...
    public function remove ($id)
    {
        $task = auth()->user()->tasks()->find($id);
        if ($task->exists()) {
            $this->task_id = $id;
            $this->toggleDeleteModal();
        }
    }

    public function delete ()
    {
        $task = auth()->user()->tasks()->find($this->task_id);
        if ($task) {
            $task->delete();

            $this->toggleDeleteModal();
            session()->flash('warning', 'Task deleted successfully.');
        } else {
            session()->flash('error', 'Error happens while removing this task...!');
        }
    }
    // End Of Task Delete...

    public function render()
    {
        $tasks = auth()->user()->tasks()->latest()->paginate(7);
        $tasksCount = auth()->user()->tasks()->count();

        return view('livewire.tasks-list')->with([
            'tasks' => $tasks,
            'tasksCount' => $tasksCount,
        ]);
    }

    // Uitilities...
    public function toggleEditModal ()
    {
        $this->editIsOpen = ! $this->editIsOpen;
    }

    public function toggleDeleteModal ()
    {
        $this->deleteIsOpen = ! $this->deleteIsOpen;
    }
}
