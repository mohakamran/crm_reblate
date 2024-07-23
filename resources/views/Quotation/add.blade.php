@extends('layouts.master')
@section('title')
    Create Quotation
@endsection

@section('page-title')
    Create Quotation
@endsection
@section('body')
    <style>
        .form-control {
            background-color: #fff;
            /* Set background color for the select box */
            color: #000;
            /* Set text color */
        }
    </style>

    <style>
        .service-container {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .task-container {
            margin-top: 10px;
        }
    </style>

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card bg-white p-3">

                    <form action="/create-quotation" method="post">
                        @csrf
                        <h4>Client Information</h4>
                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectTitle">Project Title</label>
                                    <input type="text" value="{{ old('project_title') }}"
                                        class="form-control p-3 @error('project_title') is-invalid @enderror"
                                        name="project_title" id="projectTitle" placeholder="Project Title">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Client Name</label>
                                    <input type="text" value="{{ old('client_name') }}"
                                        class="form-control @error('client_name') is-invalid  @enderror p-3"
                                        name="client_name" placeholder="Client Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Client Email</label>
                                    <input type="text" name="client_email" value="{{ old('client_email') }}"
                                        class="form-control @error('client_email') is-invalid  @enderror p-3"
                                        placeholder="Client Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="">Project Category</label>
                                    <select name="project_category"
                                        class="form-control @error('project_category') is-invalid @enderror"
                                        id="project_category">
                                        <option value="" selected disabled>Select Category</option>
                                        <option value="Web Development"
                                            {{ old('project_category') == 'Web Development' ? 'selected' : '' }}>Web
                                            Development</option>
                                        <option value="Digital Marketing"
                                            {{ old('project_category') == 'Digital Marketing' ? 'selected' : '' }}>Digital
                                            Marketing</option>
                                        <option value="Business Development"
                                            {{ old('project_category') == 'Business Development' ? 'selected' : '' }}>
                                            Business Development</option>
                                        <option value="Graphics"
                                            {{ old('project_category') == 'Graphics' ? 'selected' : '' }}>Graphics</option>
                                        <option value="E-commerce"
                                            {{ old('project_category') == 'E-commerce' ? 'selected' : '' }}>E-Commerce
                                        </option>
                                    </select>
                                    @error('project_category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Project Deadline</label>
                                    <input type="date" name="project_deadline" value="{{ old('project_deadline') }}"
                                        class=" @error('project_deadline') is-invalid  @enderror form-control"
                                        min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-3">Client Requirements</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <textarea name="client_requirements" id="client_requirements" class="form-control p-3" style="width:100%;height:80px;">{{ old('client_requirements') }}</textarea>

                                </div>
                            </div>
                        </div>

                        <div class="mt-2 mb-3">

                            <div id="serviceContainer">
                                <!-- Dynamic service entries will be inserted here -->
                            </div>
                            <button type="button" class="reblateBtn p-2 mt-2" onclick="addService()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                    <path fill="#fff"
                                        d="M19.05 5.06c0-1.68-1.37-3.06-3.06-3.06s-3.07 1.38-3.06 3.06v7.87H5.06C3.38 12.93 2 14.3 2 15.99c0 1.68 1.38 3.06 3.06 3.06h7.87v7.86c0 1.68 1.37 3.06 3.06 3.06c1.68 0 3.06-1.37 3.06-3.06v-7.86h7.86c1.68 0 3.06-1.37 3.06-3.06c0-1.68-1.37-3.06-3.06-3.06h-7.86z" />
                                </svg>
                                Add Service
                            </button>


                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Total Amount</label>
                                    <input type="number" name="total_amount" class="form-control" disabled>
                                    <input type="hidden" id="hidden_total_amount" name="hidden_total_amount">
                                </div>
                            </div>
                        </div>

                        {{-- <h4 class="mt-3">Quotation Expires</h4> --}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Quotation Expires</label>
                                    <input type="date" name="quotation_expires"
                                        value="{{ old('quotation_expires') }}" min="{{ date('Y-m-d') }}"
                                        class="form-control @error('quotation_expires') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Currency ($)</label>
                                    <select name="currency" class="form-control" id="currency">
                                        <option value="USD" selected>USD ($)</option>
                                        <option value="EUR">EUR (€)</option>
                                        <option value="GBP">GBP (£)</option>
                                        <option value="AUD">AUD (A$)</option>
                                        <option value="CAD">CAD (C$)</option>
                                        <option value="CHF">CHF (Fr)</option>
                                        <option value="CNY">CNY (¥)</option>
                                        <option value="NZD">NZD (NZ$)</option>
                                        <option value="PKR">PKR (Rs)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Upfront %</label>
                                    <input type="number" name="upfront_percentage"
                                        value="{{ old('upfront_percentage') }}"
                                        class="form-control @error('upfront_percentage') is-invalid @enderror"
                                        id="upfront_percentage" onkeyup="changeAmount()" min="0" max="100"
                                        step="5">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Upfront (Amount)</label>
                                    <input type="number" id="amount_upfront" disabled class="form-control"
                                        step="5">
                                    <input type="hidden" name="amount_upfront" id="amount_upfront_2">
                                </div>
                            </div>
                        </div>
                        <h4 class="mt-3">Additional Notes</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="additional_notes" class="form-control" id=""
                                    style="width:100%;height:80x;resize:vertical;">{{ old('additional_notes') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <input type="submit" class="reblateBtn p-2" value="Send for Approval">
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <script>
            // Function to save services and tasks to sessionStorage
            function saveServicesToSession() {
                var services = [];

                // Iterate through each service container and store relevant data
                var serviceContainers = document.querySelectorAll('.service-container');
                serviceContainers.forEach(function(container) {
                    var service = {
                        id: container.id,
                        name: container.querySelector('.service-name').value,
                        amount: container.querySelector('.service-amount').value,
                        tasks: []
                    };

                    // Iterate through tasks within the current service container
                    var taskInputs = container.querySelectorAll('.task-input');
                    taskInputs.forEach(function(taskInput) {
                        service.tasks.push(taskInput.value);
                    });

                    services.push(service); // Push each service object to the services array
                });

                sessionStorage.setItem('services', JSON.stringify(services)); // Store services in sessionStorage
            }

            // Function to load services and tasks from sessionStorage
            function loadServicesFromSession() {
                var services = sessionStorage.getItem('services'); // Retrieve services from sessionStorage

                if (services) {
                    services = JSON.parse(services); // Parse JSON string back to array/object

                    // Iterate through services and recreate them dynamically
                    services.forEach(function(service) {
                        var container = document.createElement('div');
                        container.className = 'service-container';
                        container.id = service.id;

                        // Create HTML elements dynamically based on service data
                        container.innerHTML = `
                <div class="form-row mb-3">
                    <div class="col-md-4">
                        <label for="service-name-${service.id}">Service Name</label>
                        <input type="text" class="form-control service-name" id="service-name-${service.id}" value="${service.name}">
                    </div>
                    <div class="col-md-4">
                        <label for="service-amount-${service.id}">Amount</label>
                        <input type="number" class="form-control service-amount" id="service-amount-${service.id}" value="${service.amount}">
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger mt-4" onclick="removeService('${service.id}')">
                            Remove Service
                        </button>
                    </div>
                </div>
                <div id="tasks-container-${service.id}">
                    <!-- Tasks will be dynamically added here -->
                </div>
            `;

                        // Append the new service container to the main container
                        document.getElementById('serviceContainer').appendChild(container);

                        // Recreate tasks for this service
                        service.tasks.forEach(function(task) {
                            var taskContainer = document.createElement('div');
                            taskContainer.className = 'form-row mb-2';
                            taskContainer.innerHTML = `
                    <div class="col-md-8">
                        <input type="text" class="form-control task-input" value="${task}">
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger mt-2" onclick="removeTask('${service.id}', this)">
                            Remove Task
                        </button>
                    </div>
                `;
                            document.getElementById(`tasks-container-${service.id}`).appendChild(taskContainer);
                        });
                    });
                }
            }

            function changeAmount() {
                var currency = document.getElementById('currency').value;
                var upfront_percentage = document.getElementById('upfront_percentage').value;

                // Check if upfront_percentage is greater than 100 or less than 0
                if (upfront_percentage > 100 || upfront_percentage < 0) {
                    document.getElementById('upfront_percentage').value = ""; // Reset the value
                    upfront_percentage = 0; // Reset upfront_percentage to 0
                }

                var hidden_total_amount = document.getElementById('hidden_total_amount').value;
                if (hidden_total_amount == null) {
                    hidden_total_amount = 0;
                }

                var amount_upfront = document.getElementById('amount_upfront');
                var amount_upfront_2 = document.getElementById('amount_upfront_2');

                var result = (upfront_percentage / 100) * hidden_total_amount;
                amount_upfront.value = result;
                amount_upfront_2.value = result;
            }

            // Function to add a new service dynamically
            function addService() {
                var serviceIndex = Date.now(); // Generate a unique ID for the service container
                var container = document.createElement('div');
                container.className = 'service-container';
                container.id = `service-${serviceIndex}`;

                container.innerHTML = `
        <div class="form-row mb-3">
            <div class="col-md-4">
                <label for="service-name-${serviceIndex}">Service Name</label>
                <input type="text" class="form-control service-name" id="service-name-${serviceIndex}">
            </div>
            <div class="col-md-4">
                <label for="service-amount-${serviceIndex}">Amount</label>
                <input type="number" class="form-control service-amount" id="service-amount-${serviceIndex}">
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-danger mt-4" onclick="removeService('${serviceIndex}')">
                    Remove Service
                </button>
            </div>
        </div>
        <div id="tasks-container-${serviceIndex}">
            <!-- Tasks will be dynamically added here -->
        </div>
    `;

                document.getElementById('serviceContainer').appendChild(container);
            }

            // Function to remove a service
            function removeService(serviceId) {
                var serviceContainer = document.getElementById(`service-${serviceId}`);
                if (serviceContainer) {
                    serviceContainer.parentNode.removeChild(serviceContainer);
                }
            }

            // Function to add a task to a service dynamically
            function addTask(serviceId) {
                var taskContainer = document.createElement('div');
                taskContainer.className = 'form-row mb-2';
                taskContainer.innerHTML = `
        <div class="col-md-8">
            <input type="text" class="form-control task-input">
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-danger mt-2" onclick="removeTask('${serviceId}', this)">
                Remove Task
            </button>
        </div>
    `;
                document.getElementById(`tasks-container-${serviceId}`).appendChild(taskContainer);
            }

            // Function to remove a task from a service
            function removeTask(serviceId, element) {
                var taskContainer = element.parentNode.parentNode;
                taskContainer.parentNode.removeChild(taskContainer);
            }

            // Call loadServicesFromSession when the page loads to reload saved services
            window.onload = function() {
                loadServicesFromSession();
            };

            // Save services to sessionStorage when navigating away from the page or refreshing
            window.onbeforeunload = function() {
                saveServicesToSession();
            };

            function calculateTotalAmount() {
                var serviceAmountInputs = document.querySelectorAll('.service-amount');
                var totalAmountInput = document.querySelector('input[name="total_amount"]');
                var hiddenTotalAmountInput = document.getElementById(
                    'hidden_total_amount'); // Hidden input for total amount
                var totalAmount = 0;

                serviceAmountInputs.forEach(function(input) {
                    if (input.value) {
                        totalAmount += parseFloat(input.value);
                    }
                });

                totalAmountInput.value = totalAmount.toFixed(2); // Display total amount with two decimal places
                hiddenTotalAmountInput.value = totalAmount.toFixed(2); // Update hidden input with total amount
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script>
            $('#client_requirements').summernote({
                placeholder: 'Client Requirements',
                tabsize: 2,
                height: 100
            });
        </script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            var serviceIndex = 0; // Counter for unique service IDs

            function addService() {
                serviceIndex++; // Increment service index for unique IDs
                var container = document.getElementById('serviceContainer');
                var newService = document.createElement('div');
                newService.className = 'service-container';
                newService.id = `service${serviceIndex}`; // Assign an ID to the service container
                newService.innerHTML = `

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="selectService${serviceIndex}">Select Service</label>
            <select class="form-control" name="services[${serviceIndex}][name]" id="selectService${serviceIndex}" onchange="selectService(${serviceIndex})">
                <option value="">Please Select</option>
                <option value="Web Development">Web Development</option>
                <option value="Digital Marketing">Digital Marketing</option>
                <option value="Business Development">Business Development</option>
                <option value="Graphics">Graphics</option>
                <option value="E-commerce">E-Commerce</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="amount${serviceIndex}">Amount</label>
            <input type="number" class="form-control service-amount" id="amount${serviceIndex}" name="amounts[${serviceIndex}]" oninput="calculateTotalAmount()" required>
        </div>
        <div class="col-md-4 mb-3">
            <button type="button" class="btn btn-danger mt-4" onclick="removeService(${serviceIndex})">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="#fff" d="M19 12.998H5v-2h14z"/></svg>
                Remove Service
            </button>
        </div>
    </div>
    <div class="task-container" id="taskContainer${serviceIndex}">
        <!-- Tasks will be dynamically added here -->
    </div>
`;

                container.appendChild(newService);
            }

            function selectService(serviceId) {
                var selectService = document.getElementById(`selectService${serviceId}`);
                var selectedOption = selectService.options[selectService.selectedIndex].value;
                var taskContainer = document.getElementById(`taskContainer${serviceId}`);
                taskContainer.innerHTML = ''; // Clear existing tasks

                if (selectedOption) {
                    var addTaskButton = document.createElement('button');
                    addTaskButton.type = 'button';
                    addTaskButton.className = 'btn btn-primary btn-sm mb-2';
                    addTaskButton.textContent = 'Add Task';
                    addTaskButton.onclick = function() {
                        addTask(serviceId);
                    };
                    taskContainer.appendChild(addTaskButton);
                }
            }

            function addTask(serviceId) {
                var taskContainer = document.getElementById(`taskContainer${serviceId}`);
                var taskCount = taskContainer.querySelectorAll('.form-row').length + 1;
                var newTask = document.createElement('div');
                newTask.className = 'form-row';
                newTask.innerHTML = `
                    <div class="col-md-6 mb-3">
                        <label for="task${serviceId}_${taskCount}">Task ${taskCount}</label>
                        <input type="text" class="form-control" id="task${serviceId}_${taskCount}" name="tasks[${serviceId}][]" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="button" class="btn btn-danger mt-4" onclick="removeTask(${serviceId}, ${taskCount})">Remove Task</button>
                    </div>
                `;
                taskContainer.appendChild(newTask);
            }

            function removeService(serviceId) {
                var service = document.getElementById(`service${serviceId}`);
                service.parentNode.removeChild(service);
                calculateTotalAmount(); // Recalculate total amount after removing a service
            }

            function removeTask(serviceId, taskCount) {
                var taskContainer = document.getElementById(`taskContainer${serviceId}`);
                var taskToRemove = document.getElementById(`task${serviceId}_${taskCount}`).parentNode.parentNode;
                taskContainer.removeChild(taskToRemove);
            }

            function calculateTotalAmount() {
                var serviceAmountInputs = document.querySelectorAll('.service-amount');
                var totalAmountInput = document.querySelector('input[name="total_amount"]');
                var hiddenTotalAmountInput = document.getElementById('hidden_total_amount'); // Hidden input for total amount
                var totalAmount = 0;

                serviceAmountInputs.forEach(function(input) {
                    if (input.value) {
                        totalAmount += parseFloat(input.value);
                    }
                });

                totalAmountInput.value = totalAmount.toFixed(2); // Display total amount with two decimal places
                hiddenTotalAmountInput.value = totalAmount.toFixed(2); // Update hidden input with total amount
            }
        </script>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
