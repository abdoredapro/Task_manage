<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
        
    </x-slot>

    <div class="py-12 cayegory">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @include('layouts.tasks')

                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            const csrf = "{{ csrf_token() }}";
            const user_id = "{{ Auth::id() }}";
            const url = "{{ route('dashboard.tasks.all') }}";

        </script>
        <script src="https://momentjs.com/downloads/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>

let parent = document.querySelector('.tasks .task-parent');


window.onload = function () {

    getAllTasks();

}

function getAllTasks() {
    let Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if(Request.readyState == 4 && Request.status == 200) {
            let data = JSON.parse(Request.response);

            data.forEach(task => {

                let date = moment(task.created_at);
                console.log(date.fromNow());


                
                parent.innerHTML += `<div class="col-md-4" id="${task.id}">
                <div class="task">
                    <div class="head d-flex justify-content-between align-items-center">
                        
                        <div class="badge rounded-pill text-bg-danger">${task.status}</div>
                        

                        <div class="icon">
                            <span href="" class="badge rounded-pill text-bg-primary">${task.category.name}</span>
                        </div>
                    </div>
                    <div class="info">
                        <h4>${task.title}</h4>
                    </div>

                    <div class="control-item d-flex justify-content-between align-items-center">
                        <p class="text-secondary">${date.fromNow()}</p>
                        <div class="control d-flex justify-content-between align-items-center">
                            <a href="task/${task.id}/edit" class="btn btn-sm btn-success me-2">Edit</a>
                            <form class='task_delete' id="${task.id}" onsubmit="event.preventDefault(); deleteItem(${task.id})"  method="POST" class="d-inline-block">
                                
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            </div>`;
            });
            
        }
    }
    Request.open('POST', url);
    Request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    Request.setRequestHeader('X-CSRF-TOKEN', csrf);
    Request.send(`user_id=${user_id}`);
}

        </script>

        <script src="{{ asset('assets/task.js') }}"></script>

    @endsection
</x-app-layout>