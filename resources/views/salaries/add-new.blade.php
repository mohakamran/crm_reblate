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
        <style>
            .popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, 0.5);
                width: 100%;
                height: 100%;
                z-index: 1000;
            }

            .popup-content {
                /* overflow-y: scroll;
                        scroll-behavior: smooth scroll; */
                display: flex;
                max-width: 700px;
                margin: auto auto;
                position: relative;
                top: 100px;
                justify-content: center;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                text-align: center;
            }

            .closeBtn {
                position: absolute;
                top: 25px;
                right: 15px;
                cursor: pointer;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const popupButton = document.getElementById('popupButton');
                const popup = document.getElementById('popup');
                const closeBtn = document.querySelector('.closeBtn');

                popupButton.addEventListener('click', function() {
                    popup.style.display = 'block';
                });

                closeBtn.addEventListener('click', function() {
                    popup.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        popup.style.display = 'none';
                    }
                });
            });
        </script>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
                            <div class="row ">
                                <div class="col-md-6 col-xl-6">
                                    <h3 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                        Employee Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor">
                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;" type="text"
                                                    placeholder="email" name="emp_code" disabled
                                                    value="{{ $emp->Emp_Code }}">
                                                <input type="hidden" value="{{ $emp->Emp_Code }}" name="emp_code_hidden">
                                                <label for="">Employee Code</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor">
                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;" type="text"
                                                    placeholder="User Name" disabled value="{{ $emp->Emp_Full_Name }}"
                                                    min="0" name="emp_name">
                                                <input type="hidden" value="{{ $emp->Emp_Full_Name }}"
                                                    name="emp_name_hidden">

                                                <label for="">Employee Name </label>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor">
                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;" type="email"
                                                    placeholder="email" disabled value="{{ $emp->Emp_Email }}"
                                                    name="emp_email">

                                                <input type="hidden" value="{{ $emp->Emp_Email }}" name="emp_email_hidden">
                                                @error('ex_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="">Employee Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor">
                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;" type="text"
                                                    placeholder="User Name" name="emp_designation" disabled
                                                    value="{{ $emp_date_of_joining }}" min="0">
                                                <input type="hidden" value="{{ $emp_date_of_joining }}"
                                                    name="emp_date_of_joining_hidden">
                                                <label for="">Employee Date Of Joining </label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor">
                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;" type="text"
                                                    placeholder="email" name="emp_shift_time" disabled
                                                    value="{{ $emp_month_salary }}">
                                                <input type="hidden" value="{{ $emp_month_salary }}"
                                                    name="emp_month_salary_hidden">
                                                <label for="">Employee Month Salary</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor">
                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;" type="text"
                                                    placeholder="User Name" name="emp_designation" disabled
                                                    value="{{ $emp->Emp_Designation }}" min="0">
                                                <input type="hidden" value="{{ $emp->Emp_Designation }}"
                                                    name="emp_designation_hidden">
                                                <label for="">Employee Designation </label>

                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 inputboxcolor">
                                                <input class="form-control"
                                                    style="background-color: transparent; border:none;" type="text"
                                                    placeholder="email" name="emp_shift_time" disabled
                                                    value="{{ $emp->Emp_Shift_Time }}">
                                                <input type="hidden" value="{{ $emp->Emp_Shift_Time }}"
                                                    name="emp_shift_time_hidden">
                                                <label for="">Employee Shift Time</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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

                                <div class="col-md-6 col-xl-6">
                                    <h3 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                        Salary Details</h3>
                                    <div class="row form-group">
                                        <div class="col-md-3 col-sm-12">
                                            <label required class=" col-form-label">Basic Salary</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                name="emp_basic_salary" min="0" id="basicSalary"
                                                onchange="calculateSalary()" value="{{($emp->basic_salary!=null) ? $emp->basic_salary : '0'  }}">

                                        </div>
                                        <div class="col-md-3 col-sm-12 d-flex flex-column">
                                            <label required class=" col-form-label">Calculate KPI</label>
                                            <a class="reblateBtn px-4 py-1" style="cursor: pointer;" id="popupButton">Caculate KPI</a>
                                            <div class="popup" id="popup">
                                                <div class="popup-content flex-column">
                                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                                        <h2 style="color: #14213d;">KPI For {{ $emp->Emp_Full_Name }}</h2>
                                                        <span class="closeBtn"><svg xmlns="http://www.w3.org/2000/svg"
                                                                width="20" height="20" fill="currentColor"
                                                                class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                            </svg></span>
                                                    </div>

                                                    <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x"
                                                        data-simplebar="init" style="max-width: 700px;">
                                                        <div class="simplebar-wrapper" style="margin: 0px; width:600px;">
                                                            <div class="simplebar-height-auto-observer-wrapper">
                                                                <div class="simplebar-height-auto-observer"></div>
                                                            </div>
                                                            <div class="simplebar-mask">
                                                                <div class="simplebar-offset"
                                                                    style="right: 0px; bottom: 0px;">
                                                                    <div class="simplebar-content-wrapper" tabindex="0"
                                                                        role="region" aria-label="scrollable content"
                                                                        style="height: auto; overflow: scroll;">
                                                                        <div class="simplebar-content"
                                                                            style="padding: 0px;">
                                                                            <table
                                                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                                <tbody>
                                                                                    <tr style="border-top:none;">
                                                                                        <th style="border:1px solid #fca311; color:#14213d"
                                                                                            colspan="2">
                                                                                            {{ $emp->Emp_Code }}</th>
                                                                                        <th style="border:1px solid #fca311; border-top:none; color:#14213d; box-shadow:inset 0 0 0 9999px #fff"
                                                                                            colspan="3">
                                                                                        </th>
                                                                                        <th style="border:1px solid #fca311; color:#14213d"
                                                                                            colspan="2">
                                                                                            {{ $emp_month_salary }}</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border:1px solid #fca311; color:#14213d; font-size:20px;"
                                                                                            colspan="7">Basic Attributes
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="2">Criteria</th>
                                                                                        <th colspan="3">Description</th>
                                                                                        <th colspan="1">Marks</th>
                                                                                        <th colspan="1">Obtained</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Communication
                                                                                        </td>
                                                                                        <td colspan="3">Ability to
                                                                                            convey information clearly and
                                                                                            effectively</td>
                                                                                        <td colspan="1">5</td>
                                                                                        <td colspan="1"><input
                                                                                                type="text"
                                                                                                value="0"
                                                                                                id="communicationPoint"
                                                                                                name="communication_point"
                                                                                                onchange="calculateSalary()"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Problem-solving
                                                                                        </td>
                                                                                        <td colspan="3">Capability to
                                                                                            identify and resolve complex
                                                                                            issues</td>
                                                                                        <td colspan="1">5</td>
                                                                                        <td colspan="1"><input
                                                                                                type="text"
                                                                                                value="0"
                                                                                                id="ProblemSolvingPoint"
                                                                                                name="problem_solving_point"
                                                                                                onchange="calculateSalary()"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td colspan="2">Teamwork</td>
                                                                                        <td colspan="3">Collaboration
                                                                                            and contribution towards
                                                                                            achieving team goals</td>
                                                                                        <td colspan="1">5</td>
                                                                                        <td colspan="1"><input
                                                                                                type="text"
                                                                                                value="0"
                                                                                                id="TeamWorkPoint"
                                                                                                name="team_work_point"
                                                                                                onchange="calculateSalary()"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Time Management
                                                                                        </td>
                                                                                        <td colspan="3">Efficient
                                                                                            utilization of Time,
                                                                                            Punctuality, and Attendance.
                                                                                        </td>
                                                                                        <td colspan="1">5</td>
                                                                                        <td colspan="1"><input
                                                                                                type="text"
                                                                                                value="0"
                                                                                                id="TimeManagementPoint"
                                                                                                name="team_management_point"
                                                                                                onchange="calculateSalary()"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="5">Total</th>
                                                                                        <td>20</td>
                                                                                        <td><input type="text"
                                                                                                value="0"
                                                                                                disabled
                                                                                                id="Total1"
                                                                                                                                                                                     "
                                                                                                type="number"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="8">Job Performance
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="2">Criteria</th>
                                                                                        <th colspan="3">Description</th>
                                                                                        <th colspan="1">Marks</th>
                                                                                        <th colspan="1">Obtained</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Quality of Work
                                                                                        </td>
                                                                                        <td colspan="3">Accuracy,
                                                                                            attention to detail, and
                                                                                            consistency in delivering
                                                                                            high-quality work</td>
                                                                                        <td colspan="1">5</td>
                                                                                        <td colspan="1"><input
                                                                                                type="text"
                                                                                                value="0"
                                                                                                id="QualityOfWork"
                                                                                                name="quality_of_work"
                                                                                                onchange="calculateSalary()"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Productivity
                                                                                        </td>
                                                                                        <td colspan="3">Ability to meet
                                                                                            or exceed productivity targets
                                                                                            and output expectations</td>
                                                                                        <td colspan="1">5</td>
                                                                                        <td colspan="1"><input
                                                                                                type="text"
                                                                                                value="0"
                                                                                                id="Productivity"
                                                                                                name="productivity"
                                                                                                onchange="calculateSalary()"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td colspan="2">Innovation</td>
                                                                                        <td colspan="3">Proactive
                                                                                            approach towards suggesting and
                                                                                            implementing creative ideas</td>
                                                                                        <td colspan="1">5</td>
                                                                                        <td colspan="1"><input
                                                                                                type="text"
                                                                                                value="0"
                                                                                                id="Innovation"
                                                                                                name="innovation"
                                                                                                onchange="calculateSalary()"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Professionalism
                                                                                        </td>
                                                                                        <td colspan="3">Adherence to
                                                                                            company policies, ethics, and
                                                                                            professional conduct</td>
                                                                                        <td colspan="1">5</td>
                                                                                        <td colspan="1"><input
                                                                                                type="text"
                                                                                                value="0"
                                                                                                name="professionalism"
                                                                                                id="Professionalism"
                                                                                                onchange="calculateSalary()"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="5">Total</th>
                                                                                        <td>20</td>
                                                                                        <td><input type="text"
                                                                                                value="0"
                                                                                                id="Total2"
                                                                                                disabled
                                                                                                type="number"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="8">Development &
                                                                                            Growth </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="2">Criteria</th>
                                                                                        <th colspan="3">Description</th>
                                                                                        <th colspan="1">Marks</th>
                                                                                        <th colspan="1">Obtained</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Skill
                                                                                            Enhancement</td>
                                                                                        <td colspan="3">Participation in
                                                                                            training programs, acquiring new
                                                                                            skills, and knowledge.</td>
                                                                                        <td colspan="1" rowspan="2">
                                                                                            10</td>
                                                                                        <td colspan="1" rowspan="2">
                                                                                            <input type="text"
                                                                                                value="0"
                                                                                                id="DevelopmentAndGrwoth"
                                                                                                name="development_and_growth"
                                                                                                onchange="calculateSalary()"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Initiative</td>
                                                                                        <td colspan="4">Willingness to
                                                                                            take initiative for personal and
                                                                                            professional growth</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="6">Total Marks</th>
                                                                                        <th colspan="1"><input
                                                                                                type="text"
                                                                                                disabled
                                                                                                value="0"
                                                                                                id="Total3"
                                                                                                type="number"
                                                                                                style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                                        </th>
                                                                                    </tr>



                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="simplebar-placeholder"
                                                                style="width: 440px; height: 469px;"></div>
                                                        </div>

                                                        <div class="simplebar-track simplebar-vertical"
                                                            style="visibility: visible;">
                                                            <div class="simplebar-scrollbar"
                                                                style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label for="example-text-input" required class=" col-form-label">KPI
                                                Bonus</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                name="emp_kpi_bonus" min="0" id="kpiBonus"
                                                onchange="calculateSalary()" value="0">

                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label required class=" col-form-label">Project Bonus</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                name="emp_project_bonus" min="0" id="projectBonus"
                                                onchange="calculateSalary()" value="0">

                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label required class=" col-form-label">Designation Bonus</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                id="emp_designation_bonus" name="emp_designation_bonus" min="0"
                                                id="" onchange="calculateSalary()" value="{{($emp->designation_bonus!=null) ? $emp->designation_bonus : '0'}}">
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label required class=" col-form-label">Travel Allowence</label>
                                            <input class="form-control inputboxcolor" min="0"
                                                id="emp_travel_allowence" name="emp_travel_allowence"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                onchange="calculateSalary()" value="{{ ($emp->travel_allowance!=null) ? $emp->travel_allowance : '0' }}">
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label required class=" col-form-label">Quarterly Bonus</label>
                                            <input class="form-control inputboxcolor" min="0"
                                                id="quarterly_bonus" name="quarterly_bonus"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                onchange="calculateSalary()" value="0">
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label for="example-text-input" min="0" required
                                                class=" col-form-label">Deduction</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                value="0" name="emp_deduction" min="0" id="deduction"
                                                onchange="calculateSalary()">

                                        </div>

                                    </div>
                                    <div class="form-group  row">
                                        <div class="col-md-3 col-sm-12">
                                            <label for="example-text-input" min="0" required
                                                class=" col-form-label">No of Working Days</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                value="{{ ($total_days > 0 ) ? $total_days : '22'}}" name="emp_no_of_working_days" min="0"
                                                id="">

                                        </div>

                                        <div class="col-md-3 col-sm-12">
                                            <label for="example-text-input" required class=" col-form-label">Absent
                                                Days</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                name="emp_absent" min="0" value="{{($total_absents > 0) ? $total_absents : '0' }}">

                                        </div>

                                        <div class="col-md-3 col-sm-12">
                                            <label required class=" col-form-label">Leave Days</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" min="0"
                                                name="emp_leave"  type="number" value="{{($total_leaves > 0) ? $total_leaves : '0' }}">
                                        </div>


                                    </div>
                                    <div class="row form-group">

                                        <div class="col-md-12 col-sm-12">
                                            <label required class=" col-form-label">Reason of Deduction</label>

                                            <textarea class="form-control inputboxcolor" rows="5" name="emp_reason_deduction"
                                                style="resize-x: none; background-color: #e3e3e3; border:none;" placeholder=""></textarea>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4 col-sm-12">
                                            <label required class=" col-form-label">Total Salary</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                name="emp_total_salary" disabled min="0" id="totalSalary"
                                                value="0">
                                            <input type="hidden" name="emp_total_salary_hidden"
                                                id="emp_total_salary_hidden">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label required class=" col-form-label"> Deducation</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                name="emp_deduction" disabled min="0" id="displayDeduction"
                                                value="0">
                                            <input type="hidden" name="emp_deduction_hidden" id="emp_deduction_hidden">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label required class=" col-form-label">Net Salary</label>
                                            <input class="form-control inputboxcolor"
                                                style="background-color: #e3e3e3; border:none;" type="number"
                                                name="emp_net_salary" disabled min="0" id="netSalary"
                                                value="0">
                                            <input type="hidden" name="emp_net_salary_hidden"
                                                id="emp_net_salary_hidden">
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-8 col-sm-12 mx-auto mt-4">
                                    <table class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%; border-radius: 10px;">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="text-center"
                                                    style="font-size: 30px; color:#14213d; background-color:#e3e3e3">
                                                    Overall Assessment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 25%">Rating Scale</td>
                                                <td style="width: 50%">Description</td>
                                                <td>Remarks</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%">5 - Outstanding</td>
                                                <td style="width: 70%">Consistently exceeds expectations</td>
                                                <td class="text-center"><input type="radio" value="outstanding" name="over_all_performance"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%">4 - Exceeds Expectations</td>
                                                <td style="width: 50%">Frequently exceeds expectations</td>
                                                <td class="text-center"><input type="radio"  value="exceeds_expectation" name="over_all_performance"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%">3 - Meets Expectations</td>
                                                <td style="width: 50%">Regularly meets expectations</td>
                                                <td class="text-center"><input type="radio" value="meets_expectation" name="over_all_performance"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%">2 - Needs Improvement</td>
                                                <td style="width: 50%">Occasionally fails to meet expectations</td>
                                                <td class="text-center"><input type="radio" value="needs_expectation" name="over_all_performance"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%">1 - Unsatisfactory</td>
                                                <td style="width: 50%">Consistently fails to meet expectations</td>
                                                <td class="text-center"><input type="radio" value="unsatisfactory" name="over_all_performance"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="my-4">
                                    <button type="submit" onclick="confirmSalary({{ $emp->id }})"
                                        class="reblateBtn py-2 px-4 w-md" target="_blank">{{ $btn_text }}</button>
                                    {{-- <a href="/preview-salary/{{$id}}" target="_blank" class="btn btn-danger">Preview</a> --}}
                                    <button class="reblateBtn py-2 px-4 w-md text-light">
                                        <a href="/generate-new-salary-slip" class="text-light">Go Back</a>
                                    </button>

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

            function KPIBounus() {



            }


            function calculateSalary() {
                const basicSalary = parseFloat(document.getElementById('basicSalary').value) || 0;
                const emp_travel_allowence = parseFloat(document.getElementById('emp_travel_allowence').value) || 0;
                const emp_designation_bonus = parseFloat(document.getElementById('emp_designation_bonus').value) || 0;
                const quarterly_bonus = parseFloat(document.getElementById('quarterly_bonus').value) || 0;
                // const kpiBonus = parseFloat(document.getElementById('kpiBonus').value) || 0;
                const projectBonus = parseFloat(document.getElementById('projectBonus').value) || 0;
                const deduction = parseFloat(document.getElementById('deduction').value) || 0;


                const communicationPoint = parseFloat(document.getElementById('communicationPoint').value);
                const problemSolvingPoint = parseFloat(document.getElementById('ProblemSolvingPoint').value);
                const TeamWorkPoint = parseFloat(document.getElementById('TeamWorkPoint').value);
                const TimeManagementPoint = parseFloat(document.getElementById('TimeManagementPoint').value);

                const firstSum = communicationPoint + problemSolvingPoint + TeamWorkPoint + TimeManagementPoint;

                document.getElementById('Total1').value = firstSum;

                const QualityOfWork = parseFloat(document.getElementById('QualityOfWork').value);
                const Productivity = parseFloat(document.getElementById('Productivity').value);
                const Innovation = parseFloat(document.getElementById('Innovation').value);
                const Professionalism = parseFloat(document.getElementById('Professionalism').value);

                const secoundSum = QualityOfWork + Productivity + Innovation + Professionalism;

                document.getElementById('Total2').value = secoundSum;
                const DevelopmentAndGrwoth = parseFloat(document.getElementById('DevelopmentAndGrwoth').value)

                const thirdSum = firstSum + DevelopmentAndGrwoth + secoundSum;
                document.getElementById('Total3').value = thirdSum;

                const KPIBonous = thirdSum * 100;
                document.getElementById('kpiBonus').value =KPIBonous;
                console.log(KPIBonous)



                const totalSalary = basicSalary + KPIBonous + projectBonus + emp_travel_allowence + emp_designation_bonus + quarterly_bonus;
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
