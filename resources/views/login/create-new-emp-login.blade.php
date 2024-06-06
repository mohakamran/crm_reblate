@extends('layouts.master')
@section('title')
    Create New Login Employee
@endsection
@section('page-title')
    Create New Login Employee
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12 container">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Fill below form to create new employee login.</p>

                        <br>
                        <h3>Login Details </h3>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" id="close-now">
                                {{ session('error') }}
                                <a type="button" onclick="hideNow()" class="close" data-dismiss="alert" aria-label="Close"
                                    style="float: right;">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" id="close-now">
                            {{ session('success') }}
                            <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                aria-label="Close" style="float: right;">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                    @endif

                        <hr>
                        <form method="POST" action="/create-login-new-employee-access">
                            @csrf

                            {{-- @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="close-now">
                                    {{ session('success') }}
                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            @endif --}}



                            <div class="row">

                                {{-- <input type="hidden" value="{{ $emp_login_code }}" name="emp_login_code_hidden"> --}}

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="text" name="emp_login_name"
                                            value="{{ old('emp_login_name') }}">
                                        {{-- <input type="hidden" value="{{ $emp_login_name }}" name="emp_login_name_hidden"> --}}
                                        <label for="">Employee Name <span class="text-danger">*</span> </label>
                                        @error('emp_login_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3 ">
                                        <input class="form-control" type="email" placeholder="User Name" min="0"
                                            name="emp_login_email" value="{{ old('emp_login_email') }}">
                                        {{-- <input type="hidden" value="{{ $emp_login_email }}" name="emp_login_email_hidden"> --}}
                                        <label for="">Employee Email <span class="text-danger">*</span> </label>
                                        @error('emp_login_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="emp_code"
                                            value="{{ old('emp_code') }}" placeholder="e.g 204sols">
                                        <label for="">Employee ID <span class="text-danger">*</span> </label>
                                        @error('emp_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <select name="emp_login_user_type_hidden" class="form-control" id="">
                                            <option value="" disabled selected>Select Employee type </option>
                                            <option value="employee"
                                                {{ old('emp_login_user_type_hidden') === 'employee' ? 'selected' : '' }}>
                                                Employee</option>
                                            <option value="manager"
                                                {{ old('emp_login_user_type_hidden') === 'manager' ? 'selected' : '' }}>
                                                Manager</option>
                                        </select>
                                        <label for="">Employee Type <span class="text-danger">*</span></label>
                                        @error('emp_login_user_type_hidden')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>




                            </div>


                            {{-- company details --}}
                            <br>
                            <h4>Company Details
                                <hr>
                            </h4>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control " placeholder="department"
                                            value="{{ isset($emp_data->department) ? $emp_data->department : old('employee_department') }}"
                                            type="text" name="employee_department">
                                        <label for="">Emp Department <span class="text-danger">*</span></label>
                                        @error('employee_department')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Employee Designation"
                                            name="employee_designation"
                                            value="{{ isset($emp_data->Emp_Designation) ? $emp_data->Emp_Designation : old('employee_designation') }}">
                                        @error('employee_designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <label for="">Emp Designation <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                {{-- @if (!isset($emp_data->Emp_Shift_Time))

                                                            @endif --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="employee_shift_time" id="">
                                            <option value="" selected disabled>Select Time Shift</option>
                                            <option value="Morning"
                                                {{ old('employee_shift_time') === 'Morning' ? 'selected' : '' }}>
                                                Morning Shift</option>
                                            <option value="Night"
                                                {{ old('employee_shift_time') === 'Morning' ? 'selected' : '' }}>Night
                                                Shift</option>
                                        </select>
                                        @error('employee_shift_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Emp Shift Time <span class="text-danger">*</span></label>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" value="{{ old('employee_joining_date') }}"
                                            placeholder="Employee Joining Date" name="employee_joining_date" type="date">
                                        @error('employee_joining_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Emp Joining Date <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                            </div>




                            <table class="table table-striped">
                                <tr>
                                    <th>Access</th>
                                    <th>All</th>
                                    <th>View</th>
                                    <th>Create</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                    <th>None</th>
                                    <th>Shift Data</th>
                                </tr>
                                <tr>
                                    <td>Employees</td>
                                    <td><input type="checkbox" id="emp_check_all" name="emp_access[]" value="all">
                                    </td>
                                    <td><input type="checkbox" id="emp_check_view" name="emp_access[]" value="view">
                                    </td>
                                    <td><input type="checkbox" id="emp_check_create" name="emp_access[]" value="create">
                                    </td>
                                    <td><input type="checkbox" id="emp_check_update" name="emp_access[]" value="update">
                                    </td>
                                    <td><input type="checkbox" id="emp_check_delete" name="emp_access[]" value="delete">
                                    </td>
                                    <td><input type="checkbox" id="emp_check_none" name="emp_access[]" value="none"
                                            checked></td>
                                    <td>
                                        <input type="radio" name="emp_data" value="both" checked> Both
                                        <input type="radio" name="emp_data" value="night"> Night
                                        <input type="radio" name="emp_data" value="day"> Day
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expenses</td>
                                    <td><input type="checkbox" id="expenses_check_all" name="expenses_access[]"
                                            value="all"></td>
                                    <td><input type="checkbox" id="expenses_check_view" name="expenses_access[]"
                                            value="view"></td>
                                    <td><input type="checkbox" id="expenses_check_create" name="expenses_access[]"
                                            value="create"></td>
                                    <td><input type="checkbox" id="expenses_check_update" name="expenses_access[]"
                                            value="update"></td>
                                    <td><input type="checkbox" id="expenses_check_delete" name="expenses_access[]"
                                            value="delete"></td>
                                    <td><input type="checkbox" id="expenses_check_none" name="expenses_access[]"
                                            value="none" checked></td>
                                    <td>
                                        <input type="radio" name="expenses_data" value="both" checked> Both
                                        <input type="radio" name="expenses_data" value="night"> Night
                                        <input type="radio" name="expenses_data" value="day"> Day
                                    </td>
                                </tr>

                                <tr>
                                    <td>Clients</td>
                                    <td><input type="checkbox" id="clients_check_all" name="clients_access[]"
                                            value="all"></td>
                                    <td><input type="checkbox" id="clients_check_view" name="clients_access[]"
                                            value="view"></td>
                                    <td><input type="checkbox" id="clients_check_create" name="clients_access[]"
                                            value="create"></td>
                                    <td><input type="checkbox" id="clients_check_update" name="clients_access[]"
                                            value="update"></td>
                                    <td><input type="checkbox" id="clients_check_delete" name="clients_access[]"
                                            value="delete"></td>
                                    <td><input type="checkbox" id="clients_check_none" name="clients_access[]"
                                            value="none" checked></td>
                                    <td>
                                        <input type="radio" name="clients_data" value="both" checked> Both
                                        <input type="radio" name="clients_data" value="night"> Night
                                        <input type="radio" name="clients_data" value="day"> Day
                                    </td>
                                </tr>

                                <tr>
                                    <td>Invoices</td>
                                    <td><input type="checkbox" id="invoices_check_all" name="invoices_access[]"
                                            value="all"></td>
                                    <td><input type="checkbox" id="invoices_check_view" name="invoices_access[]"
                                            value="view"></td>
                                    <td><input type="checkbox" id="invoices_check_create" name="invoices_access[]"
                                            value="create"></td>
                                    <td><input type="checkbox" id="invoices_check_update" name="invoices_access[]"
                                            value="update"></td>
                                    <td><input type="checkbox" id="invoices_check_delete" name="invoices_access[]"
                                            value="delete"></td>
                                    <td><input type="checkbox" id="invoices_check_none" name="invoices_access[]"
                                            value="none" checked></td>
                                    <td>
                                        <input type="radio" name="invoices_data" value="both" checked> Both
                                        <input type="radio" name="invoices_data" value="night"> Night
                                        <input type="radio" name="invoices_data" value="day"> Day
                                    </td>
                                </tr>
                                <tr>
                                    <td>Salary Slips</td>
                                    <td><input type="checkbox" id="salary_slip_check_all" name="salary_slip_access[]"
                                            value="all"></td>
                                    <td><input type="checkbox" id="salary_slip_check_view" name="salary_slip_access[]"
                                            value="view"></td>
                                    <td><input type="checkbox" id="salary_slip_check_create" name="salary_slip_access[]"
                                            value="create"></td>
                                    <td><input type="checkbox" id="salary_slip_check_update" name="salary_slip_access[]"
                                            value="update"></td>
                                    <td><input type="checkbox" id="salary_slip_check_delete" name="salary_slip_access[]"
                                            value="delete"></td>
                                    <td><input type="checkbox" id="salary_slip_check_none" name="salary_slip_access[]"
                                            value="none" checked></td>
                                    <td>
                                        <input type="radio" name="salary_slip_data" value="both" checked> Both
                                        <input type="radio" name="salary_slip_data" value="night"> Night
                                        <input type="radio" name="salary_slip_data" value="day"> Day
                                    </td>
                                </tr>
                                <tr>
                                    <td>Reports</td>
                                    <td><input type="checkbox" id="reports_check_all" name="reports_access[]"
                                            value="all"></td>
                                    <td><input type="checkbox" id="reports_check_view" name="reports_access[]"
                                            value="view"></td>
                                    <td><input type="checkbox" id="reports_check_create" name="reports_access[]"
                                            value="create"></td>
                                    <td><input type="checkbox" id="reports_check_update" name="reports_access[]"
                                            value="update"></td>
                                    <td><input type="checkbox" id="reports_check_delete" name="reports_access[]"
                                            value="delete"></td>
                                    <td><input type="checkbox" id="reports_check_none" name="reports_access[]"
                                            value="none" checked></td>
                                    <td>
                                        <input type="radio" name="reports_data" value="both" checked> Both
                                        <input type="radio" name="reports_data" value="night"> Night
                                        <input type="radio" name="reports_data" value="day"> Day
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tasks</td>
                                    <td><input type="checkbox" id="tasks_check_all" name="tasks_access[]"
                                            value="all"></td>
                                    <td><input type="checkbox" id="tasks_check_view" name="tasks_access[]"
                                            value="view"></td>
                                    <td><input type="checkbox" id="tasks_check_create" name="tasks_access[]"
                                            value="create"></td>
                                    <td><input type="checkbox" id="tasks_check_update" name="tasks_access[]"
                                            value="update"></td>
                                    <td><input type="checkbox" id="tasks_check_delete" name="tasks_access[]"
                                            value="delete"></td>
                                    <td><input type="checkbox" id="tasks_check_none" name="tasks_access[]"
                                            value="none" checked></td>
                                    <td>

                                        <input type="radio" name="tasks_data" value="both" checked> Both
                                        <input type="radio" name="tasks_data" value="night" > Night
                                        <input type="radio" name="tasks_data" value="day"  > Day
                                    </td>
                                </tr>
                                <tr>
                                    <td>Attendance</td>
                                    <td><input type="checkbox" id="attendance_check_all" name="attendance_access[]"
                                            value="all"></td>
                                    <td><input type="checkbox" id="attendance_check_view" name="attendance_access[]"
                                            value="view"></td>
                                    <td><input type="checkbox" id="attendance_check_create" name="attendance_access[]"
                                            value="create"></td>
                                    <td><input type="checkbox" id="attendance_check_update" name="attendance_access[]"
                                            value="update"></td>
                                    <td><input type="checkbox" id="attendance_check_delete" name="attendance_access[]"
                                            value="delete"></td>
                                    <td><input type="checkbox" id="attendance_check_none" name="attendance_access[]"
                                            value="none" checked></td>
                                    <td>
                                        <input type="radio" name="attendance_data" value="both" checked> Both
                                        <input type="radio" name="attendance_data" value="night" > Night
                                        <input type="radio" name="attendance_data" value="day" > Day
                                    </td>
                                </tr>

                            </table>


                            <div>
                                <br>

                                <button type="submit" class="btn btn-primary  w-md" target="_blank"
                                    style="background-color: #14213D ; border-color: #fff;">Create Login</button>
                                {{-- <a href="/preview-salary/{{$id}}" target="_blank" class="btn btn-danger">Preview</a> --}}
                                <a href="/create-new-login" class="btn btn-danger">Go Back</a>

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
            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }

            function addRow() {
                // Create a new row div
                var newRow = document.createElement("div");
                newRow.className = "row"; // You can style this class as needed

                // Create the first input within the row
                var input1 = document.createElement("input");
                input1.type = "text";
                input1.name = "field1[]"; // Use array-like syntax if needed
                input1.placeholder = "Enter something for Field 1";
                newRow.appendChild(input1);

                // Create the second input within the row
                var input2 = document.createElement("input");
                input2.type = "tel";
                input2.name = "field2[]"; // Use array-like syntax if needed
                input2.placeholder = "Enter something for Field 2";
                newRow.appendChild(input2);

                // Append the new row to the container
                document.getElementById("fieldsContainer").appendChild(newRow);
            }


            //  // Function to confirm deletion with SweetAlert
            //  function confirmDelete(id) {
            //         Swal.fire({
            //             title: 'Are you sure?',
            //             text: 'Make sure you have entered correct data!',
            //             icon: 'warning',
            //             showCancelButton: true,
            //             confirmButtonText: 'Yes',
            //             cancelButtonText: 'No',
            //             confirmButtonColor: '#FF5733', // Red color for "Yes"
            //             cancelButtonColor: '#4CAF50', // Green color for "No"
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 // Send an AJAX request to delete the task
            //                 $.ajax({
            //                     url: '/generate-new/'+id,
            //                     method: 'POST', // Use the DELETE HTTP method
            //                     success: function() {
            //                         // Provide user feedback
            //                         Swal.fire({
            //                             title: 'Success!',
            //                             text: 'The Salary Slip has been added.',
            //                             icon: 'success'
            //                         }).then(() => {
            //                             location.reload(); // Refresh the page
            //                         });
            //                     },
            //                     error: function(xhr, status, error) {
            //                         // Handle errors, you can display an error message to the user
            //                         console.error('Error:', error);
            //                         Swal.fire({
            //                             title: 'Error!',
            //                             text: 'An error occurred while sending the salary slip!',
            //                             icon: 'error'
            //                         });
            //                     }
            //                 });

            //             }
            //         });
            //     }

            //     function confirmSalary(id, event) {

            //         confirmDelete(id);
            //     }

            //                     const exChildCategory = document.getElementById("ex_child_category");

            //                     // Define a mapping of parent categories to child categories
            //                     const parentToChildCategories = {
            //                         "Office": ["Rent", "Blectricity Bill","Water Bill", "Kitchen","Internet Bill","Others", "Charity"],
            //                         "Salaries": ["Day Shift", "Night Shift"],
            //                         "Maintenance": ["none"],
            //                         "Day Food": ["none"],
            //                         "Marketing": ["none"]
            //                     };

            //                     // Function to update the second select box options based on the first select box selection
            //                     function updateChildCategory() {
            //                         const selectedParentCategory = exParentCategory.value;
            //                         const childCategories = parentToChildCategories[selectedParentCategory] || [];

            //                         // Clear existing options
            //                         exChildCategory.innerHTML = "";

            //                         // Add new options
            //                         childCategories.forEach(childCategory => {
            //                             const option = document.createElement("option");
            //                             option.value = childCategory;
            //                             option.text = childCategory;
            //                             exChildCategory.appendChild(option);
            //                         });
            //                     }

            //                     // Add an event listener to the first select box to update the second select box
            //                     exParentCategory.addEventListener("change", updateChildCategory);

            //                     // Initial update
            //                     updateChildCategory();

            //

            function handleCheckboxChange(checkboxId, groupId) {
                var checkbox = document.getElementById(checkboxId);
                var groupCheckboxes = document.querySelectorAll('[name="' + groupId + '"]');

                if (checkboxId.endsWith("_check_all")) {
                    groupCheckboxes.forEach(function(item) {
                        if (item.id !== checkboxId.replace("_all", "_none")) {
                            item.checked = checkbox.checked;
                        }
                    });

                    if (checkbox.checked) {
                        // If "All" is checked, check create, update, delete, and view checkboxes
                        checkCreateUpdateDeleteView(checkboxId.replace("_all", ""));

                        // If "None" is checked, uncheck it
                        document.getElementById(checkboxId.replace("_all", "_none")).checked = false;
                    } else {
                        // If "All" is unchecked, uncheck create, update, delete, and view checkboxes
                        uncheckCreateUpdateDeleteView(checkboxId.replace("_all", ""));
                    }
                } else if (checkboxId.endsWith("_check_none") && checkbox.checked) {
                    groupCheckboxes.forEach(function(item) {
                        if (item.id === checkboxId) {
                            item.checked = true;
                        } else {
                            item.checked = false;
                        }
                    });
                } else if (checkboxId.endsWith("_check_none") && !checkbox.checked) {
                    // Do nothing when "None" is unchecked
                } else {
                    // If any other checkbox is checked, uncheck "None"
                    document.getElementById(checkboxId.replace("_all", "_none")).checked = false;
                }
            }

            function checkCreateUpdateDeleteView(prefix) {
                document.getElementById(prefix + "_create").checked = true;
                document.getElementById(prefix + "_update").checked = true;
                document.getElementById(prefix + "_delete").checked = true;
                document.getElementById(prefix + "_view").checked = true;
            }

            function uncheckCreateUpdateDeleteView(prefix) {
                document.getElementById(prefix + "_create").checked = false;
                document.getElementById(prefix + "_update").checked = false;
                document.getElementById(prefix + "_delete").checked = false;
                document.getElementById(prefix + "_view").checked = false;
            }

            // All checked boxes
            document.getElementById("tasks_check_all").addEventListener("change", function() {
                handleCheckboxChange("tasks_check_all", "tasks_access[]");
            });

            document.getElementById("attendance_check_all").addEventListener("change", function() {
                handleCheckboxChange("attendance_check_all", "attendance_access[]");
            });
            document.getElementById("reports_check_all").addEventListener("change", function() {
                handleCheckboxChange("reports_check_all", "reports_access[]");
            });
            document.getElementById("invoices_check_all").addEventListener("change", function() {
                handleCheckboxChange("invoices_check_all", "invoices_access[]");
            });
            document.getElementById("salary_slip_check_all").addEventListener("change", function() {
                handleCheckboxChange("salary_slip_check_all", "salary_slip_access[]");
            });
            document.getElementById("clients_check_all").addEventListener("change", function() {
                handleCheckboxChange("clients_check_all", "clients_access[]");
            });
            document.getElementById("expenses_check_all").addEventListener("change", function() {
                handleCheckboxChange("expenses_check_all", "expenses_access[]");
            });
            document.getElementById("emp_check_all").addEventListener("change", function() {
                handleCheckboxChange("emp_check_all", "emp_access[]");
            });

            // None Checkboxes
            document.getElementById("tasks_check_none").addEventListener("change", function() {
                handleCheckboxChange("tasks_check_none", "tasks_access[]");
            });
            document.getElementById("attendance_check_none").addEventListener("change", function() {
                handleCheckboxChange("attendance_check_none", "attendance_access[]");
            });
            document.getElementById("reports_check_none").addEventListener("change", function() {
                handleCheckboxChange("reports_check_none", "reports_access[]");
            });
            document.getElementById("invoices_check_none").addEventListener("change", function() {
                handleCheckboxChange("invoices_check_none", "invoices_access[]");
            });
            document.getElementById("salary_slip_check_none").addEventListener("change", function() {
                handleCheckboxChange("salary_slip_check_none", "salary_slip_access[]");
            });
            document.getElementById("clients_check_none").addEventListener("change", function() {
                handleCheckboxChange("clients_check_none", "clients_access[]");
            });
            document.getElementById("expenses_check_none").addEventListener("change", function() {
                handleCheckboxChange("expenses_check_none", "expenses_access[]");
            });
            document.getElementById("emp_check_none").addEventListener("change", function() {
                handleCheckboxChange("emp_check_none", "emp_access[]");
            });
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
