@extends('layouts.master')
@section('title')
    {{ $full_name }}
@endsection
@section('page-title')
    {{ $full_name }}
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12 container">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Fill below form to update {{ $full_name }}'s login access.</p>
                        <br>
                        <h3>Update Login Details </h3>
                        <hr>
                        <form method="post" action="/update-login-access/{{ $emp_code }}">
                            @csrf

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="close-now">
                                    {{ session('success') }}
                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" id="close-now">
                                    {{ session('error') }}
                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            @endif



                            <div class="row">

                                <input type="hidden" value="{{ $emp_code }}" name="emp_login_code_hidden">

                                <div class="col-md-4">
                                    <div class="form-floating mb-3 inputboxcolor">
                                        <input class="form-control" style="background-color: transparent; border:none;" type="text" placeholder="text" name="emp_login_name"
                                            disabled value="{{ $full_name }}">
                                        <input type="hidden" value="{{ $full_name }}" name="emp_login_name_hidden">
                                        <label for="">Employee Name</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3 inputboxcolor">
                                        <input class="form-control" style="background-color: transparent; border:none;" type="text" placeholder="User Name" disabled
                                            value="{{ $emp_email }}" min="0" name="emp_login_email">
                                        <input type="hidden" value="{{ $emp_email }}" name="emp_login_email_hidden">
                                        <label for="">Employee Email </label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3 inputboxcolor">
                                        <select name="emp_login_user_type_hidden" style="background-color: transparent; border:none;" class="form-control" id="">
                                            <option value="employee" {{ $employee_type == 'employee' ? 'selected' : '' }}>
                                                Employee</option>
                                            <option value="manager" {{ $employee_type == 'manager' ? 'selected' : '' }}>
                                                Manager</option>
                                        </select>
                                        <label for="">Employee Type </label>
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
                                    @php
                                        $employees_accessArray = explode(',', $employees_access);
                                    @endphp
                                    <td>Employees</td>
                                    <td><input {{ in_array('all', $employees_accessArray) ? 'checked' : '' }} id="emp_check_all"
                                            type="checkbox" name="emp_access[]" value="all"></td>
                                    <td><input {{ in_array('view', $employees_accessArray) ? 'checked' : '' }} id="emp_check_view"
                                            type="checkbox" name="emp_access[]" value="view"></td>
                                    <td><input {{ in_array('create', $employees_accessArray) ? 'checked' : '' }} id="emp_check_create"
                                            type="checkbox" name="emp_access[]" value="create"></td>
                                    <td><input {{ in_array('update', $employees_accessArray) ? 'checked' : '' }} id="emp_check_update"
                                            type="checkbox" name="emp_access[]" value="update"></td>
                                    <td><input {{ in_array('delete', $employees_accessArray) ? 'checked' : '' }} id="emp_check_delete"
                                            type="checkbox" name="emp_access[]" value="delete"></td>
                                    <td><input {{ in_array('none', $employees_accessArray) ? 'checked' : '' }} id="emp_check_none"
                                            type="checkbox" name="emp_access[]" value="none"></td>
                                            <td>
                                                <input type="radio" name="emp_data" value="both" {{($emp_access == "both") ? 'checked' : ''}}> Both
                                                <input type="radio" name="emp_data" value="night" {{($emp_access == "night") ? 'checked' : ''}}> Night
                                                <input type="radio" name="emp_data" value="day" {{($emp_access == "day") ? 'checked' : ''}}> Day
                                            </td>
                                </tr>
                                <tr>
                                    <td>Expenses</td>
                                    @php
                                        $expenses_accessArray = explode(',', $expenses_access);
                                    @endphp
                                    <td><input type="checkbox" id="expenses_check_all"
                                            {{ in_array('all', $expenses_accessArray) ? 'checked' : '' }}
                                            name="expenses_access[]" value="all"></td>
                                    <td><input type="checkbox" id="expenses_check_view"
                                            {{ in_array('view', $expenses_accessArray) ? 'checked' : '' }}
                                            name="expenses_access[]" value="view"></td>
                                    <td><input type="checkbox" id="expenses_check_create"
                                            {{ in_array('create', $expenses_accessArray) ? 'checked' : '' }}
                                            name="expenses_access[]" value="create"></td>
                                    <td><input type="checkbox" id="expenses_check_update"
                                            {{ in_array('update', $expenses_accessArray) ? 'checked' : '' }}
                                            name="expenses_access[]" value="update"></td>
                                    <td><input type="checkbox" id="expenses_check_delete"
                                            {{ in_array('delete', $expenses_accessArray) ? 'checked' : '' }}
                                            name="expenses_access[]" value="delete"></td>
                                    <td><input type="checkbox" id="expenses_check_none"
                                            {{ in_array('none', $expenses_accessArray) ? 'checked' : '' }}
                                            name="expenses_access[]" value="none"></td>
                                            <td>
                                                <input type="radio" name="expenses_data" value="both" {{($expenses_data == "both") ? 'checked' : ''}}> Both
                                                <input type="radio" name="expenses_data" value="night" {{($expenses_data == "night") ? 'checked' : ''}}> Night
                                                <input type="radio" name="expenses_data" value="day" {{($expenses_data == "day") ? 'checked' : ''}}> Day
                                            </td>
                                </tr>

                                <tr>
                                    <td>Clients</td>
                                    @php
                                        $clients_accessArray = explode(',', $clients_access);
                                    @endphp
                                    <td><input type="checkbox" id="clients_check_all"
                                            {{ in_array('all', $clients_accessArray) ? 'checked' : '' }}
                                            name="clients_access[]" value="all"></td>
                                    <td><input type="checkbox" id="clients_check_view"
                                            {{ in_array('view', $clients_accessArray) ? 'checked' : '' }}
                                            name="clients_access[]" value="view"></td>
                                    <td><input type="checkbox" id="clients_check_create"
                                            {{ in_array('create', $clients_accessArray) ? 'checked' : '' }}
                                            name="clients_access[]" value="create"></td>
                                    <td><input type="checkbox" id="clients_check_update"
                                            {{ in_array('update', $clients_accessArray) ? 'checked' : '' }}
                                            name="clients_access[]" value="update"></td>
                                    <td><input type="checkbox" id="clients_check_delete"
                                            {{ in_array('delete', $clients_accessArray) ? 'checked' : '' }}
                                            name="clients_access[]" value="delete"></td>
                                    <td><input type="checkbox" id="clients_check_none"
                                            {{ in_array('none', $clients_accessArray) ? 'checked' : '' }}
                                            name="clients_access[]" value="none"></td>
                                            <td>
                                                <input type="radio" name="clients_data" value="both" {{($clients_data == "both") ? 'checked' : ''}}> Both
                                                <input type="radio" name="clients_data" value="night" {{($clients_data == "night") ? 'checked' : ''}}> Night
                                                <input type="radio" name="clients_data" value="day" {{($clients_data == "day") ? 'checked' : ''}}> Day
                                            </td>
                                </tr>

                                <tr>
                                    <td>Invoices</td>
                                    @php
                                        $invoices_accessArray = explode(',', $invoices_access);
                                    @endphp
                                    <td><input type="checkbox" id="invoices_check_all"
                                            {{ in_array('all', $invoices_accessArray) ? 'checked' : '' }}
                                            name="invoices_access[]" value="all"></td>
                                    <td><input type="checkbox" id="invoices_check_view"
                                            {{ in_array('view', $invoices_accessArray) ? 'checked' : '' }}
                                            name="invoices_access[]" value="view"></td>
                                    <td><input type="checkbox" id="invoices_check_create"
                                            {{ in_array('create', $invoices_accessArray) ? 'checked' : '' }}
                                            name="invoices_access[]" value="create"></td>
                                    <td><input type="checkbox" id="invoices_check_update"
                                            {{ in_array('update', $invoices_accessArray) ? 'checked' : '' }}
                                            name="invoices_access[]" value="update"></td>
                                    <td><input type="checkbox" id="invoices_check_delete"
                                            {{ in_array('delete', $invoices_accessArray) ? 'checked' : '' }}
                                            name="invoices_access[]" value="delete"></td>
                                    <td><input type="checkbox" id="invoices_check_none"
                                            {{ in_array('none', $invoices_accessArray) ? 'checked' : '' }}
                                            name="invoices_access[]" value="none"></td>
                                            <td>
                                                <input type="radio" name="invoices_data" value="both" {{($invoices_data == "both") ? 'checked' : ''}}> Both
                                                <input type="radio" name="invoices_data" value="night" {{($invoices_data == "night") ? 'checked' : ''}}> Night
                                                <input type="radio" name="invoices_data" value="day" {{($invoices_data == "day") ? 'checked' : ''}}> Day
                                            </td>
                                </tr>
                                <tr>
                                    <td>Salary Slips</td>
                                    @php
                                        $salary_slips_accessArray = explode(',', $salary_slips_access);
                                    @endphp
                                    <td><input type="checkbox" id="salary_slip_check_all"
                                            {{ in_array('all', $salary_slips_accessArray) ? 'checked' : '' }}
                                            name="salary_slip_access[]" value="all"></td>
                                    <td><input type="checkbox" id="salary_slip_check_view"
                                            {{ in_array('view', $salary_slips_accessArray) ? 'checked' : '' }}
                                            name="salary_slip_access[]" value="view"></td>
                                    <td><input type="checkbox" id="salary_slip_check_create"
                                            {{ in_array('create', $salary_slips_accessArray) ? 'checked' : '' }}
                                            name="salary_slip_access[]" value="create"></td>
                                    <td><input type="checkbox" id="salary_slip_check_update"
                                            {{ in_array('update', $salary_slips_accessArray) ? 'checked' : '' }}
                                            name="salary_slip_access[]" value="update"></td>
                                    <td><input type="checkbox" id="salary_slip_check_delete"
                                            {{ in_array('delete', $salary_slips_accessArray) ? 'checked' : '' }}
                                            name="salary_slip_access[]" value="delete"></td>
                                    <td><input type="checkbox" id="salary_slip_check_none"
                                            {{ in_array('none', $salary_slips_accessArray) ? 'checked' : '' }}
                                            name="salary_slip_access[]" value="none"></td>
                                            <td>
                                                <input type="radio" name="salary_slip_data" value="both" {{($salary_slip_data == "both") ? 'checked' : ''}}> Both
                                                <input type="radio" name="salary_slip_data" value="night" {{($salary_slip_data == "night") ? 'checked' : ''}} > Night
                                                <input type="radio" name="salary_slip_data" value="day" {{($salary_slip_data == "day") ? 'checked' : ''}}> Day
                                            </td>
                                </tr>
                                <tr>
                                    <td>Reports</td>
                                    @php
                                        $reports_accessArray = explode(',', $reports_access);
                                    @endphp
                                    <td><input type="checkbox" id="reports_check_all"
                                            {{ in_array('all', $reports_accessArray) ? 'checked' : '' }}
                                            name="reports_access[]" value="all"></td>
                                    <td><input type="checkbox" id="reports_check_view"
                                            {{ in_array('view', $reports_accessArray) ? 'checked' : '' }}
                                            name="reports_access[]" value="view"></td>
                                    <td><input type="checkbox" id="reports_check_create"
                                            {{ in_array('create', $reports_accessArray) ? 'checked' : '' }}
                                            name="reports_access[]" value="create"></td>
                                    <td><input type="checkbox" id="reports_check_update"
                                            {{ in_array('update', $reports_accessArray) ? 'checked' : '' }}
                                            name="reports_access[]" value="update"></td>
                                    <td><input type="checkbox" id="reports_check_delete"
                                            {{ in_array('delete', $reports_accessArray) ? 'checked' : '' }}
                                            name="reports_access[]" value="delete"></td>
                                    <td><input type="checkbox" id="reports_check_none"
                                            {{ in_array('none', $reports_accessArray) ? 'checked' : '' }}
                                            name="reports_access[]" value="none"></td>
                                            <td>
                                                <input type="radio" name="reports_data" value="both" {{($reports_data == "both") ? 'checked' : ''}}> Both
                                                <input type="radio" name="reports_data" value="night" {{($reports_data == "night") ? 'checked' : ''}}> Night
                                                <input type="radio" name="reports_data" value="day" {{($reports_data == "day") ? 'checked' : ''}}> Day
                                            </td>
                                </tr>
                                <tr>
                                    <td>Tasks</td>
                                    @php
                                        $tasks_accessArray = explode(',', $tasks_access);
                                    @endphp
                                    <td><input type="checkbox" id="tasks_check_all"
                                            {{ in_array('all', $tasks_accessArray) ? 'checked' : '' }}
                                            name="tasks_access[]" value="all"></td>
                                    <td><input type="checkbox" id="tasks_check_view"
                                            {{ in_array('view', $tasks_accessArray) ? 'checked' : '' }}
                                            name="tasks_access[]" value="view"></td>
                                    <td><input type="checkbox" id="tasks_check_create"
                                            {{ in_array('create', $tasks_accessArray) ? 'checked' : '' }}
                                            name="tasks_access[]" value="create"></td>
                                    <td><input type="checkbox" id="tasks_check_update"
                                            {{ in_array('update', $tasks_accessArray) ? 'checked' : '' }}
                                            name="tasks_access[]" value="update"></td>
                                    <td><input type="checkbox" id="tasks_check_delete"
                                            {{ in_array('delete', $tasks_accessArray) ? 'checked' : '' }}
                                            name="tasks_access[]" value="delete"></td>
                                    <td><input type="checkbox" id="tasks_check_none"
                                            {{ in_array('none', $tasks_accessArray) ? 'checked' : '' }}
                                            name="tasks_access[]" value="none"></td>
                                            <td>
                                                <input type="radio" name="tasks_data" value="both" {{($tasks_data == "both") ? 'checked' : ''}}> Both
                                                <input type="radio" name="tasks_data" value="night" {{($tasks_data == "night") ? 'checked' : ''}}> Night
                                                <input type="radio" name="tasks_data" value="day" {{($tasks_data == "day") ? 'checked' : ''}}> Day
                                            </td>
                                </tr>
                                <tr>
                                    @php
                                        $attendanceAccessArray = explode(',', $attendance_access);
                                    @endphp
                                    <td>Attendance</td>
                                    <td><input type="checkbox"
                                            {{ in_array('all', $attendanceAccessArray) ? 'checked' : '' }}
                                            id="attendance_check_all" name="attendance_access[]" value="all"></td>
                                    <td><input type="checkbox"
                                            {{ in_array('view', $attendanceAccessArray) ? 'checked' : '' }}
                                            id="attendance_check_view" name="attendance_access[]" value="view"></td>
                                    <td><input type="checkbox"
                                            {{ in_array('create', $attendanceAccessArray) ? 'checked' : '' }}
                                            id="attendance_check_create" name="attendance_access[]" value="create"></td>
                                    <td><input type="checkbox"
                                            {{ in_array('update', $attendanceAccessArray) ? 'checked' : '' }}
                                            id="attendance_check_update" name="attendance_access[]" value="update"></td>
                                    <td><input type="checkbox"
                                            {{ in_array('delete', $attendanceAccessArray) ? 'checked' : '' }}
                                            id="attendance_check_delete" name="attendance_access[]" value="delete"></td>
                                    <td><input type="checkbox"
                                            {{ in_array('none', $attendanceAccessArray) ? 'checked' : '' }}
                                            id="attendance_check_none" name="attendance_access[]" value="none" >
                                    </td>

                                    <td>
                                        <input type="radio" name="attendance_data" value="both" {{($attendance_data == "both") ? 'checked' : ''}}> Both
                                        <input type="radio" name="attendance_data" value="night" {{($attendance_data == "night") ? 'checked' : ''}}> Night
                                        <input type="radio" name="attendance_data" value="day" {{($attendance_data == "day") ? 'checked' : ''}}> Day
                                    </td>

                                </tr>
                            </table>


                            <div>
                                <br>

                                <button type="submit" class="reblateBtn px-4 py-2 w-md" target="_blank">Update Login</button>
                                {{-- <a href="/preview-salary/{{$id}}" target="_blank" class="btn btn-danger">Preview</a> --}}
                                <a href="/create-new-login" class="reblateBtn px-4 py-2 w-md">Go Back</a>

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
