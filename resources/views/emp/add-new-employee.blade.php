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
                        <div style="margin-bottom: 20px;">
                            <p class="card-title font-size-14">Fill below form to add your data as new employee in our
                                database system. Fields with(<span style="color:red;">*</span>) are mandatory to fill,
                                remaining are optional.</p>
                        </div>




                        @if (session('success'))
                            <div class="container-fluid d-flex justify-content-end" id="container">
                                <div class="alert alert-success " style="max-width: 300px;" id="close-alert">
                                    {{ session('success') }}

                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="container-fluid d-flex justify-content-end" id="container">
                                <div class="alert alert-danger " style="max-width: 300px;" id="close-alert">
                                    {{ session('error') }}

                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>
                        @endif


                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                        Personal Details</h4>
                                    <div class="form-floating mb-3">
                                        {{-- @isset($emp_data->Emp_Image)

                                                <a href="{{ asset($emp_data->Emp_Image) }}" target="_blank">
                                                    <img src="{{ asset($emp_data->Emp_Image) }}" style="width:150px;height:150px">
                                                </a>
                                            @endisset --}}

                                        @if (isset($emp_data->Emp_Image) && $emp_data->Emp_Image != null && file_exists($emp_data->Emp_Image))
                                            <img src="{{ url($emp_data->Emp_Image) }}" style="width:150px;height:150px"
                                                alt="">
                                        @else
                                            <img src="{{ url('/user.png') }}" style="width:150px;height:150px"
                                                alt="">
                                        @endif

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <input type="text" class="form-control" id="floatingFirstnameInput"
                                                    style="background-color: transparent; border:none;" type="text"
                                                    placeholder="Employee Name" name="employee_name"
                                                    value="{{ isset($emp_data->Emp_Full_Name) ? $emp_data->Emp_Full_Name : old('employee_name') }}">

                                                <label for="">Full Name <span class="text-danger">*</span></label>
                                                @error('employee_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;"
                                                    placeholder="0333-3333333" type="tel" name="employee_phone"
                                                    value="{{ isset($emp_data->Emp_Phone) ? $emp_data->Emp_Phone : old('employee_phone') }}">
                                                <label for="">Phone # <span class="text-danger">*</span></label>
                                                @error('employee_phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;"
                                                    placeholder="employee email"
                                                    value="{{ isset($emp_data->Emp_Email) ? $emp_data->Emp_Email : old('employee_email') }}"
                                                    type="email" name="employee_email">
                                                @error('employee_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="">Email address <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">

                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;" type="file"
                                                    name="employee_img" accept="image/*">
                                                @error('employee_img')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="">Image <span class="text-danger">*</span></label>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <select class="form-control"
                                                    style="background-color: transparent; border:none;" name="Emp_Gender"
                                                    id="Emp_Gender">
                                                    <option value="" selected disabled>Select Emp Gender</option>
                                                    <option value="Male"
                                                        {{ old('Emp_Gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female"
                                                        {{ old('Emp_Gender') == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                    <option value="Other"
                                                        {{ old('Emp_Gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <label for="">Gender <span class="text-danger">*</span></label>
                                                @error('Emp_Gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        {{-- marital status  --}}
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <select class="form-control"
                                                    style="background-color: transparent; border:none;"
                                                    name="Emp_Marital_Status" id="">
                                                    <option value="" selected disabled>Select Marital Status</option>
                                                    <option value="Married"
                                                        {{ old('Emp_Marital_Status') == 'Married' ? 'selected' : '' }}>
                                                        Married</option>
                                                    <option value="Single"
                                                        {{ old('Emp_Marital_Status') == 'Single' ? 'selected' : '' }}>
                                                        Single</option>

                                                </select>
                                                <label for="">Marital Status <span
                                                        class="text-danger">*</span></label>
                                                @error('Emp_Marital_Status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <input type="text" class="form-control"
                                                    style="background-color: transparent; border:none;" type="text"
                                                    placeholder="Passport #" value="{{ old('Emp_Passport_Number') }}"
                                                    name="Emp_Passport_Number" value=" ">

                                                <label for="">Passport Number </label>
                                                {{-- @error('Emp_Passport_Number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror --}}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                {{-- {{ isset($emp_data->emp_cnic) ? $emp_data->emp_cnic : '' }} --}}
                                                <input type="text" name="emp_cnic"
                                                    value="{{ isset($emp_data->emp_cnic) ? $emp_data->emp_cnic : old('emp_cnic') }}"
                                                    style="background-color: transparent; border:none; resize: none; height: 50px"
                                                    placeholder="Employee Address" class="form-control">
                                                @error('emp_cnic')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="">CNIC<span class="text-danger">*</span></label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <input type="date"
                                                    value="{{ isset($emp_data->emp_birthday) ? $emp_data->Emp_Joining_Date : old('emp_birthday') }}"
                                                    class="form-control"
                                                    style="background-color: transparent; border:none;"
                                                    name="emp_birthday" id="">


                                                @error('emp_birthday')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="">Employee Birthday <span
                                                        class="text-danger">*</span></label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <textarea name="employee_address" style="background-color: transparent; border:none; resize: none; height: 50px"
                                                    placeholder="Employee Address" class="form-control">{{ isset($emp_data->Emp_Address) ? $emp_data->Emp_Address : old('employee_address') }}</textarea>
                                                @error('employee_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="">Home address <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="col-md-6">
                                    <h4 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                        Company Details</h4>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <input class="form-control " placeholder="Employee code: 200sols"
                                                    style="background-color: transparent; border:none;"
                                                    value="{{ isset($emp_data->Emp_Code) ? $emp_data->Emp_Code : old('employee_code') }}"
                                                    type="text" name="employee_code">

                                                <label for="">Emp Code <span class="text-danger">*</span></label>
                                                @error('employee_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <input class="form-control " placeholder="department"
                                                    style="background-color: transparent; border:none;"
                                                    value="{{ isset($emp_data->department) ? $emp_data->department : old('employee_department') }}"
                                                    type="text" name="employee_department">
                                                <label for="">Emp Department <span
                                                        class="text-danger">*</span></label>
                                                @error('employee_department')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <input class="form-control" type="text"
                                                    style="background-color: transparent; border:none;"
                                                    placeholder="Employee Designation" name="employee_designation"
                                                    value="{{ isset($emp_data->Emp_Designation) ? $emp_data->Emp_Designation : old('employee_designation') }}">
                                                @error('employee_designation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <label for="">Emp Designation <span
                                                        class="text-danger">*</span></label>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor"
                                                style="border: 1px solid #c7c7c7;">
                                                <select class="form-control"
                                                    style="background-color: transparent; border:none;"
                                                    name="employee_shift_time" id="">
                                                    <option value="" selected disabled>Select Time Shift</option>
                                                    <option value="Morning"
                                                        {{ old('employee_shift_time') == 'Morning' ? 'selected' : '' }}>
                                                        Morning Shift</option>
                                                    <option value="Night"
                                                        {{ old('employee_shift_time') == 'Night' ? 'selected' : '' }}>
                                                        Night
                                                        Shift</option>
                                                </select>
                                                @error('employee_shift_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="">Emp Shift Time <span
                                                        class="text-danger">*</span></label>

                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input type="date"
                                                        value="{{ isset($emp_data->Emp_Joining_Date) ? $emp_data->Emp_Joining_Date : old('employee_joining_date') }}"
                                                        class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        name="employee_joining_date" id="">


                                                    @error('employee_joining_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="">Employee Joining Date <span
                                                            class="text-danger">*</span></label>

                                                </div>
                                            </div>



                                        </div>
                                        <h4
                                            style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                            Salary Details</h4>
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control " placeholder="Basic Salary"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->basic_salary) ? $emp_data->basic_salary : '25000' }}"
                                                        type="text" name="basic_salary">

                                                    <label for="">Basic Salary</label>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control " placeholder="Designation Bonus"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->designation_bonus) ? $emp_data->designation_bonus : '5000' }}"
                                                        type="text" name="designation_bonus">
                                                    <label for="">Designation Bonus </label>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control" type="text"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="Employee Designation" name="travel_allowance"
                                                        value="{{ isset($emp_data->travel_allowance) ? $emp_data->travel_allowance : '5000' }}">


                                                    <label for="">Travel Allowance </label>

                                                </div>
                                            </div>

                                        </div>



                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4
                                            style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                            Emergency Contact Details</h4>
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control " placeholder="Employee code: 200sols"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->Emp_Relation) ? $emp_data->Emp_Relation : old('employee_relation') }}"
                                                        type="text" name="employee_relation">
                                                    @error('employee_relation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="">Relation <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control " placeholder="department"
                                                        style="background-color: transparent; border:none;"
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
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->Emp_Relation_Phone) ? $emp_data->Emp_Relation_Phone : old('employee_relative_phone_num') }}"
                                                        placeholder="0333-3333333" name="employee_relative_phone_num"
                                                        type="tel">
                                                    @error('employee_relative_phone_num')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="">Phone # <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <textarea name="employee_relative_address" style="background-color: transparent; border:none;"
                                                        placeholder="Employee Address" class="form-control">{{ isset($emp_data->Emp_Relation_Address) ? $emp_data->Emp_Relation_Address : old('employee_relative_address') }}</textarea>
                                                    @error('employee_relative_address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for=""> Address <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- secondary phone number data  --}}
                                        <h4>Secondary Emergancy Details</h4>

                                        {{-- name and relationship --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="0333-3333333" name="secondary_employee_relation"
                                                        type="tel" value="{{ old('secondary_employee_relation') }}">

                                                    <label for=""> Relation </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="0333-3333333" name="secondary_employee_relation_name"
                                                        type="tel"
                                                        value="{{ old('secondary_employee_relation_name') }}">

                                                    <label for=""> Name </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="0333-3333333"
                                                        name="secondary_employee_relative_phone_num" type="tel"
                                                        value="{{ old('secondary_employee_relative_phone_num') }}">

                                                    <label for=""> Phone # </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <textarea name="secondary_employee_relative_address" style="background-color: transparent; border:none;"
                                                        placeholder="Employee Address" class="form-control">{{ old('secondary_employee_relative_address') }}</textarea>

                                                    <label for=""> Address </label>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-md-6">
                                        <h4
                                            style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                            Back Account Details</h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->Emp_Bank_Name) ? $emp_data->Emp_Bank_Name : old('employee_bank_name') }}"
                                                        placeholder="0333-3333333" name="employee_bank_name"
                                                        type="text">

                                                    <label for="">Bank Name </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->Emp_Bank_IBAN) ? $emp_data->Emp_Bank_IBAN : old('employee_bank_iban') }}"
                                                        placeholder="0333-3333333" name="employee_bank_iban"
                                                        type="text">

                                                    <label for="">Bank IBAN # </label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="bank title" value="{{ old('account_title') }}"
                                                        name="account_title" type="text">

                                                    <label for="">Account Title</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="bank number" value="{{ old('account_number') }}"
                                                        name="account_number" type="text">

                                                    <label for="">Account No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="branch name" value="{{ old('branch_name') }}"
                                                        name="branch_name" type="text">

                                                    <label for="">Branch Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="bank number" value="{{ old('branch_code') }}"
                                                        name="branch_code" type="text">

                                                    <label for="">Branch Code</label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>


                                {{-- education and work experience --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4
                                            style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                            Education Details
                                        </h4>

                                        <!-- Education details section -->
                                        <div id="educationDetails">
                                            <div class="education-section mb-4">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_education.0') }}"
                                                                placeholder="Educational Institute" name="emp_education[]"
                                                                type="text">
                                                            <label for="">Education Institute</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_degree.0') }}"
                                                                placeholder="Educational Degree" name="emp_degree[]"
                                                                type="text">
                                                            <label for="">Educational Degree</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_education_start.0') }}"
                                                                placeholder="Start Date" name="emp_education_start[]"
                                                                type="date">
                                                            <label for="">Start Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_education_end.0') }}"
                                                                placeholder="End Date" name="emp_education_end[]"
                                                                type="date">
                                                            <label for="">End Date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add more link -->
                                        <div class="row">
                                            <div class="col-md-12 text-right mb-5">
                                                <a href="#" class="add-more">Add More</a>
                                            </div>
                                        </div>
                                        <!-- Existing code for task submission -->
                                    </div>

                                    <script>

                                        // Function to create education details section
                                        function createEducationSection() {
                                            var educationSection = document.querySelector('.education-section').cloneNode(true);
                                            educationSection.classList.remove('education-section');
                                            // Add remove link
                                            var removeLink = document.createElement('a');
                                            removeLink.href = '#';
                                            removeLink.className = 'remove-education';
                                            removeLink.textContent = 'Remove';
                                            removeLink.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                educationSection.remove();
                                            });
                                            educationSection.appendChild(removeLink);
                                            return educationSection;
                                        }

                                        // Event listener for the Add More Education link
                                        document.querySelector('.add-more').addEventListener('click', function(e) {
                                            e.preventDefault();
                                            var clonedSection = createEducationSection();
                                            document.getElementById('educationDetails').appendChild(clonedSection);
                                        });


                                    </script>




                                    <div class="col-md-6">
                                        <h4
                                            style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                            Work Experience
                                        </h4>

                                        <!-- Work experience section -->
                                        <div id="workExperience">
                                            <div class="work-experience-section mb-4">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_company.0') }}" placeholder="Company"
                                                                name="emp_company[]" type="text">
                                                            <label for="">Company</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_position.0') }}"
                                                                placeholder="Position" name="emp_position[]"
                                                                type="text">
                                                            <label for="">Position</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_work_start.0') }}"
                                                                placeholder="Start Date" name="emp_work_start[]"
                                                                type="date">
                                                            <label for="">Start Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_work_end.0') }}"
                                                                placeholder="End Date" name="emp_work_end[]"
                                                                type="date">
                                                            <label for="">End Date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add more link -->
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <a href="#" class="add-more-work float-right">Add More</a>
                                            </div>
                                        </div>
                                        <!-- Existing code for task submission -->
                                    </div>

                                    <script>
                                        // Function to create work experience section with remove link
                                        function createWorkExperienceSection() {
                                            var workExperienceSection = document.querySelector('.work-experience-section').cloneNode(true);
                                            workExperienceSection.classList.remove('work-experience-section');

                                            // Add remove link
                                            var removeLink = document.createElement('a');
                                            removeLink.href = '#';
                                            removeLink.className = 'remove-work float-right ml-2';
                                            removeLink.textContent = 'Remove';
                                            removeLink.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                workExperienceSection.remove();
                                            });
                                            workExperienceSection.appendChild(removeLink);

                                            return workExperienceSection;
                                        }

                                        // Event listener for the Add More Work Experience link
                                        document.querySelector('.add-more-work').addEventListener('click', function(e) {
                                            e.preventDefault();
                                            var clonedSection = createWorkExperienceSection();
                                            document.getElementById('workExperience').appendChild(clonedSection);

                                            // Remove the remove link from the first section
                                            if (document.querySelectorAll('.work-experience-section').length > 1) {
                                                document.querySelector('.work-experience-section').querySelector('.remove-work').remove();
                                            }
                                        });
                                    </script>




                                </div>


                                <div>
                                    <button type="submit" class="reblateBtn w-md py-2 px-4">{{ $btn_text }}</button>
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
                // console.log('good');
                document.getElementById('close-alert').style.display = 'none';
                // divElement.style.display = 'none';
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
