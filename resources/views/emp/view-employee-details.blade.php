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
                        <p>Below are the details of employee <u><strong>{{$emp_data->Emp_Full_Name}}</strong></u> and Employee code is <u><strong>{{$emp_data->Emp_Code}}</strong></u></p>
                        <br>
                        <h4>Personssal Details
                            <hr>
                        </h4>


                                <div class="form-floating mb-3">
                                    @isset($emp_data->Emp_Image)
                                        <a href="{{ asset($emp_data->Emp_Image) }}" target="_blank">
                                           <img src="{{ asset($emp_data->Emp_Image) }}" style="width:150px;height:150px">
                                        </a>
                                    @endisset

                                </div>




                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingFirstnameInput"
                                            type="text" placeholder="Employee Name" name="employee_name" disabled
                                            value="{{ isset($emp_data->Emp_Full_Name) ? $emp_data->Emp_Full_Name : old('employee_name') }}">

                                        <label for="">Full Name <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" placeholder="0333-3333333" type="tel"
                                            name="employee_phone" disabled
                                            value="{{ isset($emp_data->Emp_Phone) ? $emp_data->Emp_Phone : old('employee_phone') }}">
                                        <label for="">Phone # <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" placeholder="employee email" disabled
                                            value="{{ isset($emp_data->Emp_Email) ? $emp_data->Emp_Email : old('employee_email') }}"
                                            type="email" name="employee_email">

                                        <label for="">Email address <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea name="employee_address" disabled placeholder="Employee Address" class="form-control">{{ isset($emp_data->Emp_Address) ? $emp_data->Emp_Address : old('employee_address') }}</textarea>

                                        <label for="">Emp address <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>


                            {{-- company details --}}
                            <br>
                            <h4>Company Details
                                <hr>
                            </h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control " disabled placeholder="Employee code: 200sols"
                                            value="{{ isset($emp_data->Emp_Code) ? $emp_data->Emp_Code : old('employee_code') }}"
                                            type="text" name="employee_code">

                                        <label for="">Emp Code <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control " placeholder="department" disabled
                                            value="{{ isset($emp_data->department) ? $emp_data->department : old('employee_department') }}"
                                            type="text" name="employee_department">
                                        <label for="">Emp Department <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Employee Designation"
                                            name="employee_designation" disabled
                                            value="{{ isset($emp_data->Emp_Designation) ? $emp_data->Emp_Designation : old('employee_designation') }}">


                                        <label for="">Emp Designation <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                @if (!isset($emp_data->Emp_Shift_Time))
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control"  disabled type="text"
                                            value="{{ $emp_data->Emp_Shift_Time }}" disabled>

                                            <label for="">Emp Shift Time <span
                                                    class="text-danger">*</span></label>

                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control"
                                            value="{{ isset($emp_data->Emp_Joining_Date) ? $emp_data->Emp_Joining_Date : old('employee_joining_date') }}"
                                            placeholder="Employee Joining Date" name="employee_joining_date"
                                            type="date" disabled>

                                        <label for="">Emp Joining Date <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            {{-- company details --}}
                            <br>
                            <h4>
                                Emergency Contact Details
                                <hr>
                            </h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control " placeholder="Employee code: 200sols"
                                            value="{{ isset($emp_data->Emp_Relation) ? $emp_data->Emp_Relation : old('employee_relation') }}"
                                            type="text" name="employee_relation" disabled>

                                        <label for="">Relation <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control " placeholder="department"
                                            value="{{ isset($emp_data->Emp_Relation_Name) ? $emp_data->Emp_Relation_Name : old('employee_relative_name') }}"
                                            type="text" name="employee_relative_name" disabled>


                                        <label for="">Name <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control"
                                            value="{{ isset($emp_data->Emp_Relation_Phone) ? $emp_data->Emp_Relation_Phone : old('employee_relative_phone_num') }}"
                                            placeholder="0333-3333333" name="employee_relative_phone_num" disabled type="tel">

                                        <label for="">Phone # <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea name="employee_relative_address"  disabled placeholder="Employee Address" class="form-control">{{ (isset($emp_data->Emp_Relation_Address)) ? $emp_data->Emp_Relation_Address : old('employee_relative_address') }}</textarea>

                                        <label for=""> Address <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                             {{-- company details --}}
                             <br>
                             <h4>
                                Back Account Details
                                 <hr>
                             </h4>

                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control"
                                            value="{{ (isset($emp_data->Emp_Bank_Name)) ? $emp_data->Emp_Bank_Name : old('employee_bank_name') }}"
                                            placeholder="0333-3333333" disabled name="employee_bank_name" type="text">

                                        <label for="">Bank Name </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control"
                                        value="{{ (isset($emp_data->Emp_Bank_IBAN)) ? $emp_data->Emp_Bank_IBAN : old('employee_bank_iban') }}"
                                            placeholder="0333-3333333" disabled name="employee_bank_iban" type="text">

                                        <label for="">Bank IBAN # </label>
                                    </div>
                                </div>
                            </div>




                            <div>
                                <a href="/manage-employees" class="btn btn-primary  w-md" style="background-color: #14213D ; border-color: #fff;">Go back</a>
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
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
