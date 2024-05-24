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
        .background-green {
            background: green;
        }
        .background-yellowgreen {
            background: #f19302;
        }
        .background-red {
            background: #cb0505;
        }

        .color-white {
            color:#fff !important;
        }
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
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <br>
                        <h3> Preview Salary Details</h3><hr>
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
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" id="close-now">
                                {{ session('error') }}
                                <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                    aria-label="Close" style="float: right;">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </div>
                           @endif
                            <div class="table-responsive">
                                <table  class="table  table-bordered"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                       <input type="hidden" value="{{$emp_name}}" name="emp_name">
                                       <input type="hidden" value="{{$emp_email}}" name="emp_email">
                                       <input type="hidden" value="{{$emp_code}}" name="emp_code">
                                       <input type="hidden" value="{{$emp_month_salary_hidden}}" name="emp_month_salary_hidden">
                                       <input type="hidden" value="{{$emp_designation}}" name="emp_designation">
                                       <input type="hidden" value="{{$emp_shift_time}}" name="emp_shift_time">
                                       <input type="hidden" value="{{$emp_basic_salary}}" name="emp_basic_salary">
                                       <input type="hidden" value="{{$emp_kpi_bonus}}" name="emp_kpi_bonus">
                                       <input type="hidden" value="{{$emp_travel_allowence}}" name="emp_travel_allowence">
                                       <input type="hidden" value="{{$emp_no_of_working_days}}" name="emp_no_of_working_days">
                                       <input type="hidden" value="{{$emp_travel_allowence}}" name="emp_travel_allowence">
                                       <input type="hidden" value="{{$emp_project_bonus}}" name="emp_project_bonus">
                                       <input type="hidden" value="{{$emp_absent}}" name="emp_absent">
                                       <input type="hidden" value="{{$emp_leave}}" name="emp_leave">
                                       <input type="hidden" value="{{$emp_deduction}}" name="emp_deduction">
                                       <input type="hidden" value="{{$emp_net_salary}}" name="emp_net_salary">
                                       <input type="hidden" value="{{$emp_total_salary}}" name="emp_total_salary">
                                       <input type="hidden" value="{{$emp_reason_deduction}}" name="emp_reason_deduction">
                                       <input type="hidden" value="{{$emp_designation_bonus}}" name="emp_designation_bonus">
                                       <input type="hidden" value="{{$emp_date_of_joining_hidden}}" name="emp_date_of_joining_hidden">
                                       {{-- basic attributes --}}
                                       <input type="hidden" value="{{$quarterly_bonus}}" name="quarterly_bonus">
                                       <input type="hidden" value="{{$communication_point}}" name="communication_point">
                                       <input type="hidden" value="{{$problem_solving_point}}" name="problem_solving_point">
                                       <input type="hidden" value="{{$team_work_point}}" name="team_work_point">
                                       <input type="hidden" value="{{$team_management_point}}" name="team_management_point">
                                        {{-- job performance --}}
                                        <input type="hidden" value="{{$quality_of_work}}" name="quality_of_work">
                                        <input type="hidden" value="{{$productivity}}" name="productivity">
                                        <input type="hidden" value="{{$innovation}}" name="innovation">
                                        <input type="hidden" value="{{$professionalism}}" name="professionalism">

                                        {{-- development_and_growth --}}
                                        <input type="hidden" value="{{$development_and_growth}}" name="development_and_growth">

                                        {{-- total Marks --}}
                                        <input type="hidden" value="{{$total_basic_attributes}}" name="total_basic_attributes">
                                        <input type="hidden" value="{{$total_job_performance}}" name="total_job_performance">
                                        <input type="hidden" value="{{$over_all_performance}}" name="over_all_performance">
                                        <input type="hidden" value="{{$all_total}}" name="all_total">

                                        {{--  over all assesment --}}
                                        <input type="hidden" value="{{$created_by}}" name="created_by">
                                        <input type="hidden" value="{{$authorized_by}}" name="authorized_by">
                                        <input type="hidden" value="{{$salary_id}}" name="salary_id">
                                        <input type="hidden" value="{{$emp_present_days}}" name="emp_present_days">





                                        <tr>
                                            <td> <strong> Name</strong> </td>
                                            <td> {{$emp_name}} </td>
                                            <td> <strong>  Email </strong> </td>
                                            <td> {{$emp_email}} </td>
                                        </tr>

                                        <tr>
                                            <td> <strong> Emp Code</strong> </td>
                                            <td> {{$emp_code }} </td>
                                            <td> <strong>  Month of Salary </strong> </td>
                                            <td> {{$emp_month_salary_hidden}} </td>
                                        </tr>

                                        <tr>
                                            <td> <strong> Designation</strong> </td>
                                            <td> {{$emp_designation}} </td>
                                            <td> <strong>  Shift Time </strong> </td>
                                            <td> {{$emp_shift_time}} </td>
                                        </tr>

                                        <tr>
                                            <td> <strong> Basic Salary</strong> </td>
                                            <td> Rs. {{$emp_basic_salary}} </td>
                                            <td> <strong>  KPI Bonus (<a   style="cursor: pointer;text-decoration:underline;" id="popupButton"><u>See Details</u></a>) </strong> </td>
                                            <td> Rs. {{$emp_kpi_bonus}} </td>
                                        </tr>

                                        <tr>
                                            <td> <strong> Travel Allowence</strong> </td>
                                            <td> Rs. {{$emp_travel_allowence}} </td>
                                            <td> <strong> Working Days </strong> </td>
                                            <td> {{$emp_no_of_working_days}} </td>
                                        </tr>

                                        <tr>
                                            <td> <strong> Project Bonus</strong> </td>
                                            <td> Rs. {{$emp_project_bonus}} </td>
                                            <td> <strong>  Absent </strong> </td>
                                            <td> {{$emp_absent}} </td>
                                        </tr>
                                        <tr>
                                            <td> <strong> Leaves</strong> </td>
                                            <td>  {{$emp_leave}} </td>
                                            <td> <strong>  Designation Bonus </strong> </td>
                                            <td> Rs. {{$emp_designation_bonus}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Querterly Bonus</strong></td>
                                            <td>
                                                Rs. {{$quarterly_bonus}}
                                            </td>
                                            <td>Present Days</td>
                                            <td> {{$emp_present_days}}</td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Reason of Deduction</strong> </td>
                                            <td colspan="3">  {{$emp_reason_deduction}} </td>
                                        </tr>

                                        <tr>
                                            <td> <strong> Total Salary</strong> </td>
                                            <td>  {{$emp_total_salary}} </td>
                                            <td> <strong>  Deduction </strong> </td>
                                            <td> Rs. {{$emp_deduction}} </td>

                                        </tr>

                                        <tr>
                                            <td> <strong>  Net Salary </strong> </td>
                                            <td> Rs. {{$emp_net_salary}} </td>
                                        </tr>


                                </table>


                            </div>

                            <div class="col-md-12 col-sm-12 d-flex flex-column">


                                <div class="popup" id="popup">
                                    <div class="popup-content flex-column">
                                        <div class="d-flex mb-3 align-items-center justify-content-between">

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
                                                                                    value="{{$communication_point}}"
                                                                                    disabled
                                                                                    id="communicationPoint"
                                                                                    name="communication_point"

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

                                                                                    id="ProblemSolvingPoint"
                                                                                    name="problem_solving_point"
                                                                                    value="{{$problem_solving_point}}"
                                                                                    disabled
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

                                                                                    id="TeamWorkPoint"

                                                                                    name="problem_solving_point"
                                                                                    value="{{$team_work_point}}"
                                                                                    disabled
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

                                                                                    id="TimeManagementPoint"
                                                                                    disabled
                                                                                    name="problem_solving_point"
                                                                                    value="{{$team_management_point}}"
                                                                                    style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th colspan="5">Total</th>
                                                                            <td>20</td>
                                                                            <td><input type="text"
                                                                                value="{{$total_basic_attributes}}"
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

                                                                                    id="QualityOfWork"
                                                                                    name="quality_of_work"
                                                                                    value="{{$quality_of_work}}"
                                                                                    disabled
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

                                                                                    id="Productivity"
                                                                                    name="productivity"
                                                                                    value="{{$productivity}}"
                                                                                    disabled
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

                                                                                    id="Innovation"
                                                                                    name="innovation"
                                                                                    value="{{$innovation}}"
                                                                                    disabled
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

                                                                                    name="professionalism"
                                                                                    id="Professionalism"
                                                                                    value="{{$professionalism}}"
                                                                                    disabled
                                                                                    style="width: 50px; height:40px; background-color:transparent; border:none;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th colspan="5">Total</th>
                                                                            <td>20</td>
                                                                            <td><input type="text"
                                                                                    value="{{$total_job_performance}}"
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
                                                                                    disabled
                                                                                    id="DevelopmentAndGrwoth"
                                                                                    name="development_and_growth"
                                                                                    value="{{$development_and_growth}}"
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
                                                                                    value="{{$all_total}}"
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
                                        <tr {{($over_all_performance == "outstanding" ) ? 'class=background-green' : ''}}>
                                        <td style="width: 25%" {{($over_all_performance == "outstanding" ) ? 'class=color-white' : ''}}>5 - Outstanding</td>
                                        <td style="width: 70%" {{($over_all_performance == "outstanding" ) ? 'class=color-white' : ''}}>Consistently exceeds expectations</td>
                                        <td class="text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24"><path fill="#fff" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>

                                            </td>
                                        </tr>
                                        <tr {{($over_all_performance == "exceeds_expectation" ) ? 'class=background-green' : ''}}>
                                            <td style="width: 25%" {{($over_all_performance == "exceeds_expectation" ) ? 'class=color-white' : ''}}>4 - Exceeds Expectations</td>
                                            <td style="width: 50%" {{($over_all_performance == "exceeds_expectation" ) ? 'class=color-white' : ''}}>Frequently exceeds expectations</td>
                                            <td class="text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24"><path fill="#fff" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
                                            </td>
                                        </tr>
                                        <tr {{($over_all_performance == "meets_expectation" ) ? 'class=background-yellowgreen' : ''}}>
                                            <td style="width: 25%" {{($over_all_performance == "meets_expectation" ) ? 'class=color-white' : ''}}>3 - Meets Expectations</td>
                                            <td style="width: 50%" {{($over_all_performance == "meets_expectation" ) ? 'class=color-white' : ''}}>Regularly meets expectations</td>
                                            <td class="text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24"><path fill="#fff" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
                                            </td>
                                        </tr>
                                        <tr {{($over_all_performance == "needs_expectation" ) ? 'class=background-yellowgreen' : ''
                                    }}>
                                            <td style="width: 25%" {{($over_all_performance == "needs_expectation" ) ? 'class=color-white' : ''}}>2 - Needs Improvement</td>
                                            <td style="width: 50%" {{($over_all_performance == "needs_expectation" ) ? 'class=color-white' : ''}}>Occasionally fails to meet expectations</td>
                                            <td class="text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24"><path fill="#fff" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
                                            </td>
                                        </tr>
                                        <tr {{($over_all_performance == "unsatisfactory" ) ? 'class=background-red' : ''
                                    }}>
                                            <td style="width: 25%" {{($over_all_performance == "unsatisfactory" ) ? 'class=color-white' : ''}}>1 - Unsatisfactory</td>
                                            <td style="width: 50%" {{($over_all_performance == "unsatisfactory" ) ? 'class=color-white' : ''}}>Consistently fails to meet expectations</td>
                                            <td class="text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24"><path fill="#fff" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary  w-md"
                                    style="background-color: #14213D ; border-color: #fff;">Send Receipt</button>
                                <a href="/generate-new/{{$id}}" class="btn btn-danger">Go Back</a>
                            </div>
                            {{-- <div class="simplebar-track simplebar-vertical"
                                style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;">
                                </div>
                            </div> --}}
                        </div>



                            {{-- <p>Mark check if you want to send  email to <strong><u>{{$emp_name}}</u></strong> otherwise email will not be sent!</p> --}}
{{--
                            <div class="">
                                <input type="checkbox"  checked name="check_box" class="checbox"> Send Email to <strong>{{$emp_name}}</strong> 😂😂

                            </div> --}}






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
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
