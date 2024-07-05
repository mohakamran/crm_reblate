@extends('layouts.master')
@section('title')
    New Tasks
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    New Tasks
@endsection
@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            .borderingLeftTable {
                border-top-left-radius: 10px !important;
            }

            .borderingRightTable {
                border-top-right-radius: 10px !important;
            }

            .table-lines {
                font-family: 'Poppins';
                color: #000;
                font-weight: 700;
            }

            /* Adjust layout of DataTable components */
            .dataTables_length,
            .dataTables_filter,
            .dataTables_buttons {
                display: inline-block;
                margin-right: 10px;
                /* Adjust margin as needed */
            }

            .dataTables_filter {
                float: right;
                /* Align search bar to the right */
            }

            .modal-backdrop {

                position: fixed;
                top: 0;
                left: 0;
                z-index: -1;
                width: 100vw;
                height: 100vh;
                background-color: var(--bs-backdrop-bg);
            }

            .popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, 0.5);
                width: 100%;
                height: 100%;
                z-index: 1000;
            }

            .popup-content {
                /* overflow-y: scroll;
                                                scroll-behavior: smooth scroll; */
                display: flex;
                max-width: 700px;
                margin: auto auto;
                position: relative;
                top: 100px;
                justify-content: center;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

            }

            .closeBtn {
                position: absolute;
                top: 25px;
                right: 15px;
                cursor: pointer;
            }
        </style>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body bg-white">


                        <form method="post" action="/add-new-task" enctype="multipart/form-data">
                            @csrf

                            @if (session('success'))
                                <div class="container-fluid d-flex justify-content-end">
                                    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center"
                                        style="max-width: 300px; padding-right:20px;" id="close-now">
                                        {{ session('success') }}

                                        <a type="button" onclick="hideNow()" id="close-now" class="close-n"
                                            data-dismiss="alert" aria-label="Close"
                                            style="float: right; font-size:20px; margin-left:10px;">
                                            <span aria-hidden="true">&times;</span>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-md-6" style="width: 49%;">
                                    <div class="form-floating inputboxcolor">
                                        <select
                                            style="background-color: transparent; border:none; width: 100%; padding: 10px;"
                                            name="emp_name" id="selectBox">
                                            @foreach ($emp as $employee)
                                                <option style="padding: 10px;" value="{{ $employee->Emp_Code }}">
                                                    <img src="{{ asset($employee->Emp_Image) }}"
                                                        style="width:50px;height:50px;border-radius:50%;" alt="">
                                                    {{ $employee->Emp_Full_Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <select style="background-color: transparent; border:none;" class="form-control select2" name="emp_name" id="selectBox">

                                    </select> --}}
                                        @error('emp_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6 inputboxcolor">

                                    <!-- Existing input field -->
                                    <input type="text" class="form-control" name="first_task_title"
                                        style="background-color: transparent; border:none;" placeholder="Task Title">

                                    @error('first_task_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>


                            <div class="row mb-3">
                                <div class="col-md-6" style="width:49%;">
                                    <!-- Existing input field -->
                                    <div class="inputboxcolor">

                                        <input style="background-color: transparent; border:none;" type="date"
                                            class="form-control inputboxcolor" name="first_task_deadline"
                                            placeholder="Task Title" value="{{ old('first_task_deadline') }}">
                                        @error('first_task_deadline')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="inputboxcolor">
                                        <textarea style="background-color: transparent; border:none;" class="form-control" name="first_task_description"
                                            placeholder="task description">{{ old('first_task_description') }}</textarea>
                                        @error('first_task_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>
                            </div>
                            <div id="inputContainer"></div>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <button type="button" class="reblateBtn px-4 py-2" id="addInputButton">Add New
                                    Task</button>
                                <button type="submit" class="reblateBtn px-4 py-2"
                                    style="background-color: #fca311 ; border:#fca311; color: #000;">Assign Task</button>
                            </div>



                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <dv class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body bg-white">
                                <h4>Assigned Tasks ({{ $count }}) in the month of {{ $date }}</h4>
                                <table id="datatable-buttons" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr style="background-color: #14213d">
                                            <th class="borderingLeftTable font-size-20" style="color: white">ID</th>
                                            <th class="font-size-20" style="color: white">Tasks Title</th>
                                            <th class="font-size-20" style="color: white">Assigned Date</th>
                                            <th class="font-size-20" style="color: white">DeadLine Date</th>
                                            <th class="font-size-20" style="color: white">Employee Name</th>
                                            <th class="borderingRightTable font-size-20" style="color: white">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table-body">
                                        @php
                                            $count = 0;
                                        @endphp

                                        @foreach ($tasks as $task)
                                            @php
                                                $count++;
                                            @endphp
                                            <tr style="border-bottom: 1px solid #c7c7c7">
                                                <td>{{ $count }}</td>
                                                <td>{{ $task->task_title }}</td>
                                                <td>{{ date('d F Y',strtotime($task->assigned_date)) }}</td>
                                                <td>{{  date('d F Y',strtotime($task->task_date)) }}</td>
                                                <td>
                                                    @php
                                                        // Using DB facade to fetch employee name
                                                        $employee = DB::table('employees')
                                                            ->where('Emp_Code', $task->emp_id)
                                                            ->first();
                                                        // Replace 'employees' with your actual table name if different
                                                    @endphp
                                                    @if ($employee)
                                                        {{ $employee->Emp_Full_Name }}
                                                    @else
                                                        Unknown
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#popup_{{ $task->id }}" data-toggle="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="m14.06 9.02l.92.92L5.92 19H5v-.92zM17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83a.996.996 0 0 0 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="#" onclick="TaskEducation({{$task->id}})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="#d20f0f"
                                                                d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z">
                                                            </path>
                                                        </svg>
                                                    </a>

                                                </td>
                                            </tr>

                                        <div class="popup" id="popup_{{ $task->id }}">
                                            <div class="popup-content flex-column">
                                                <div class="d-flex mb-3 align-items-center justify-content-between">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{$task->task_title}}</h5>

                                                </div>

                                                <div class="modal-body">

                                                        <p class="text-danger" style="display: none;" id="message_id_{{ $task->id }}"></p>
                                                        <p class="text-success" style="display: none;" id="message_success_{{ $task->id }}">Task Updated!</p>
                                                        <form action="">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Task Title <span style="color:red">*</span></label>
                                                                    <input type="text" id="task_title_{{ $task->id }}"
                                                                        placeholder="task title" name="" value="{{isset($task->task_title) ? $task->task_title : ''}}"
                                                                        class="form-control">
                                                                    <span style="color:red;display:none"
                                                                        id="task_title_message_{{$task->id}}"></span>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">DeadLine <span style="color:red">*</span></label>
                                                                    <input type="date" id="task_deadline_{{$task->id}}" value="{{$task->task_date}}" class="form-control" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Task Description <span style="color:red">*</span></label>
                                                                     <textarea name="" class="form-control" id="task_description_{{$task->id}}" >{{ ($task->task_description!=null) ? $task->task_description : '' }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>







                                                        </div>
                                                        <div class="modal-footer mt-3 d-flex gap-2">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                                    >Close</button>
                                                            <button type="button" onclick="updateTask({{$task->id}})"
                                                                class="reblateBtn px-4 py-2">Save Changes</button>
                                                        </div>





                                            </div>

                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </dv>



                <script>
                    function TaskEducation(id) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'task will be deleted!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            confirmButtonColor: '#FF5733', // Red color for "Yes"
                            cancelButtonColor: '#4CAF50', // Green color for "No"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Send an AJAX request to delete the task
                                $.ajax({
                                    url: '/del-task/' + id,
                                    method: 'GET', // Use the DELETE HTTP method
                                    success: function() {
                                        // Provide user feedback
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'deleted!',
                                            icon: 'success'
                                        }).then(() => {
                                            location.reload(); // Refresh the page
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle errors, you can display an error message to the user
                                        console.error('Error:', error);
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'An error occurred while deleting task!',
                                            icon: 'error'
                                        });
                                    }
                                });

                            }
                        });
                    }
                    $(document).ready(function() {
                        $('#datatable-buttons').DataTable({
                            dom: "<'container-fluid'" +
                                "<'row'" +
                                "<'col-md-8'lB>" +
                                "<'col-md-4 text-right'f>" +
                                ">" +
                                "<'row dt-table'" +
                                "<'col-md-12'tr>" +
                                ">" +
                                "<'row'" +
                                "<'col-md-7'i>" +
                                "<'col-md-5 text-right'p>" +
                                ">" +
                                ">",
                            lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, "All"]
                            ],
                            buttons: [
                                '', ''
                            ],

                        });
                    })

                    //update
                    function updateTask(id) {


                        var message = 'message_id_' + id;
                        var message_success = 'message_success_' + id;
                        var task_title = 'task_title_' + id;
                        var task_deadline = 'task_deadline_' + id;
                        var task_desc = 'task_description_' + id;

                        task_title = document.getElementById(task_title).value;
                        task_deadline = document.getElementById(task_deadline).value;
                        task_desc = document.getElementById(task_desc).value;
                        message = document.getElementById(message);
                        message_success = document.getElementById(message_success);


                        if (task_title == "") {
                            message.style.display = "block";
                            message.innerHTML = "task title required!";
                            return;
                        } else {
                            message.style.display = "none";
                        }


                        if (task_deadline == "") {
                            message.style.display = "block";
                            message.innerHTML = "task deadline date required!";
                            return;
                        } else {
                            message.style.display = "none";
                        }

                        if (task_desc == "") {
                            message.style.display = "block";
                            message.innerHTML = "task description required!";
                            return;
                        } else {
                            message.style.display = "none";
                        }

                        var csrfToken = "{{ csrf_token() }}";



                        var formData = {
                            id: id,
                            _token: csrfToken,
                            task_title: task_title,
                            task_deadline: task_deadline,
                            task_desc: task_desc
                        };

                        $.ajax({
                            url: '/update-task', // The Laravel route
                            type: 'get', // POST request
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                            },
                            data: formData,
                            success: function(response) {
                                // Show success message
                                console.log(response);

                                if (message.style.display == "block") {
                                    message.style.display == "none";
                                }
                                var task_title_reset = 'task_title_'+id;
                                var task_reset_deadline = 'task_deadline_'+id;
                                var task_desc_reset = 'task_description_'+id;
                                task_title_reset =document.getElementById(task_title_reset).value = "";
                                task_reset_deadline =document.getElementById(task_reset_deadline).value = "";
                                task_desc_reset =document.getElementById(task_desc_reset).value = "";
                                message_success.style.display = "block";
                            },
                            error: function(xhr, status, error) {
                                if (xhr.status === 400) {
                                    if (message_success.style.display == "block") {
                                        message_success.style.display == "none";
                                    }
                                    message.innerHTML = error;
                                    message.style.display = "block";
                                }
                            },

                        });

                        return false; // Prevent form submission if within a form
                    }
                </script>

                <script>
                    function hideNow() {
                        var divElement = document.getElementById('close-now');
                        divElement.style.display = 'none';
                    }
                    // Select the button and the container where inputs will be added
                    const addInputButton = document.getElementById('addInputButton');
                    const inputContainer = document.getElementById('inputContainer');

                    // Function to create a task row
                    function createTaskRow() {
                        // Create a new row for task title and deadline
                        const titleDateRow = document.createElement('div');
                        titleDateRow.classList.add('row', 'mb-3', 'mt-2');

                        // Create first column for task title
                        const titleCol = document.createElement('div');
                        titleCol.classList.add('col-md-6');

                        // Create a new input element for task title
                        const titleInput = document.createElement('div');
                        titleInput.classList.add('task-input', 'form-floating');
                        const titleInputElement = document.createElement('input');
                        titleInputElement.type = 'text';
                        titleInputElement.name = 'task_title[]'; // Assuming you want this input to be part of an array
                        titleInputElement.classList.add('form-control');
                        titleInputElement.placeholder = 'Enter task title';
                        const titleLabelElement = document.createElement('label');
                        titleLabelElement.textContent = 'Task Title';

                        // Append input and label to the div
                        titleInput.appendChild(titleInputElement);
                        titleInput.appendChild(titleLabelElement);

                        // Append task title input to the column
                        titleCol.appendChild(titleInput);

                        // Append first column to the row for task title and deadline
                        titleDateRow.appendChild(titleCol);

                        // Create second column for deadline date
                        const deadlineCol = document.createElement('div');
                        deadlineCol.classList.add('col-md-6');

                        // Create a new input element for deadline date
                        const deadlineInput = document.createElement('div');
                        deadlineInput.classList.add('task-input', 'form-floating');
                        const deadlineInputElement = document.createElement('input');
                        deadlineInputElement.type = 'date';
                        deadlineInputElement.name = 'task_deadline[]'; // Assuming you want this input to be part of an array
                        deadlineInputElement.classList.add('form-control');
                        deadlineInputElement.placeholder = 'Enter deadline date';
                        const deadlineLabelElement = document.createElement('label');
                        deadlineLabelElement.textContent = 'Deadline Date';

                        // Append input and label to the div
                        deadlineInput.appendChild(deadlineInputElement);
                        deadlineInput.appendChild(deadlineLabelElement);

                        // Append deadline date input to the column
                        deadlineCol.appendChild(deadlineInput);

                        // Append second column to the row for task title and deadline
                        titleDateRow.appendChild(deadlineCol);

                        // Append row for task title and deadline to the container
                        inputContainer.appendChild(titleDateRow);

                        // Create a new row for task description
                        const descRow = document.createElement('div');
                        descRow.classList.add('row', 'mb-3');

                        // Create column for task description
                        const descCol = document.createElement('div');
                        descCol.classList.add('col-md-12');

                        // Create a new input element for task description
                        const descInput = document.createElement('div');
                        descInput.classList.add('task-input', 'form-floating');
                        const descInputElement = document.createElement('textarea');
                        descInputElement.name = 'task_description[]'; // Assuming you want this input to be part of an array
                        descInputElement.classList.add('form-control');
                        descInputElement.placeholder = 'Enter task description';
                        const descLabelElement = document.createElement('label');
                        descLabelElement.textContent = 'Task Description';

                        // Append input and label to the div
                        descInput.appendChild(descInputElement);
                        descInput.appendChild(descLabelElement);

                        // Append task description input to the column
                        descCol.appendChild(descInput);

                        // Append column for task description to the row
                        descRow.appendChild(descCol);

                        // Append row for task description to the container
                        inputContainer.appendChild(descRow);

                        // Create a remove button
                        const removeButtonCol = document.createElement('div');
                        removeButtonCol.classList.add('col-md-12', 'text-center', 'mt-3');
                        const removeButton = document.createElement('button');
                        removeButton.type = 'button';
                        removeButton.textContent = 'Remove Task';
                        removeButton.classList.add('btn', 'btn-danger');
                        removeButton.addEventListener('click', function() {
                            // Remove the task row
                            titleDateRow.remove();
                            descRow.remove();
                            removeButtonCol.remove();
                        });
                        removeButtonCol.appendChild(removeButton);

                        // Append remove button column to the container
                        inputContainer.appendChild(removeButtonCol);
                    }

                    // Add event listener to the button
                    addInputButton.addEventListener('click', function() {
                        // Create a new task row
                        createTaskRow();
                    });

                    // Check if there are tasks stored in localStorage
                    window.addEventListener('load', function() {
                        const storedTasks = JSON.parse(localStorage.getItem('tasks'));
                        if (storedTasks) {
                            storedTasks.forEach(task => {
                                // Create a task row
                                createTaskRow();
                                // Set the values of inputs
                                const taskInputs = inputContainer.querySelectorAll(
                                    'input[name="task_title[]"], input[name="task_deadline[]"], textarea[name="task_description[]"]'
                                );
                                taskInputs.forEach((input, index) => {
                                    input.value = task[index];
                                });
                            });
                        }
                    });

                    // Save added tasks in localStorage before page refresh or close
                    window.addEventListener('beforeunload', function() {
                        const taskRows = inputContainer.querySelectorAll('.row.mb-3.mt-2');
                        const tasks = [];
                        taskRows.forEach(row => {
                            const titleInput = row.querySelector('input[name="task_title[]"]');
                            const deadlineInput = row.querySelector('input[name="task_deadline[]"]');
                            const descInput = row.nextElementSibling.querySelector(
                                'textarea[name="task_description[]"]');
                            if (titleInput && deadlineInput && descInput) {
                                tasks.push([titleInput.value, deadlineInput.value, descInput.value]);
                            }
                        });
                        localStorage.setItem('tasks', JSON.stringify(tasks));
                    });
                </script>


            @endsection
            @section('scripts')
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                <!-- Required datatable js -->
                <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
                <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


                <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
                <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

                <!-- Responsive examples -->
                <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
                <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

                <!-- Datatable init js -->

                <!-- App js -->
                <script src="{{ URL::asset('build/js/app.js') }}"></script>

                {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
                <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                <link rel="stylesheet" type="text/css"
                    href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
            @endsection
