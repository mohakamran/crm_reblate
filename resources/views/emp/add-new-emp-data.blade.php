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
                        <p class="card-title">You can Update your information anytime. </p>
                        <form method="post" action="/update-emp-info" enctype="multipart/form-data">
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
                            <div class="col-md-6 col-xl-6">
                                <h4 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">Personal Details</h4>
                                <div class="form-floating mb-3 col-md-12 d-flex justify-content-center">
                                    @isset($emp_data->Emp_Image)

                                        <a href="{{ asset($emp_data->Emp_Image) }}" target="_blank">
                                            <img src="{{ asset($emp_data->Emp_Image) }}" style="width:100px;height:100px; object-fit:cover;border-radius:100%;">
                                        </a>
                                    @endisset

                                </div>
                                <div class="row" style="margin-top: 35px;">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">

                                            <input class="form-control" style="background-color: transparent; border: none;" type="file" name="employee_img" accept="image/*">
                                            @error('employee_img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="">Image </label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input type="text" style="background-color: transparent; border: none;" class="form-control" id="floatingFirstnameInput"
                                                type="text" placeholder="Employee Name" name="employee_name"
                                                value="{{ isset($emp_data->Emp_Full_Name) ? $emp_data->Emp_Full_Name : old('employee_name') }}" >

                                            <label for="">Full Name <span class="text-danger">*</span></label>
                                            @error('employee_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" placeholder="employee email"
                                            value="{{ isset(auth()->user()->emp_email) ? auth()->user()->emp_email : '' }}"
                                                type="email" name="employee_email" disabled>
                                            @error('employee_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="">Email address <span class="text-danger">*</span></label>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input class="form-control" style="background-color: transparent; border: none;" placeholder="0333-3333333" type="tel"
                                                name="employee_phone"
                                                value="{{ isset($emp_data->Emp_Phone) ? $emp_data->Emp_Phone : old('employee_phone') }}">
                                            <label for="">Phone # <span class="text-danger">*</span></label>
                                            @error('employee_phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <textarea name="employee_address" placeholder="Employee Address" class="form-control " style="border: none; background-color: transparent; resize: none;">{{ isset($emp_data->Emp_Address) ? $emp_data->Emp_Address : old('employee_address') }}</textarea>
                                            @error('employee_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="">Home address <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <h4 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">Emergency Contact Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input class="form-control " style="background-color: transparent; border: none;" placeholder="Employee code: 200sols"
                                                value="{{ isset($emp_data->Emp_Relation) ? $emp_data->Emp_Relation : old('employee_relation') }}"
                                                type="text" name="employee_relation">
                                            @error('employee_relation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="">Relation <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input class="form-control " style="background-color: transparent; border: none;" placeholder="department"
                                                value="{{ isset($emp_data->Emp_Relation_Name) ? $emp_data->Emp_Relation_Name : old('employee_relative_name') }}"
                                                type="text" name="employee_relative_name">

                                            @error('employee_relative_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="">Name <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input class="form-control" style="background-color: transparent; border: none;"
                                                value="{{ isset($emp_data->Emp_Relation_Phone) ? $emp_data->Emp_Relation_Phone : old('employee_relative_phone_num') }}"
                                                placeholder="0333-3333333" name="employee_relative_phone_num" type="tel">
                                            @error('employee_relative_phone_num')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="">Phone # <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <textarea name="employee_relative_address" style="border: none; background-color: transparent; resize: none;" placeholder="Employee Address" class="form-control">{{ isset($emp_data->Emp_Relation_Address) ? $emp_data->Emp_Relation_Address : old('employee_relative_address') }}</textarea>
                                            @error('employee_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for=""> Address <span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xl-6">
                                        <h4 style="font-size: 25px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                            Back Account Details
                                        </h4>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input class="form-control" style="background-color: transparent; border: none;"
                                                value="{{ isset($emp_data->Emp_Bank_Name) ? $emp_data->Emp_Bank_Name : old('employee_bank_name') }}"
                                                placeholder="0333-3333333" name="employee_bank_name" type="text">

                                            <label for="">Bank Name </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input class="form-control" style="background-color: transparent; border: none;"
                                                value="{{ isset($emp_data->Emp_Bank_IBAN) ? $emp_data->Emp_Bank_IBAN : old('employee_bank_iban') }}"
                                                placeholder="0333-3333333" name="employee_bank_iban" type="text">

                                            <label for="">Bank IBAN # </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="reblateBtn px-4 py-2 w-md">{{ $btn_text }}</button>
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
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
