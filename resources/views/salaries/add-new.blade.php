@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('page-title')
    {{ $title }}
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Fill below form to add new employee. Fields with(<span
                                style="color:red;">*</span>) are mandatory to fill, remaining are optional.</p>
                        <br>
                        <h3>Employee Details</h3><hr>
                        <form method="post" action="{{$route}}"  enctype="multipart/form-data">
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

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="email" name="emp_code"
                                        disabled
                                        value="{{$emp->Emp_Code}}">
                                        <input type="hidden" value="{{$emp->Emp_Code}}" name="emp_code_hidden">
                                        <label for="">Employee Code</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="User Name"
                                        disabled
                                        value="{{$emp->Emp_Full_Name}}" min="0" name="emp_name">
                                        <input type="hidden" value="{{$emp->Emp_Full_Name}}" name="emp_name_hidden">

                                        <label for="">Employee Name </label>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="email" placeholder="email"
                                        disabled
                                        value="{{$emp->Emp_Email}}" name="emp_email">

                                        <input type="hidden" value="{{$emp->Emp_Email}}" name="emp_email_hidden">
                                        @error('ex_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Employee Email</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="User Name" name="emp_designation"

                                        disabled
                                            value="{{$emp_date_of_joining}}" min="0">
                                            <input type="hidden" value="{{$emp_date_of_joining}}" name="emp_date_of_joining_hidden">
                                        <label for="">Employee Date Of Joining </label>

                                    </div>
                                </div>


                            </div>
                            <div class="row">


                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="email" name="emp_shift_time"
                                        disabled
                                        value="{{$emp_month_salary}}">
                                        <input type="hidden" value="{{$emp_month_salary}}" name="emp_month_salary_hidden">
                                        <label for="">Employee Month Salary</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="User Name" name="emp_designation"

                                        disabled
                                            value="{{$emp->Emp_Designation}}" min="0">
                                            <input type="hidden" value="{{$emp->Emp_Designation}}" name="emp_designation_hidden">
                                        <label for="">Employee Designation </label>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="email" name="emp_shift_time"
                                        disabled
                                        value="{{$emp->Emp_Shift_Time}}">
                                        <input type="hidden" value="{{$emp->Emp_Shift_Time}}" name="emp_shift_time_hidden">
                                        <label for="">Employee Shift Time</label>
                                    </div>
                                </div>

                            </div>


                            <h3>Salary Details</h3><hr>

                            <div class="form-group mt-30 row">
                                <div class="col-md-3 col-sm-12">
                                    <label  required class=" col-form-label">Basic Salary</label>
                                    <input class="form-control" type="number" name="emp_basic_salary" min="0" id="basicSalary" onchange="calculateSalary()"
                                    value="0">

                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="example-text-input" required class=" col-form-label">KPI Bonus</label>
                                    <input class="form-control" type="number" name="emp_kpi_bonus" min="0" id="kpiBonus" onchange="calculateSalary()"
                                    value="0">

                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label  required class=" col-form-label">Project Bonus</label>
                                    <input class="form-control" type="number" name="emp_project_bonus" min="0" id="projectBonus" onchange="calculateSalary()"
                                    value="0">

                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label  required class=" col-form-label">Designation Bonus</label>
                                    <input class="form-control" type="number" id="emp_designation_bonus" name="emp_designation_bonus" min="0" id="" onchange="calculateSalary()"
                                    value="0">
                                </div>
                            </div>

                            <div class="form-group  row">

                                <div class="col-md-2 col-sm-12">
                                    <label for="example-text-input" required class=" col-form-label">Absent Days</label>
                                    <input class="form-control" type="number" name="emp_absent" min="0"
                                    value="0">

                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label  required class=" col-form-label" >Travel Allowence</label>
                                    <input class="form-control"  min="0" id="emp_travel_allowence"  name="emp_travel_allowence" type="number" onchange="calculateSalary()"
                                    value="0">
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label  required class=" col-form-label" >Leave Days</label>
                                    <input class="form-control"  min="0"  name="emp_leave" type="number"
                                    value="0">
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="example-text-input" min="0" required class=" col-form-label">Deduction</label>
                                    <input class="form-control" type="number" value="0" name="emp_deduction" min="0" id="deduction" onchange="calculateSalary()"
                                        >

                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="example-text-input" min="0" required class=" col-form-label">No of Working Days</label>
                                    <input class="form-control" type="number" value="0" name="emp_no_of_working_days" min="0" id=""
                                        >

                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-12 col-sm-12">
                                    <label  required class=" col-form-label"  >Reason of Deduction</label>

                                    <textarea class="form-control" rows="5" name="emp_reason_deduction" placeholder=""></textarea>
                                    <br>
                               </div>
                            </div>
                            <div class="form-group  row mb-3">
                                <div class="col-md-4 col-sm-12">
                                    <label  required class=" col-form-label" >Total Salary</label>
                                    <input class="form-control" type="number" name="emp_total_salary" disabled min="0" id="totalSalary"
                                    value="0">
                                    <input type="hidden" name="emp_total_salary_hidden" id="emp_total_salary_hidden">
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <label  required class=" col-form-label" > Deducation</label>
                                    <input class="form-control" type="number" name="emp_deduction" disabled min="0" id="displayDeduction"
                                    value="0">
                                    <input type="hidden" name="emp_deduction_hidden" id="emp_deduction_hidden">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label  required class=" col-form-label" >Net Salary</label>
                                    <input class="form-control" type="number" name="emp_net_salary" disabled min="0"  id="netSalary"
                                    value="0">
                                    <input type="hidden" name="emp_net_salary_hidden" id="emp_net_salary_hidden">
                                </div>
                            </div>

                            <br>

                            {{-- <div class="">
                                <input type="checkbox" class="checbox"> Send Email to <strong>{{$emp->Emp_Full_Name}}</strong> 😂😂
                            </div> --}}

                            <div>
                                <br>

                                <button type="submit" onclick="confirmSalary({{ $emp->id }})" class="btn btn-primary  w-md" target="_blank"
                                    style="background-color: #14213D ; border-color: #fff;">{{ $btn_text }}</button>
                                    {{-- <a href="/preview-salary/{{$id}}" target="_blank" class="btn btn-danger">Preview</a> --}}
                                <a href="/generate-new-salary-slip" class="btn btn-danger">Go Back</a>

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
            function calculateSalary() {
            const basicSalary = parseFloat(document.getElementById('basicSalary').value) || 0;
            const emp_travel_allowence = parseFloat(document.getElementById('emp_travel_allowence').value) || 0;
            const emp_designation_bonus = parseFloat(document.getElementById('emp_designation_bonus').value) || 0;
            const kpiBonus = parseFloat(document.getElementById('kpiBonus').value) || 0;
            const projectBonus = parseFloat(document.getElementById('projectBonus').value) || 0;
            const deduction = parseFloat(document.getElementById('deduction').value) || 0;

            const totalSalary = basicSalary + kpiBonus + projectBonus + emp_travel_allowence + emp_designation_bonus;
            const netSalary = totalSalary - deduction;

            document.getElementById('totalSalary').value = totalSalary;
            document.getElementById('emp_total_salary_hidden').value = totalSalary;
            document.getElementById('deduction').value = deduction;
            document.getElementById('emp_deduction_hidden').value = deduction;
            document.getElementById('netSalary').value = netSalary;
            document.getElementById('emp_net_salary_hidden').value = netSalary;
            document.getElementById('displayDeduction').value = deduction;
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

        // </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
