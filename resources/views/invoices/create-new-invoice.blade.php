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
                        <h3>Client Details </h3>
                        <hr>
                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
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
                                        <input class="form-control" type="text" placeholder="text" name="emp_code"
                                            disabled value="{{ $client->client_name }}">
                                        <input type="hidden" value="{{ $client->client_name }}" name="emp_code_hidden">
                                        <label for="">Client Name</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="User Name" disabled
                                            value="{{ $client->project_name }}" min="0" name="emp_name">
                                        <input type="hidden" value="{{ $client->project_name }}" name="emp_name_hidden">

                                        <label for="">Project Name </label>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="email" placeholder="email" disabled
                                            value="{{ $client->project_type }}" name="emp_email">

                                        <input type="hidden" value="{{ $client->project_type }}" name="emp_email_hidden">
                                        @error('ex_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Project Type</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="User Name"
                                            name="emp_designation" disabled value="{{ $client->client_email }}"
                                            min="0">
                                        <input type="hidden" value="{{ $client->client_email }}"
                                            name="emp_date_of_joining_hidden">
                                        <label for="">Client Email </label>

                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="text" name="emp_code"
                                            disabled value="{{ $client->client_phone }}">
                                        <input type="hidden" value="{{ $client->client_phone }}" name="emp_code_hidden">
                                        <label for="">Client Phone</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="text" name="emp_code"
                                            disabled value="{{ $client->project_start_date }}">
                                        <input type="hidden" value="{{ $client->project_start_date }}"
                                            name="emp_code_hidden">
                                        <label for="">Project Start Date</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea name="" class="form-control" disabled cols="30" rows="10">{{ $client->project_description }}</textarea>
                                        <label for="">Project Description</label>
                                    </div>
                                </div>
                            </div>


                            <h3>Invoice Details</h3>
                            <hr>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="month"  name="invoice_month" value="{{old('invoice_month')}}" class="form-control">
                                        <label for="envoice_month">Period <span style="color:red">*</span></label>
                                        <div class="text-danger">
                                            @error('invoice_month')
                                                {{$message}}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" value="{{old('invoice_description')}}" name="invoice_description" class="form-control">
                                        <label for="">Description <span style="color:red">*</span></label>
                                        <div class="text-danger">
                                            @error('invoice_description')
                                                {{$message}}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="number"  min="0" value="{{old('invoice_profit')}}" class="form-control" name="invoice_profit">
                                        <label for="">Profit($)   </label>
                                        {{-- <div class="text-danger">
                                            @error('invoice_profit')
                                                {{$message}}
                                            @enderror
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="number" value="{{old('invoice_amount')}}" min="0" class="form-control" name="invoice_amount">
                                        <label for="invoice_amount">Amount($) <span style="color:red">*</span></label>
                                        <div class="text-danger">
                                            @error('invoice_amount')
                                                {{$message}}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="date" value="{{old('invoice_due_date')}}" class="form-control" name="invoice_due_date">
                                        <label for="">Due Date <span style="color:red">*</span></label>
                                        <div class="text-danger">
                                            @error('invoice_due_date')
                                                {{$message}}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" value="{{old('invoice_method')}}" class="form-control" name="invoice_method">
                                        <label for="">Payment Method <span style="color:red">*</span></label>
                                        <div class="text-danger">
                                            @error('invoice_method')
                                                {{$message}}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        {{-- <input type="date" value="" class="form-control" name="emp_code_hidden"> --}}
                                        <textarea class="form-control" name="invoice_notes" id="" cols="50" rows="20"></textarea>
                                        <label for="">Additional Notes (optional)</label>
                                    </div>
                                </div>
                            </div>


                            <br>


                            <div>
                                <br>

                                <button type="submit" class="btn btn-primary  w-md" target="_blank"
                                    style="background-color: #14213D ; border-color: #fff;">{{ $btn_text }}</button>
                                {{-- <a href="/preview-salary/{{$id}}" target="_blank" class="btn btn-danger">Preview</a> --}}
                                <a href="/create-new-invoice" class="btn btn-danger">Go Back</a>

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
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
