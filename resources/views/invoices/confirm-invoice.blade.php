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
                        <p class="card-title" style="color:#6b6b6b">Confirm entered data and then click 'Send Invoice' button to send invoice.</p>
                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 col-xl-6 ">
                                    <h3 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">Client Details </h3>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input class="form-control" style="background-color: transparent; border:none;" type="text" placeholder="text" name="client_id"
                                                    disabled value="{{ $client->client_id }}">
                                                <input type="hidden" value="{{ $client->client_id }}"
                                                    name="client_id">
                                                <label for="">Client ID</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input class="form-control" style="background-color: transparent; border:none;" type="text" placeholder="text" name="emp_code"
                                                    disabled value="{{ $client->client_name }}">
                                                <input type="hidden" value="{{ $client->client_name }}" name="client_name_hidden">
                                                <label for="">Client Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input class="form-control" style="background-color: transparent; border:none;" type="text" placeholder="User Name" disabled
                                                    value="{{ $client->project_name }}" min="0" name="emp_name">
                                                <input type="hidden" value="{{ $client->project_name }}" name="emp_name_hidden">

                                                <label for="">Project Name </label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input class="form-control" style="background-color: transparent; border:none;" type="email" placeholder="email" disabled
                                                    value="{{ $client->project_type }}" name="emp_email">

                                                <input type="hidden" value="{{ $client->project_type }}" name="emp_email_hidden">
                                                @error('ex_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="">Project Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input class="form-control" style="background-color: transparent; border:none;" type="text" placeholder="User Name"
                                                    name="emp_designation" disabled value="{{ $client->client_email }}"
                                                    min="0">
                                                <input type="hidden" value="{{ $client->client_email }}"
                                                    name="client_email_hidden">
                                                <label for="">Client Email </label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input class="form-control" style="background-color: transparent; border:none;" type="text" placeholder="text" name="emp_code"
                                                    disabled value="{{ $client->client_phone }}">
                                                <input type="hidden" value="{{ $client->client_phone }}" name="client_phone_hidden">
                                                <label for="">Client Phone</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input class="form-control" style="background-color: transparent; border:none;" type="text" placeholder="text" name="emp_code"
                                                    disabled value="{{ $client->project_start_date }}">
                                                <input type="hidden" value="{{ $client->project_start_date }}"
                                                    name="emp_code_hidden">
                                                <label for="">Project Start Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <textarea name="" style="background-color: transparent; border:none; resize: none; height: 70px" class="form-control" disabled cols="30" rows="10">{{ $client->project_description }}</textarea>
                                                <label for="">Project Description</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <h3 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">Invoice Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input type="month" style="background-color: transparent; border:none;" disabled  value="{{$invoice_month}}" class="form-control">
                                                <label for="invoice_month">Period </label>
                                                <input type="hidden" style="background-color: transparent; border:none;" name="invoice_month_hidden"  value="{{$invoice_month}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input type="text" style="background-color: transparent; border:none;" value="{{$invoice_description}}"  class="form-control" disabled>
                                                <label for="">Description </label>
                                                <input type="hidden" style="background-color: transparent; border:none;"  name="invoice_description" value="{{$invoice_description}}"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input type="number" style="background-color: transparent; border:none;" min="0" value="{{$invoice_profit}}" class="form-control" disabled>
                                                <label for="">Profit($)  </label>
                                                <input type="hidden" style="background-color: transparent; border:none;" name="invoice_profit_hidden" value="{{$invoice_profit}}"  class="form-control">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input type="number" style="background-color: transparent; border:none;" min="0" value="{{$invoice_amount}}" class="form-control" disabled>
                                                <label for="invoice_amount">Amount($) </label>
                                                <input type="hidden" style="background-color: transparent; border:none;" name="invoice_amount_hidden"  value="{{$invoice_amount}}" class="form-control" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input type="date" style="background-color: transparent; border:none;" value="{{$invoice_due_date}}" class="form-control" disabled>
                                                <label for="">Due Date </label>
                                                <input type="hidden" style="background-color: transparent; border:none;"  value="{{$invoice_due_date}}" class="form-control" name="invoice_due_date_hidden">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                <input type="text" style="background-color: transparent; border:none;" value="{{$invoice_method}}" class="form-control" disabled>
                                                <label for="">Payment Method
                                                </label>
                                                <input type="hidden" style="background-color: transparent; border:none;" name="invoice_method_hidden" value="{{$invoice_method}}"  >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                                {{-- <input type="date" value="" class="form-control" name="emp_code_hidden"> --}}
                                                <textarea class="form-control" style="background-color: transparent; border:none; resize: none; height: 150px" disabled id="" cols="50" rows="20">{{$invoice_notes}}</textarea>
                                                <label for="">Additional Notes (optional)</label>
                                                <input type="hidden" style="background-color: transparent; border:none;" value="{{$invoice_notes}}" name="invoice_notes_hidden">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="reblateBtn py-2 px-4 w-md" target="_blank">{{ $btn_text }}</button>
                                <button type="submit" class="reblateBtn py-2 px-4 w-md">
                                    <a href="/create-invoice/{{$id}}" class="text-light">Go Back</a>
                                </button>
                                {{-- <a href="/preview-salary/{{$id}}" target="_blank" class="btn btn-danger">Preview</a> --}}

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
