@extends('layouts.master')
@section('title')
    New Task
@endsection
@section('page-title')
    New Task
@endsection
@section('body')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">


                        <form method="post" action="/add-new-task" enctype="multipart/form-data">
                            @csrf

                            @if (session('success'))
                            <div class="container-fluid d-flex justify-content-end">
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" style="max-width: 300px; padding-right:20px;" id="close-now">
                                    {{ session('success') }}

                                    <a type="button" onclick="hideNow()" id="close-now" class="close-n" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-md-6" style="width: 49%;">
                                    <div class="form-floating inputboxcolor">
                                        <select style="background-color: transparent; border:none; width: 100%; padding: 10px;" name="emp_name" id="selectBox">
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
                                    <input  type="text" class="form-control" name="first_task_title" style="background-color: transparent; border:none;"
                                        placeholder="Task Title">

                                    @error('first_task_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>


                            <div class="row mb-3">
                                <div class="col-md-6" style="width:49%;">
                                  <!-- Existing input field -->
                                  <div class="inputboxcolor">

                                      <input style="background-color: transparent; border:none;" type="date" class="form-control inputboxcolor" name="first_task_deadline"
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
                                        <textarea style="background-color: transparent; border:none;" class="form-control" name="first_task_description" placeholder="task description">{{ old('first_task_description') }}</textarea>
                                        @error('first_task_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>
                            </div>
                            <div id="inputContainer"></div>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <button type="button" class="reblateBtn px-4 py-2" id="addInputButton">Add New Task</button>
                                <button type="submit" class="reblateBtn px-4 py-2" style="background-color: #fca311 ; border:#fca311; color: #000;">Assign Task</button>
                            </div>



                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });

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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
