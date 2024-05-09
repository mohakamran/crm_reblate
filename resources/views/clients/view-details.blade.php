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


                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="close-now">
                                    {{ session('success') }}
                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('client_name') is-invalid @enderror"
                                            type="text" placeholder="User Name" name="client_name"
                                            value="{{ $client_data->client_name }}" disabled
                                            min="0">

                                        <label for="">Client Name <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('project_client_name') is-invalid @enderror"
                                            type="text" placeholder="email" name="project_client_name"
                                            disabled
                                            value="{{ $client_data->project_name }}">

                                        <label for="">Project Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('project_start_date') is-invalid @enderror"
                                            type="date" placeholder="User Name" name="project_start_date"
                                            disabled
                                            value="{{ $client_data->project_start_date }}"
                                            min="0">

                                        <label for="">Project Date <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                       <input type="text" disabled
                                       value="{{ $client_data->project_type }}" class="form-control">
                                        <label for="">Project Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('client_email') is-invalid @enderror"
                                            type="email" placeholder="User Name" disabled
                                            value="{{ $client_data->client_email }}"
                                            min="0">

                                        <label for="">Client Email <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control " type="tel" placeholder="User Name"
                                            name="client_email"
                                            disabled
                                            value="{{ $client_data->client_phone }}"
                                            min="0">

                                        <label for="">Client Phone </label>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" style="height: 80px;" name="client_description" disabled placeholder="project description">{{$client_data->project_description}}</textarea>

                                    <label for="">Project Description</label>

                                </div>
                            </div>


                            <div>
                                <a href="/view-clients" class="btn btn-primary  w-md"
                                    style="background-color: #14213D ; border-color: #fff;">{{ $btn_text }}</a>
                            </div>

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

            // Get references to the select boxes
            const exParentCategory = document.getElementById("ex_parent_category");
            const exChildCategory = document.getElementById("ex_child_category");

            // Define a mapping of parent categories to child categories
            const parentToChildCategories = {
                "Office": ["Rent", "Blectricity Bill", "Water Bill", "Kitchen", "Internet Bill", "Others", "Charity"],
                "Salaries": ["Day Shift", "Night Shift"],
                "Maintenance": ["none"],
                "Day Food": ["none"],
                "Marketing": ["none"]
            };

            // Function to update the second select box options based on the first select box selection
            function updateChildCategory() {
                const selectedParentCategory = exParentCategory.value;
                const childCategories = parentToChildCategories[selectedParentCategory] || [];

                // Clear existing options
                exChildCategory.innerHTML = "";

                // Add new options
                childCategories.forEach(childCategory => {
                    const option = document.createElement("option");
                    option.value = childCategory;
                    option.text = childCategory;
                    exChildCategory.appendChild(option);
                });
            }

            // Add an event listener to the first select box to update the second select box
            exParentCategory.addEventListener("change", updateChildCategory);

            // Initial update
            updateChildCategory();
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
