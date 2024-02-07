@extends('layouts.master')
@section('title')
{{ $client_data->client_name }}
@endsection
@section('page-title')
{{ $client_data->client_name }}
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Verify details of client and click on send button! credentials will be sent to client! If you need to change anything about client then <a href="/update_client/{{ $client_data->client_id}}">Click Here</a></p>
                        <br>

                        <form method="post" action="/create-credentials/{{ $client_data->client_id}}" enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('client_name') is-invalid @enderror"
                                            type="text" disabled placeholder="User Name" name="client_name"
                                            value="{{ isset($client_data->client_name) ? $client_data->client_name :  old('client_name') }}"
                                            min="0">
                                        @error('client_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Client Name <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('project_client_name') is-invalid @enderror"
                                            type="text" disabled placeholder="email" name="project_client_name"
                                            value="{{ isset($client_data->project_name) ? $client_data->project_name :  old('project_client_name') }}">
                                        @error('project_client_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Project Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('project_start_date') is-invalid @enderror"
                                            type="date" disabled placeholder="User Name" name="project_start_date"
                                            value="{{ isset($client_data->project_start_date) ? $client_data->project_start_date :  old('project_start_date') }}"
                                            min="0">
                                        @error('project_start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Project Date <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select id="" class="form-control" name="client_project_type" disabled>
                                            <option value="" disabled selected >Select a project type</option>
                                            <option value="one time" {{ (isset($client_data->project_type) && $client_data->project_type == "one time") ? 'selected' : '' }}
                                                >One Time</option>
                                            <option value="on going"  {{ (isset($client_data->project_type) && $client_data->project_type == "on going") ? 'selected' : '' }} >On Going </option>
                                        </select>
                                        @error('client_project_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Project Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('client_email') is-invalid @enderror"
                                            type="email" placeholder="User Name" name="client_email" disabled
                                            value="{{ isset($client_data->client_email) ? $client_data->client_email : old('client_email') }}"
                                            min="0">
                                        @error('client_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Client Email <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control "  disabled type="tel" placeholder="User Name"
                                            name="client_phone"
                                            value="{{ isset($client_data->client_phone)  ?  $client_data->client_phone : old('client_phone') }}"
                                            min="0">

                                        <label for="">Client Phone </label>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" disabled style="height: 80px;" name="client_description" placeholder="project description">{{ isset($client_data->project_description)  ?  $client_data->project_description : old('client_phone') }}</textarea>
                                    @error('client_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label for="">Project Description</label>

                                </div>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary  w-md"
                                    style="background-color: #14213D ; border-color: #fff;">Send Now</button>
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
