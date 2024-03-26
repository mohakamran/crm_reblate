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
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title" style="color:#6b6b6b;">Fill below form to add new client. Fields with(<span
                                style="color:red;">*</span>) are mandatory to fill, remaining are optional.</p>
                        <br>

                        <form method="post" action="{{$route}}" enctype="multipart/form-data">
                            @csrf
                            @if (session('success'))
                            <div class="container-fluid d-flex justify-content-end">
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" style="max-width: 300px;" id="close-now">
                                    {{ session('success') }}

                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                        <input class="form-control @error('client_name') is-invalid @enderror"
                                            type="text" placeholder="User Name" name="client_name" style="background-color: transparent; border:none;"
                                            value="{{ isset($client_data->client_name) ? $client_data->client_name :  old('client_name') }}"
                                            min="0">
                                        @error('client_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Client Name <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                        <input class="form-control @error('project_client_name') is-invalid @enderror"
                                            type="text" placeholder="email" name="project_client_name" style="background-color: transparent; border:none;"
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
                                    <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                        <input class="form-control @error('project_start_date') is-invalid @enderror"
                                            type="date" placeholder="User Name" name="project_start_date" style="background-color: transparent; border:none;"
                                            value="{{ isset($client_data->project_start_date) ? $client_data->project_start_date :  old('project_start_date') }}"
                                            min="0">
                                        @error('project_start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Project Date <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                        <select id="" class="form-control" name="client_project_type" style="background-color: transparent; border:none;">
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
                                    <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                        <input class="form-control @error('client_email') is-invalid @enderror"
                                            type="email" placeholder="User Name" name="client_email" style="background-color: transparent; border:none;"
                                            value="{{ isset($client_data->client_email) ? $client_data->client_email : old('client_email') }}"
                                            min="0">
                                        @error('client_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Client Email <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                        <input class="form-control " type="tel" placeholder="User Name"
                                            name="client_phone" style="background-color: transparent; border:none;"
                                            value="{{ isset($client_data->client_phone)  ?  $client_data->client_phone : old('client_phone') }}"
                                            min="0">

                                        <label for="">Client Phone </label>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3 inputboxcolor" style="border:1px solid #c7c7c7;">
                                    <textarea class="form-control" style="height: 80px; resize: none; background-color: transparent; border:none;" name="client_description" placeholder="project description">{{ isset($client_data->project_description)  ?  $client_data->project_description : old('client_phone') }}</textarea>
                                    @error('client_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label for="">Project Description</label>

                                </div>
                            </div>


                            <div>
                                <button type="submit" class="reblateBtn py-2 px-4 w-md">{{ $btn_text }}</button>
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
