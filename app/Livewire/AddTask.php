<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class AddTask extends Component
{
    public $title, $isOpen;

    public function create ()
    {
        $this->openModal();
    }

    public function openModal ()
    {
        $this->isOpen = true;
    }

    public function closeModal ()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $data = $this->validate([
            'title' => 'required|min:3'
        ]);

        $task = auth()->user()->tasks()->create([
            'title' => $data['title'],
            'user_id' => auth()->id(),
        ]);

        $this->title = "";
        $this->dispatch('taskAdded');
        $this->closeModal();
        session()->flash('success', 'Task added successfully.');
    }

    public function render()
    {
        return view('livewire.add-task');
    }
}
