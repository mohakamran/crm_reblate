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

                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
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
                                        <input class="form-control" type="number" placeholder="User Name" name="ex_amount"
                                            value="{{ old('ex_amount') }}" min="0">
                                        @error('ex_amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Amount <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="date" placeholder="email" name="ex_date"
                                            value="{{ old('ex_date') }}">
                                        @error('ex_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Date<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select id="ex_parent_category" class="form-control" name="ex_parent_category">
                                            <option value="" disabled selected >Select a category</option>

                                            <option value="Office" {{ old('ex_parent_category') === 'Office' ? 'selected' : '' }}>Office</option>
                                            <option value="Salaries" {{ old('ex_parent_category') === 'Salaries' ? 'selected' : '' }}>Salaries</option>
                                            <option value="Maintenance" {{ old('ex_parent_category') === 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                            <option value="Day Food" {{ old('ex_parent_category') === 'Day Food' ? 'selected' : '' }}>Day Food</option>
                                            <option value="Marketing" {{ old('ex_parent_category') === 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                        </select>
                                        @error('ex_parent_category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Select Category <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select id="ex_child_category" class="form-control" name="ex_child_category">
                                            <option value="" disabled selected >Select a subctegory</option>
                                            <option value="none" {{ old('ex_child_category') === 'none' ? 'selected' : '' }}>None</option>
                                            <option value="Day Shift" {{ old('ex_child_category') === 'Day Shift' ? 'selected' : '' }}>Day Shift</option>
                                            <option value="Night Shift" {{ old('ex_child_category') === 'Night Shift' ? 'selected' : '' }}>Night Shift</option>
                                            <option value="rent" {{ old('ex_child_category') === 'rent' ? 'selected' : '' }}>Rent</option>
                                            <option value="electricity_bill" {{ old('ex_child_category') === 'electricity_bill' ? 'selected' : '' }}>Electricity Bill</option>
                                            <option value="water_bill" {{ old('ex_child_category') === 'water_bill' ? 'selected' : '' }}>Water Bill</option>
                                            <option value="kitchen" {{ old('ex_child_category') === 'kitchen' ? 'selected' : '' }}>Kitchen</option>
                                            <option value="internet" {{ old('ex_child_category') === 'internet' ? 'selected' : '' }}>Internet Bill</option>
                                            <option value="others" {{ old('ex_child_category') === 'others' ? 'selected' : '' }}>Others</option>
                                            <option value="charity" {{ old('ex_child_category') === 'charity' ? 'selected' : '' }}>Charity</option>
                                    </select>
                                    @error('ex_child_category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                        <label for="">Sub category <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" style="height: 80px;" name="ex_description" placeholder="expense description"></textarea>
                                        @error('ex_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Expense Description </label>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary  w-md"
                                    style="background-color: #14213D ; border-color: #fff;">{{ $btn_text }}</button>
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
                                "Office": ["Rent", "Blectricity Bill","Water Bill", "Kitchen","Internet Bill","Others", "Charity"],
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
