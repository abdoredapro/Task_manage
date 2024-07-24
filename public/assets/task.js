
function deleteItem(id) {

Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
            initDelete(id);
            let item = document.querySelector(`.tasks .task-parent [id='${id}']`);

            item.remove();

            Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
            });
    }
  });

    
}

function initDelete(id) {

    let req = new XMLHttpRequest;

    req.onreadystatechange = function () {
        if(req.readyState == 4 && req.status == 200) {
            console.log(req.response);
        }
    }

    req.open('DELETE', `task/${id}/delete`);

    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    req.setRequestHeader('X-CSRF-TOKEN', csrf);

    req.send();
}


function taskSearch() {
    let form = document.querySelector('.search .search_form');
    let input = document.querySelector('.search .search_form .search_title').value;
    let status = document.querySelector('.search .status').value;
    let error = document.querySelector('.search .search_form .error');

    
    error.innerHTML = '';
    if(input == '') {
        error.innerHTML += '<span class="text-danger">You must enter value</span>';
    } else {
        filterTasks(input, status);
    }

}




function filterTasks(input, status) {
    let Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if(Request.readyState == 4 && Request.status == 200) {
            let data = JSON.parse(Request.response);
            parent.innerHTML = '';
            data.forEach(task => {

                let date = moment(task.created_at, "YYYY-MM-DD h:mm:ss a");
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
    Request.open('POST', 'task/filter');
    Request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    Request.setRequestHeader('X-CSRF-TOKEN', csrf);
    Request.send(`title=${input}&status=${status}`);
}

