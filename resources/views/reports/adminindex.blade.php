@extends('layouts.master')
@section('title')
Reports Section
@endsection
@section('page-title')
Reports Section
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

                .borderingLeftTable {
                    border-top-left-radius: 10px !important;
                }

                .borderingRightTable {
                    border-top-right-radius: 10px !important;
                }

                .table-lines {
                    font-family: 'Poppins';
                    color: #000;
                    font-weight: 700;
                }

                /* Adjust layout of DataTable components */
                .dataTables_length,
                .dataTables_filter,
                .dataTables_buttons {
                    display: inline-block;
                    margin-right: 10px;
                    /* Adjust margin as needed */
                }

                .dataTables_filter {
                    float: right;
                    /* Align search bar to the right */
                }

                .modal-backdrop {

                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: -1;
                    width: 100vw;
                    height: 100vh;
                    background-color: var(--bs-backdrop-bg);
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

                }

                .closeBtn {
                    position: absolute;
                    top: 25px;
                    right: 15px;
                    cursor: pointer;
                }

                .upload-btn-wrapper {
                    position: relative;
                    overflow: hidden;
                    display: inline-block;
                }

                .upload-btn-wrapper input[type=file] {
                    font-size: 100px;
                    position: absolute;
                    left: 0;
                    top: 0;
                    opacity: 0;
                }

                #file_modal:hover {
                    cursor: pointer;
                }

                .file-upload {
                    display: inline-block;
                    position: relative;
                    overflow: hidden;
                }

                .file-upload-label {
                    display: inline-block;
                    padding: 20px;
                    border: 2px dashed #ccc;
                    border-radius: 5px;
                    cursor: pointer;
                    text-align: center;
                    font-size: 16px;
                }

                .file-upload-label span {
                    display: block;
                }

                #file-input {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    opacity: 0;
                    cursor: pointer;
                }

                .remove-file {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    cursor: pointer;
                    font-size: 14px;
                    color: #f00;
                    display: none;
                }

                .modal-fullscreen {
                    width: 100vw;
                    max-width: 100%;
                    margin: 0;
                }

                .modal-dialog-scrollable {
                    display: flex;
                    max-height: calc(100vh - 60px);
                    /* Adjust as needed based on your modal content */
                    margin-top: 30px;
                    /* Adjust top margin as needed */
                }

                .embed-responsive {
                    position: relative;
                    display: block;
                    width: 100%;
                    padding-top: 100%;
                    /* This keeps the aspect ratio (height:width) */
                    overflow: hidden;
                }

                .embed-responsive iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border: none;
                }

                .text-link {

        background: #14213d;
        padding: 10px;
        margin: 3px;
        color: #ddd;
        border-radius: 5px;
        font-size: 15px;

            }
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body bg-white">
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <h3>Employees Report</h3>
                        </form>
                    </div>
                        <table id="datatable-buttons" class="table dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr style="background-color: #14213d">
                                    <th class="borderingLeftTable font-size-20" style="color: white">SN</th>
                                    <th class="font-size-20" style="color: white">Emp ID</th>
                                    <th class="font-size-20" style="color: white">Emp Name</th>
                                    <th class="borderingRightTable font-size-20" style="color: white">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @php 
                                $sum = 1;
                                @endphp
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $sum ++ }}</td>
                                    <td><a href="{{ route('employee.reports', $employee->user_code) }}">{{ $employee->user_code }}</a></td>
                                    <td>{{ $employee->name }}</td>
                                    <td><a href="{{ route('employee.reports', $employee->user_code) }}" class="btn btn-primary">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div> 
        </div> 

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
