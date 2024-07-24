<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Deleted Tasks') }}
        </h2>
        
    </x-slot>

    <div class="py-12 cayegory">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="head">
                        <div>
                            <h1>All Task</h1>
                        </div>
                        
                    </div>
                    
                    <div class="show">
                        <div class="row">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ Str::limit($task->description, 20, '...') }}</td>
                                        <td>
                                            <div class="badge rounded-pill text-bg-danger">{{ $task->status }}</div>
                                        </td>
                                        <td class="d-flex">
                                            <a class="btn btn-sm btn-primary mr-5" href="{{ route('dashboard.task.restore', $task->id) }}">Restore</a>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>