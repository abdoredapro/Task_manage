<div class="search">
    <div class="container">
        <form  method="POST" class="search_form" onsubmit="event.preventDefault(); taskSearch()">
            <div class="row">
                <div class="col-md-6">
                    <div class="search_input">
                        <input type="text" name="search_title" class="search_title" placeholder="Search">
                        <p class="error"></p>
                    </div>
    
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select status">
                        <option value="">All</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
    
                <div class="col-md-4">
                    <div class="search_btn">
                        <input type="submit" value="Search">
                        <i class="fa-duotone fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<hr>

<div class="info">

    <div class="container">
        <div class="row all justify-content-between">
            <div class="col-md-6">
                <h3>All Tasks</h3>
            </div>
            <div class="col-md-6">
                <a href="{{ route('dashboard.task.create') }}" class="text-decoration-none btn btn-sm btn-primary">Create Task</a>
                <a href="{{ route('dashboard.task.trash') }}" class="text-decoration-none btn btn-sm btn-danger">Deleted Task</a>
            </div>
        </div>
        <div class="row task_info">
            <div class="col-md-12">
                <ul class="list-unstyled d-flex justify-content-between">
                    <li>All Tasks <span class="badge rounded-circle">{{ $tasks->count() }}</span></li>
                    <li>Pending <span class="badge rounded-circle">{{ $pending }}</span></li>
                    <li>Completed <span class="badge rounded-circle"> {{ $completed }} </span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<hr>


<div class="tasks">
    <div class="container">
        <div class="row task-parent">
            {{-- @foreach ($tasks as $task)
            <div class="col-md-4">
                <div class="task">
                    <div class="head d-flex justify-content-between align-items-center">
                        @if ($task->status == 'pending')
                        <div class="badge rounded-pill text-bg-danger">Pending</div>
                        @else
                        <div class="badge rounded-pill text-bg-success">Completed</div>
                        @endif
                        

                        <div class="icon">
                            <span href="" class="badge rounded-pill text-bg-primary">{{ $task->category->name }}</span>
                        </div>
                    </div>
                    <div class="info">
                        <h4>{{ $task->title }}</h4>
                    </div>

                    <div class="control-item d-flex justify-content-between align-items-center">
                        <p class="text-secondary">{{ $task->created_at->diffForHumans() }}</p>
                        <div class="control ">
                            <a href="{{ route('dashboard.task.edit', $task->id) }}" class="btn btn-sm btn-success me-2">Edit</a>
                            <form action="{{ route('dashboard.task.destroy', $task->id) }}" method="POST" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach --}}
        </div>
    </div>
</div>
