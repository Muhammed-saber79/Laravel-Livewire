<div>
    <h1 class="text-black text-center font-weight-bold">Tasks List</h1>
    <h3 class="text-black">There are <span class="text-info text-center font-weight-bold">{{ $tasksCount }}</span> tasks.</h3>
    <div class="text-center">
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-info rounded-3">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($tasks as $task)
                    <tr>
                        <td scope="row">{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            @if($task->status == 0)
                                <span class="text-warning">Pending</span>
                            @else
                                <span class="text-success">Done</span> 
                            @endif
                        </td>
                        <td>
                            {{ $editIsOpen ? $editIsOpen : "no" }}
                            <button wire:click="edit({{ $task->id }})" type="button" class="rounded text-info btn btn-hover-shadow">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button
                                wire:click="remove({{ $task->id }})"
                                type="button"
                                class="rounded text-danger btn btn-hover-shadow"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $tasks->links() }}
        </div>
    </div>

    <div class="text-black">
        <div class="container px-4 py-5">
            @if ($editIsOpen)
                <div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content text-bg-dark">

                            <div class="modal-header bg-info">
                                <h5 class="modal-title">
                                    Edit Task
                                </h5>
                                <svg wire:click="toggleEditModal" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </div>
                            <div class="modal-body">
                                <form wire:submit="update">
                                    <div class="form-group">
                                        <label for="title">Task Title</label>
                                        <input wire:model="title" type="text" class="form-control" id="title" placeholder="Enter post title">
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-outline-info mt-4">
                                    Update
                                    </button>
                                    <button type="button" wire:click="toggleEditModal" class="btn btn-outline-secondary mt-4">Close</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade show"></div>
            @endif

            @if ($deleteIsOpen)
                <div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content text-bg-dark">

                            <div class="modal-header bg-warning">
                                <h5 class="modal-title">
                                    Delete Task
                                </h5>
                                <svg wire:click="toggleDeleteModal" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </div>
                            <div class="modal-body">
                                <form wire:submit="delete">
                                    <div class="form-group">
                                        <h3>Are you sure to delete this task? <span class="text-danger">{{ $task->title }}</span></h3>
                                    </div>
                                    <button type="submit" class="btn btn-outline-danger mt-4">
                                    Delete
                                    </button>
                                    <button type="button" wire:click="toggleDeleteModal" class="btn btn-outline-secondary mt-4">Close</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade show"></div>
            @endif
        </div>
    </div>

</div>
