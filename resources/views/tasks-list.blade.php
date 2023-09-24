<x-app-layout>
    <div class="py-12">
        
        <x-toaster />

        <div class="d-flex justify-content-between">
            <div class="col-4">
                @livewire('add-task')
            </div>
            <div class="col-8">
                @livewire('tasks-list')
            </div>
        </div>

    </div>
</x-app-layout>
